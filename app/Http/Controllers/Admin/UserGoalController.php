<?php

namespace App\Http\Controllers\Admin;

use App\Goal;
use App\Http\Requests\MassDestroyQualificationRequest;
use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Qualification;
use App\User;
use App\UserGoal;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class UserGoalController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_goal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userGoals = UserGoal::all();

        return view('admin.userGoals.index', compact('userGoals'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_goal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goals = Goal::all()->pluck('name', 'id');
        $users = $mentors = User::all()->pluck('name', 'id');

        return view('admin.userGoals.create', compact(['users', 'mentors', 'goals']));
    }

    public function store(Request $request)
    {
        UserGoal::create($request->all());

        return redirect()->route('admin.user-goals.index');
    }

    public function edit(UserGoal $userGoal)
    {
        abort_if(Gate::denies('user_goal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goals = Goal::all()->pluck('name', 'id');
        $users = $mentors = User::all()->pluck('name', 'id');

        return view('admin.userGoals.edit', compact(['goals', 'users', 'mentors', 'userGoal']));
    }

    public function update(Request $request, UserGoal $userGoal)
    {
        $userGoal->update($request->all());

        return redirect()->route('admin.user-goals.index');
    }

    public function show(UserGoal $userGoal)
    {
        abort_if(Gate::denies('user_goal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goals = Goal::all()->pluck('name', 'id');
        $users = $mentors = User::all()->pluck('name', 'id');

        return view('admin.userGoals.show', compact(['goals', 'users', 'mentors']));
    }

    public function destroy(UserGoal $userGoal)
    {
        abort_if(Gate::denies('user_goal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userGoal->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        UserGoal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
