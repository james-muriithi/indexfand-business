@extends('layouts.admin')
@section('content')

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
                    @foreach($businesses as $id => $business)
                        <option value="{{ $id }}" {{ old('business_id') == $id ? 'selected' : '' }}>{{ $business }}</option>
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
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.withdraw.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.withdraw.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.withdraw.fields.amount_helper') }}</span>
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