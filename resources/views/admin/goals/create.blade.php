@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.goal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.goals.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.goal.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.goal.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="confirmation_method">{{ trans('cruds.goal.fields.confirmation_method') }}</label>
                <input class="form-control {{ $errors->has('confirmation_method') ? 'is-invalid' : '' }}" type="text" name="confirmation_method" id="confirmation_method" value="{{ old('confirmation_method', '') }}">
                @if($errors->has('confirmation_method'))
                    <span class="text-danger">{{ $errors->first('confirmation_method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.confirmation_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="task_ile">{{ trans('cruds.goal.fields.task_ile') }}</label>
                <div class="needsclick dropzone {{ $errors->has('task_ile') ? 'is-invalid' : '' }}" id="task_ile-dropzone">
                </div>
                @if($errors->has('task_ile'))
                    <span class="text-danger">{{ $errors->first('task_ile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.goal.fields.task_ile_helper') }}</span>
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
    var uploadedTaskIleMap = {}
Dropzone.options.taskIleDropzone = {
    url: '{{ route('admin.goals.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="task_ile[]" value="' + response.name + '">')
      uploadedTaskIleMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedTaskIleMap[file.name]
      }
      $('form').find('input[name="task_ile[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($goal) && $goal->task_ile)
          var files =
            {!! json_encode($goal->task_ile) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="task_ile[]" value="' + file.file_name + '">')
            }
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