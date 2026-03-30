@extends('layouts.app')

@section('title', __('messages.main_heading'))

@section('content')
    <h1>{{ __('messages.main_heading') }}</h1>

    @if (session('status'))
        <p class="alert alert-success">{{ session('status') }}</p>
    @endif

    <p class="text-muted mb-4">{{ __('messages.home_intro') }}</p>

    <h2>{{ __('messages.student_block_title') }}</h2>
    <ul>
        <li>{{ __('student.first_name') }}</li>
        <li>{{ __('student.last_name') }}</li>
        <li>{{ __('student.group_label') }}</li>
    </ul>

    <h2>{{ __('messages.subsystems_title') }}</h2>

    @guest
        <p class="text-muted">{{ __('messages.subsystems_guest_hint') }}</p>
        <p>
            <a href="{{ route('login') }}">{{ __('auth.nav_login') }}</a>
            —
            <a href="{{ route('register') }}">{{ __('auth.nav_register') }}</a>
        </p>
    @endguest

    @auth
        <ul>
            @if (auth()->user()->hasRole('client'))
                <li><a href="{{ route('client.index') }}">{{ __('messages.link_client') }}</a></li>
            @endif
            @if (auth()->user()->hasRole('employee'))
                <li><a href="{{ route('employee.index') }}">{{ __('messages.link_employee') }}</a></li>
            @endif
            @if (auth()->user()->hasRole('admin'))
                <li><a href="{{ route('admin.dashboard') }}">{{ __('messages.link_admin') }}</a></li>
            @endif
        </ul>
    @endauth
@endsection
