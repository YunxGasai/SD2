<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('messages.app_title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="sd-body">
    <div class="sd-top">
        <div class="sd-top-inner">
            <div class="sd-logo">
                <a href="{{ route('home') }}">{{ __('messages.app_title') }}</a>
            </div>
            <div class="sd-user">
                {{ __('student.first_name') }} {{ __('student.last_name') }}
                <button type="button" disabled>{{ __('messages.nav_logout') }}</button>
            </div>
        </div>
    </div>

    <div class="sd-main">
        @yield('content')
    </div>
</body>
</html>
