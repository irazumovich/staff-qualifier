@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.resource.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.resources.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="goal_id">{{ trans('cruds.resource.fields.goal') }}</label>
                <select class="form-control select2 {{ $errors->has('goal') ? 'is-invalid' : '' }}" name="goal_id" id="goal_id">
                    @foreach($goals as $id => $goal)
                        <option value="{{ $id }}" {{ old('goal_id') == $id ? 'selected' : '' }}>{{ $goal }}</option>
                    @endforeach
                </select>
                @if($errors->has('goal_id'))
                    <span class="text-danger">{{ $errors->first('goal_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resource.fields.goal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.resource.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resource.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.resource.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.resource.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection