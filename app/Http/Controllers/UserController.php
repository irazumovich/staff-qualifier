<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoalResource;
use App\Goal;
//use App\GoalQualification;
use App\User;
//use App\UserGoal;
use App\UserGoal;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $users = User::all();

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        $userData = $request->all();
        $user = User::create($userData);

        return $user;
    }

    public function goals(User $user)
    {
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
