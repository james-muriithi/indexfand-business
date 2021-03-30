@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.business.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Business">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.business.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.tag') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.contact') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.industry') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.networth') }}
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.balance') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($businesses as $key => $business)
                        <tr data-entry-id="{{ $business->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $business->id ?? '' }}
                            </td>
                            <td>
                                {{ $business->name ?? '' }}
                            </td>
                            <td>
                                {{ $business->tag ?? '' }}
                            </td>
                            <td>
                                {{ $business->contact ?? '' }}
                            </td>
                            <td>
                                {{ $business->email ?? '' }}
                            </td>
                            <td>
                                {{ $business->industry ?? '' }}
                            </td>
                            <td>
                                {{ $business->networth ?? '' }}
                            </td>
                            <td>
                                {{ $business->balance ?? '' }}
                            </td>
                            <td>
                                @can('business_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.businesses.show', $business->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('business_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.businesses.edit', $business->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('business_deletes')
                                    <form action="{{ route('admin.businesses.destroy', $business->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('business_deletes')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.businesses.massDestroy') }}",
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
    dtButtons = dtButtons.filter((el) => el.extend != 'selectAll' && el.extend != 'selectNone')
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Business:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
