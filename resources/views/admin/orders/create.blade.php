@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.orders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cutomer_id">{{ trans('cruds.order.fields.cutomer') }}</label>
                <select class="form-control select2 {{ $errors->has('cutomer') ? 'is-invalid' : '' }}" name="cutomer_id" id="cutomer_id" required>
                    @foreach($cutomers as $id => $cutomer)
                        <option value="{{ $id }}" {{ old('cutomer_id') == $id ? 'selected' : '' }}>{{ $cutomer }}</option>
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection