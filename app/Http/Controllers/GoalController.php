<?php

namespace App\Http\Controllers;

use App\Goal;
use App\GoalQualification;
use App\Http\Resources\GoalResource;
use App\User;
use App\UserGoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Goal::all();
        return $this->responseOk($goals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param Goal $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        return $this->responseOk($goal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeResultFile(Request $request)
    {
        $userId = auth('api-jwt')->user()->id;
        $goalId = $request->goalId;
        if ($request->has('file')) {
            $path = $request->file('file')->storeAs(
                'results', $userId . '-' . $goalId . '-' . Carbon::now() . '.' . $request->file('file')->getClientOriginalExtension()
            );
            $userGoal = UserGoal::find($goalId);
            $userGoal->result_file = $path;
            $userGoal->status = 'Ожидает проверки';
            $userGoal->save();
        }
    }

    public function changeStatus(UserGoal $goal, Request $request)
    {
        $goal->status = $request->status;
        $goal->comment = $request->comment;

        $goal->save();
    }

    public function refreshGoals(User $user, Request $request)
    {
        $userGoals = $user->goals;

        foreach ($userGoals as $userGoal) {
            if ($userGoal->pivot->status != 'Выполнена') {
                return $this->responseFail(['message' => 'Вы ещё не закрыли цели текущей квалификации!']);
            }
        }

        $userCurrentQualification = $user->user_qualifications()->orderBy('id')->first();
        $nextQualificationId = $userCurrentQualification->next_qualification;
        $nextQualificationGoals = GoalQualification::whereQualificationId($nextQualificationId)->get()->toArray();
        \Log::info($nextQualificationGoals);

        $goals = array_map(function ($goal) use ($user) {
            return [
                'user_id' => $user->id,
                'goal_id' => $goal['goal_id'],
                'status' => 'Назначена'
            ];
        }, $nextQualificationGoals);

        UserGoal::insert($goals);

        $goals = $user->goals;

        foreach ($goals as &$goal) {
            if ($goal->pivot->status === 'Выполнена') {
                $goal->assess_goals = UserGoal::whereStatus('Ожидает проверки')
                    ->whereGoalId($goal->pivot->goal_id)->get();
            }
        }

        return $this->responseOk(GoalResource::collection($goals));
    }
}
