@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.goal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.goals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.id') }}
                        </th>
                        <td>
                            {{ $goal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.name') }}
                        </th>
                        <td>
                            {{ $goal->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.description') }}
                        </th>
                        <td>
                            {{ $goal->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.confirmation_method') }}
                        </th>
                        <td>
                            {{ $goal->confirmation_method }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.goal.fields.task_ile') }}
                        </th>
                        <td>
                            @foreach($goal->task_ile as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.goals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#goal_resources" role="tab" data-toggle="tab">
                {{ trans('cruds.resource.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#qualification_goals_qualifications" role="tab" data-toggle="tab">
                {{ trans('cruds.qualification.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="goal_resources">
            @includeIf('admin.goals.relationships.goalResources', ['resources' => $goal->goalResources])
        </div>
        <div class="tab-pane" role="tabpanel" id="qualification_goals_qualifications">
            @includeIf('admin.goals.relationships.qualificationGoalsQualifications', ['qualifications' => $goal->qualificationGoalsQualifications])
        </div>
    </div>
</div>

@endsection