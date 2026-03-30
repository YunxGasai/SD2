<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('messages.app_title'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand navbar-white border-bottom bg-white mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ __('messages.app_title') }}</a>
            @auth
                <div class="navbar-nav flex-row gap-2 me-auto ms-3">
                    @if (auth()->user()->hasRole('client'))
                        <a class="nav-link py-0" href="{{ route('client.index') }}">{{ __('messages.link_client') }}</a>
                    @endif
                    @if (auth()->user()->hasRole('employee'))
                        <a class="nav-link py-0" href="{{ route('employee.index') }}">{{ __('messages.link_employee') }}</a>
                    @endif
                    @if (auth()->user()->hasRole('admin'))
                        <a class="nav-link py-0" href="{{ route('admin.dashboard') }}">{{ __('messages.link_admin') }}</a>
                    @endif
                </div>
            @endauth
            <div class="navbar-nav ms-auto flex-row align-items-center gap-2">
                @auth
                    <span class="navbar-text small">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                    <form action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('messages.nav_logout') }}</button>
                    </form>
                @else
                    <a class="nav-link py-0" href="{{ route('login') }}">{{ __('auth.nav_login') }}</a>
                    <a class="nav-link py-0" href="{{ route('register') }}">{{ __('auth.nav_register') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container pb-4">
        @yield('content')
    </main>
</body>
</html>
