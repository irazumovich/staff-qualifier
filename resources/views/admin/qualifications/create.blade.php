@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.qualification.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.qualifications.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.qualification.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sign">{{ trans('cruds.qualification.fields.sign') }}</label>
                <input class="form-control {{ $errors->has('sign') ? 'is-invalid' : '' }}" type="text" name="sign" id="sign" value="{{ old('sign', '') }}" required>
                @if($errors->has('sign'))
                    <span class="text-danger">{{ $errors->first('sign') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.sign_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="next_qualification">{{ trans('cruds.qualification.fields.next_qualification') }}</label>
                <input class="form-control {{ $errors->has('next_qualification') ? 'is-invalid' : '' }}" type="number" name="next_qualification" id="next_qualification" value="{{ old('next_qualification') }}" step="1">
                @if($errors->has('next_qualification'))
                    <span class="text-danger">{{ $errors->first('next_qualification') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.next_qualification_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.qualification.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qualification_goals">{{ trans('cruds.qualification.fields.qualification_goals') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('qualification_goals') ? 'is-invalid' : '' }}" name="qualification_goals[]" id="qualification_goals" multiple>
                    @foreach($qualification_goals as $id => $qualification_goals)
                        <option value="{{ $id }}" {{ in_array($id, old('qualification_goals', [])) ? 'selected' : '' }}>{{ $qualification_goals }}</option>
                    @endforeach
                </select>
                @if($errors->has('qualification_goals'))
                    <span class="text-danger">{{ $errors->first('qualification_goals') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.qualification.fields.qualification_goals_helper') }}</span>
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