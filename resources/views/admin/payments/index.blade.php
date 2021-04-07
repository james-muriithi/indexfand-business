@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.payment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.sender_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.sender_contact') }}
                        </th>
                        <th>
                            Account
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        <tr data-entry-id="{{ $payment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $payment->sender_name ?? '' }}
                            </td>
                            <td>
                                {{ $payment->sender_contact ?? '' }}
                            </td>
                            <td>
                                {{ $payment->business->name ?? '' }}
                            </td>
                            <td>
                                {{ $payment->code ?? '' }}
                            </td>
                            <td>
                                {{ $payment->amount ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $payment->status ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $payment->status ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('payment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.payments.show', $payment->id) }}">
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
    dtButtons = dtButtons.filter((el) => {
        const notAllowedButtons = ['selectAll', 'selectNone', 'copy', 'csv'];
        return !notAllowedButtons.includes(el.extend);
    })
  let table = $('.datatable-Payment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
