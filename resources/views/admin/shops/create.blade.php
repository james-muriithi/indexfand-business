@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.shop.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shops.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.shop.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shop_name">{{ trans('cruds.shop.fields.shop_name') }}</label>
                <input class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" type="text" name="shop_name" id="shop_name" value="{{ old('shop_name', '') }}" required>
                @if($errors->has('shop_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shop_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.shop_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="short_name">{{ trans('cruds.shop.fields.short_name') }}</label>
                <input class="form-control {{ $errors->has('short_name') ? 'is-invalid' : '' }}" type="text" name="short_name" id="short_name" value="{{ old('short_name', '') }}" required>
                @if($errors->has('short_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.short_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.shop.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', '') }}" required>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="industry">{{ trans('cruds.shop.fields.industry') }}</label>
                <input class="form-control {{ $errors->has('industry') ? 'is-invalid' : '' }}" type="text" name="industry" id="industry" value="{{ old('industry', '') }}" required>
                @if($errors->has('industry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('industry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.industry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.shop.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.description_helper') }}</span>
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