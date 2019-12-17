<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\UserGoal;
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
        $userId = auth()->user()->id;
        $goalId = $request->goalId;
        if ($request->has('file')) {
            $path = $request->file('file')->storeAs(
                'results', $userId . '-' . $goalId . '-' . Carbon::now() . '.' . $request->file('file')->getClientOriginalExtension()
            );
            $userGoal = UserGoal::find($goalId);
            $userGoal->result_file = $path;
            $userGoal->save();
        }
    }
}
