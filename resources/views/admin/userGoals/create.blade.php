@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userGoal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-goals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userGoal.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userGoal.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="goal_id">{{ trans('cruds.userGoal.fields.goal') }}</label>
                <select class="form-control select2 {{ $errors->has('goal') ? 'is-invalid' : '' }}" name="goal_id" id="goal_id">
                    @foreach($goals as $id => $goal)
                        <option value="{{ $id }}" {{ old('goal_id') == $id ? 'selected' : '' }}>{{ $goal }}</option>
                    @endforeach
                </select>
                @if($errors->has('goal_id'))
                    <span class="text-danger">{{ $errors->first('goal_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userGoal.fields.goal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status">{{ trans('cruds.userGoal.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', '') }}">
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userGoal.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mentor_id">{{ trans('cruds.userGoal.fields.mentor') }}</label>
                <select class="form-control select2 {{ $errors->has('mentor') ? 'is-invalid' : '' }}" name="mentor_id" id="mentor_id">
                    @foreach($mentors as $id => $mentor)
                        <option value="{{ $id }}" {{ old('mentor_id') == $id ? 'selected' : '' }}>{{ $mentor }}</option>
                    @endforeach
                </select>
                @if($errors->has('mentor_id'))
                    <span class="text-danger">{{ $errors->first('mentor_id') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userGoal.fields.mentor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="result_file">{{ trans('cruds.userGoal.fields.result_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('result_file') ? 'is-invalid' : '' }}" id="result_file-dropzone">
                </div>
                @if($errors->has('result_file'))
                    <span class="text-danger">{{ $errors->first('result_file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userGoal.fields.result_file_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.resultFileDropzone = {
    url: '{{ route('admin.user-goals.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="result_file"]').remove()
      $('form').append('<input type="hidden" name="result_file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="result_file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($userGoal) && $userGoal->result_file)
      var file = {!! json_encode($userGoal->result_file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="result_file" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection