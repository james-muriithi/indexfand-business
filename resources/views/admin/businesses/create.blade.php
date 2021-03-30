@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.business.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.businesses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.business.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tag">{{ trans('cruds.business.fields.tag') }}</label>
                <input class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" type="text" name="tag" id="tag" value="{{ old('tag', '') }}" required>
                @if($errors->has('tag'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tag') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact">{{ trans('cruds.business.fields.contact') }}</label>
                <input class="form-control {{ $errors->has('contact') ? 'is-invalid' : '' }}" type="text" name="contact" id="contact" value="{{ old('contact', '') }}">
                @if($errors->has('contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.business.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="industry">{{ trans('cruds.business.fields.industry') }}</label>
                <input class="form-control {{ $errors->has('industry') ? 'is-invalid' : '' }}" type="text" name="industry" id="industry" value="{{ old('industry', '') }}">
                @if($errors->has('industry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('industry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.industry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.business.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="networth">{{ trans('cruds.business.fields.networth') }}</label>
                <input class="form-control {{ $errors->has('networth') ? 'is-invalid' : '' }}" type="number" name="networth" id="networth" value="{{ old('networth', '0') }}" step="0.01">
                @if($errors->has('networth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('networth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.networth_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="balance">{{ trans('cruds.business.fields.balance') }}</label>
                <input class="form-control {{ $errors->has('balance') ? 'is-invalid' : '' }}" type="number" name="balance" id="balance" value="{{ old('balance', '0') }}" step="0.01">
                @if($errors->has('balance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('balance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.business.fields.balance_helper') }}</span>
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