<?php

namespace App\Http\Controllers;

use App\Http\Resources\GoalResource;
use App\Goal;
//use App\GoalQualification;
use App\User;
//use App\UserGoal;
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
//        $goals = $user->goals()->get()->toArray();
//        if (empty((array)$goals)) {
//            \Log::info('here');
//            $userQualification = $user->qualification_id;
//            $userQualificationGoals = GoalQualification::whereQualificationId($userQualification)
//                ->pluck('goal_id');
//            foreach ($userQualificationGoals as $goalId) {
//                UserGoal::create([
//                    'goal_id' => $goalId,
//                    'user_id' => $user->id,
//                    'status' => 'Назначена'
//                ]);
//            }
//        }

        $goals = $user->goals;

        return $this->responseOk(GoalResource::collection($goals));
    }
}
