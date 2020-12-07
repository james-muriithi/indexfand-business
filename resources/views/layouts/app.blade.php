<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ trans('panel.site_descripion') }}" />
    <meta name="theme-color" content="{{ trans('panel.site_theme_color') }}" />

    <title>{{ trans('panel.site_title') }}</title>
    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('plugins/prismjs/prismjs.bundle1ff3.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bundle.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.bundle1ff3.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{asset('images/logos/favicon.ico')}}" />
</head>

<!--begin::Body-->
<body id="kt_body" style="background-image: url({{asset('images/bg/bg-10.jpg')}})" class="quick-panel-right demo-panel-right offcanvas-right header-fixed subheader-enabled page-loading">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
            @yield("content")
    </div>
    @yield('scripts')
</body>

</html>
