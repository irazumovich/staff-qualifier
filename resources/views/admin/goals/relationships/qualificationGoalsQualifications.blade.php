<div class="m-3">
    @can('qualification_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.qualifications.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.qualification.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.qualification.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Qualification">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.qualification.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.qualification.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.qualification.fields.sign') }}
                            </th>
                            <th>
                                {{ trans('cruds.qualification.fields.next_qualification') }}
                            </th>
                            <th>
                                {{ trans('cruds.qualification.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.qualification.fields.qualification_goals') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($qualifications as $key => $qualification)
                            <tr data-entry-id="{{ $qualification->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $qualification->id ?? '' }}
                                </td>
                                <td>
                                    {{ $qualification->name ?? '' }}
                                </td>
                                <td>
                                    {{ $qualification->sign ?? '' }}
                                </td>
                                <td>
                                    {{ $qualification->next_qualification ?? '' }}
                                </td>
                                <td>
                                    {{ $qualification->description ?? '' }}
                                </td>
                                <td>
                                    @foreach($qualification->qualification_goals as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('qualification_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.qualifications.show', $qualification->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('qualification_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.qualifications.edit', $qualification->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('qualification_delete')
                                        <form action="{{ route('admin.qualifications.destroy', $qualification->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('qualification_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.qualifications.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Qualification:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection