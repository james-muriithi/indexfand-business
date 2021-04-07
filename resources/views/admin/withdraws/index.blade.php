@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
@endsection
@section('content')
@can('withdraw_create')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.withdraw.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.withdraws.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="business_id">{{ trans('cruds.withdraw.fields.business') }}</label>
                    <select class="form-control select2 {{ $errors->has('business') ? 'is-invalid' : '' }}" name="business_id" id="business_id">
                        <option value="" selected>Please Select</option>
                        @foreach($businesses as $business)
                            <option
                                data-contact="{{$business->contact}}"
                                value="{{ $business->id }}" {{ old('business_id') == $business->id ? 'selected' : '' }}>
                                {{ $business->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('business'))
                        <div class="invalid-feedback">
                            {{ $errors->first('business') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.withdraw.fields.business_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="phone">{{ trans('cruds.withdraw.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" readonly>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="amount">{{ trans('cruds.withdraw.fields.amount') }}</label>
                    <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number"
                           name="amount" id="amount" value="{{ old('amount', '') }}" step="10" min="5" required>
                    @if($errors->has('amount'))
                        <div class="invalid-feedback">
                            {{ $errors->first('amount') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.withdraw.fields.amount_helper') }}</span>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">
                        Withdraw
                    </button>
                </div>
            </form>
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
                            {{ trans('cruds.withdraw.fields.created_at') }}
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
                                {{ $loop->iteration }}
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
                                {{ $withdraw->created_at ?? '' }}
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
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
  let table = $('.datatable-Withdraw:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
        $('#business_id').on('change', function (){
            if ($(this).find('option:selected').val()){
                $('#phone').val($(this).find('option:selected').data('contact'))
            }
        });

    @if (session()->has('success'))
        toastr.success("{{session()->get('success')}}"  );
    @endif
    @if (session()->has('error'))
        toastr.error("{{session()->get('error')}}");
    @endif

})

</script>
@endsection
