@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.qualification.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qualifications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.qualification.fields.id') }}
                        </th>
                        <td>
                            {{ $qualification->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qualification.fields.name') }}
                        </th>
                        <td>
                            {{ $qualification->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qualification.fields.sign') }}
                        </th>
                        <td>
                            {{ $qualification->sign }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qualification.fields.next_qualification') }}
                        </th>
                        <td>
                            {{ $qualification->next_qualification }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qualification.fields.description') }}
                        </th>
                        <td>
                            {{ $qualification->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.qualification.fields.qualification_goals') }}
                        </th>
                        <td>
                            @foreach($qualification->qualification_goals as $key => $qualification_goals)
                                <span class="label label-info">{{ $qualification_goals->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.qualifications.index') }}">
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
            <a class="nav-link" href="#user_qualifications_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="user_qualifications_users">
            @includeIf('admin.qualifications.relationships.userQualificationsUsers', ['users' => $qualification->userQualificationsUsers])
        </div>
    </div>
</div>

@endsection