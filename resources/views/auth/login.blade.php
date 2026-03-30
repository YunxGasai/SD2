@extends('layouts.app')

@section('title', __('auth.login_title'))

@section('content')
    <h1>{{ __('auth.login_title') }}</h1>

    @if ($errors->any())
        <ul class="text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('login.store') }}" class="bg-white p-3 border rounded" style="max-width: 420px">
        @csrf

        <p>
            <label>{{ __('auth.email') }}<br>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
            </label>
        </p>

        <p>
            <label>{{ __('auth.password') }}<br>
                <input type="password" name="password" class="form-control" required>
            </label>
        </p>

        <p>
            <label>
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                {{ __('auth.remember_me') }}
            </label>
        </p>

        <p>
            <button type="submit" class="btn btn-primary">{{ __('auth.login_button') }}</button>
        </p>
    </form>

    <p class="mt-3">
        <a href="{{ route('register') }}">{{ __('auth.nav_register') }}</a>
        —
        <a href="{{ route('home') }}">{{ __('auth.back_home') }}</a>
    </p>
@endsection
