@extends('layouts.app')
@section('content')
    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                <!--begin::Aside header-->
                <a href="#" class="text-center mb-10">
                    <img src="{{asset('images/logos/logo-letter-1.png')}}" class="max-h-70px" alt="" />
                </a>
                <!--end::Aside header-->
                <!--begin::Aside title-->
                <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                    Discover Your Customers
                    <br />with <br />
                    {{ trans('panel.site_title') }}
                </h3>
                <!--end::Aside title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{asset('images/illustrations/login-visual-1.svg')}})"></div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form login-signin">
                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <!--begin::Form-->
                    <form class="form" method="POST" novalidate="novalidate" id="kt_login_signin_form" action="{{ route('login') }}">
                        @csrf
                        <!--begin::Title-->
                        <div class="pb-13 pt-lg-0 pt-5">
                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to {{ trans('panel.site_title') }}</h3>
                            <span class="text-muted font-weight-bold font-size-h4">New Here?
									<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
                        </div>
                        <!--begin::Title-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark">Phone Number:</label>
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg {{ $errors->has('phone') ? ' is-invalid' : '' }}" type="text" name="phone" autocomplete="off" placeholder="eg. 0712345678" value="{{ old('phone', null) }}" />
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Forgot Password ?</a>
                            </div>
                            <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="******" autocomplete="off" />
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <!--end::Form group-->
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" ame="remember" id="remember" {{ old('remember') ? 'checked' : '' }} id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">{{ trans('global.login') }}</button>
                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Content body-->
            <!--begin::Content footer-->
            <div class="d-flex justify-content-lg-start justify-content-center align-items-end py-7 py-lg-0">
                <div class="text-dark-50 font-size-lg font-weight-bolder mr-10">
                    <span class="mr-1">2020©</span>
                    <a href="http://indexfand.com" target="_blank" class="text-dark-75 text-hover-primary">Indexfand Group Ltd.</a>
                </div>
                <a href="#" class="text-primary font-weight-bolder font-size-lg">Terms</a>
                <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Plans</a>
                <a href="#" class="text-primary ml-5 font-weight-bolder font-size-lg">Contact Us</a>
            </div>
            <!--end::Content footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->

{{--<div class="row justify-content-center">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="card mx-4">--}}
{{--            <div class="card-body p-4">--}}
{{--                <h1>{{ trans('panel.site_title') }}</h1>--}}

{{--                <p class="text-muted">{{ trans('global.login') }}</p>--}}

{{--                @if(session('message'))--}}
{{--                    <div class="alert alert-info" role="alert">--}}
{{--                        {{ session('message') }}--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <form method="POST" action="{{ route('login') }}">--}}
{{--                    @csrf--}}

{{--                    <div class="input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text">--}}
{{--                                <i class="fa fa-user"></i>--}}
{{--                            </span>--}}
{{--                        </div>--}}

{{--                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">--}}

{{--                        @if($errors->has('email'))--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                {{ $errors->first('email') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="input-group mb-3">--}}
{{--                        <div class="input-group-prepend">--}}
{{--                            <span class="input-group-text"><i class="fa fa-lock"></i></span>--}}
{{--                        </div>--}}

{{--                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">--}}

{{--                        @if($errors->has('password'))--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                {{ $errors->first('password') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}

{{--                    <div class="input-group mb-4">--}}
{{--                        <div class="form-check checkbox">--}}
{{--                            <input class="form-check-input" name="remember" type="checkbox" id="remember" style="vertical-align: middle;" />--}}
{{--                            <label class="form-check-label" for="remember" style="vertical-align: middle;">--}}
{{--                                {{ trans('global.remember_me') }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <button type="submit" class="btn btn-primary px-4">--}}
{{--                                {{ trans('global.login') }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                        <div class="col-6 text-right">--}}
{{--                            @if(Route::has('password.request'))--}}
{{--                                <a class="btn btn-link px-0" href="{{ route('password.request') }}">--}}
{{--                                    {{ trans('global.forgot_password') }}--}}
{{--                                </a><br>--}}
{{--                            @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
