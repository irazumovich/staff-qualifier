<?php

namespace App\Http\Controllers\Admin;

use App\Goal;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGoalRequest;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GoalController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('goal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goals = Goal::all();

        return view('admin.goals.index', compact('goals'));
    }

    public function create()
    {
        abort_if(Gate::denies('goal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.goals.create');
    }

    public function store(StoreGoalRequest $request)
    {
        $goal = Goal::create($request->all());

        foreach ($request->input('task_ile', []) as $file) {
            $goal->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('task_ile');
        }

        return redirect()->route('admin.goals.index');
    }

    public function edit(Goal $goal)
    {
        abort_if(Gate::denies('goal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.goals.edit', compact('goal'));
    }

    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $goal->update($request->all());

        if (count($goal->task_ile) > 0) {
            foreach ($goal->task_ile as $media) {
                if (!in_array($media->file_name, $request->input('task_ile', []))) {
                    $media->delete();
                }
            }
        }

        $media = $goal->task_ile->pluck('file_name')->toArray();

        foreach ($request->input('task_ile', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $goal->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('task_ile');
            }
        }

        return redirect()->route('admin.goals.index');
    }

    public function show(Goal $goal)
    {
        abort_if(Gate::denies('goal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goal->load('goalResources', 'qualificationGoalsQualifications');

        return view('admin.goals.show', compact('goal'));
    }

    public function destroy(Goal $goal)
    {
        abort_if(Gate::denies('goal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goal->delete();

        return back();
    }

    public function massDestroy(MassDestroyGoalRequest $request)
    {
        Goal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
