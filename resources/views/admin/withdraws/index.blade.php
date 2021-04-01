@extends('layouts.admin')
@section('content')
@can('withdraw_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.withdraws.create') }}">
                {{ trans('cruds.withdraw.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.withdraw.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Withdraw">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.business') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.withdraw.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraws as $key => $withdraw)
                        <tr data-entry-id="{{ $withdraw->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $withdraw->id ?? '' }}
                            </td>
                            <td>
                                {{ $withdraw->business->name ?? '' }}
                            </td>
                            <td>
                                {{ $withdraw->phone ?? '' }}
                            </td>
                            <td>
                                {{ $withdraw->amount ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $withdraw->status ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $withdraw->status ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('withdraw_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.withdraws.show', $withdraw->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
    dtButtons = dtButtons.filter((el) => {
        const notAllowedButtons = ['selectAll', 'selectNone', 'copy', 'csv'];
        return !notAllowedButtons.includes(el.extend);
    })
  let table = $('.datatable-Withdraw:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
