@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userGoal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-goals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userGoal.fields.id') }}
                        </th>
                        <td>
                            {{ $userGoal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userGoal.fields.user') }}
                        </th>
                        <td>
                            {{ $userGoal->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userGoal.fields.goal') }}
                        </th>
                        <td>
                            {{ $userGoal->goal->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userGoal.fields.status') }}
                        </th>
                        <td>
                            {{ $userGoal->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userGoal.fields.mentor') }}
                        </th>
                        <td>
                            {{ $userGoal->mentor->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userGoal.fields.result_file') }}
                        </th>
                        <td>
                            @if($userGoal->result_file)
                                <a href="{{ $userGoal->result_file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-goals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection