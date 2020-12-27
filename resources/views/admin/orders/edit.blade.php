@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="cutomer_id">{{ trans('cruds.order.fields.customer') }}</label>
                <select class="form-control {{ $errors->has('cutomer') ? 'is-invalid' : '' }}" readonly="" name="cutomer_id" id="cutomer_id" required>
                    @foreach($cutomers as $id => $cutomer)
                        <option value="{{ $id }}" {{ (old('cutomer_id') ? old('cutomer_id') : $order->customer->id ?? '') == $id ? 'selected' : '' }}>{{ $cutomer }}</option>
                    @endforeach
                </select>
                @if($errors->has('cutomer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cutomer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.cutomer_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="status">{{ trans('cruds.order.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="number" name="status" id="status" value="{{ old('status', $order->status) }}" step="1">
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.order.fields.status_helper') }}</span>
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
