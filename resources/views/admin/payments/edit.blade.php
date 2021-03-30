@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="sender_name">{{ trans('cruds.payment.fields.sender_name') }}</label>
                <input class="form-control {{ $errors->has('sender_name') ? 'is-invalid' : '' }}" type="text" name="sender_name" id="sender_name" value="{{ old('sender_name', $payment->sender_name) }}">
                @if($errors->has('sender_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sender_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.sender_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sender_contact">{{ trans('cruds.payment.fields.sender_contact') }}</label>
                <input class="form-control {{ $errors->has('sender_contact') ? 'is-invalid' : '' }}" type="text" name="sender_contact" id="sender_contact" value="{{ old('sender_contact', $payment->sender_contact) }}">
                @if($errors->has('sender_contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sender_contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.sender_contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="receiver">{{ trans('cruds.payment.fields.receiver') }}</label>
                <input class="form-control {{ $errors->has('receiver') ? 'is-invalid' : '' }}" type="text" name="receiver" id="receiver" value="{{ old('receiver', $payment->receiver) }}">
                @if($errors->has('receiver'))
                    <div class="invalid-feedback">
                        {{ $errors->first('receiver') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.receiver_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code">{{ trans('cruds.payment.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $payment->code) }}">
                @if($errors->has('code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.payment.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $payment->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $payment->status || old('status', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.payment.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.status_helper') }}</span>
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