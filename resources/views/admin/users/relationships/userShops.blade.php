@can('shop_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.shops.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.shop.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.shop.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userShops">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.shop_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.short_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.industry') }}
                        </th>
                        <th>
                            {{ trans('cruds.shop.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shops as $key => $shop)
                        <tr data-entry-id="{{ $shop->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $shop->id ?? '' }}
                            </td>
                            <td>
                                {{ $shop->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $shop->shop_name ?? '' }}
                            </td>
                            <td>
                                {{ $shop->short_name ?? '' }}
                            </td>
                            <td>
                                {{ $shop->location ?? '' }}
                            </td>
                            <td>
                                {{ $shop->industry ?? '' }}
                            </td>
                            <td>
                                {{ $shop->description ?? '' }}
                            </td>
                            <td>
                                @can('shop_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.shops.show', $shop->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('shop_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.shops.edit', $shop->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('shop_delete')
                                    <form action="{{ route('admin.shops.destroy', $shop->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('shop_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shops.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userShops:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection