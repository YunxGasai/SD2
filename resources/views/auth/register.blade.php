@extends('layouts.app')

@section('title', __('auth.register_title'))

@section('content')
    <h1>{{ __('auth.register_title') }}</h1>

    @if ($errors->any())
        <ul class="text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('register.store') }}" class="bg-white p-3 border rounded" style="max-width: 420px">
        @csrf

        <p>
            <label>{{ __('auth.first_name') }}<br>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
            </label>
        </p>

        <p>
            <label>{{ __('auth.last_name') }}<br>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
            </label>
        </p>

        <p>
            <label>{{ __('auth.email') }}<br>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </label>
        </p>

        <p>
            <label>{{ __('auth.password') }}<br>
                <input type="password" name="password" class="form-control" required>
            </label>
        </p>

        <p>
            <label>{{ __('auth.password_confirm') }}<br>
                <input type="password" name="password_confirmation" class="form-control" required>
            </label>
        </p>

        <p>
            <button type="submit" class="btn btn-primary">{{ __('auth.register_button') }}</button>
        </p>
    </form>

    <p class="mt-3">
        <a href="{{ route('login') }}">{{ __('auth.nav_login') }}</a>
        —
        <a href="{{ route('home') }}">{{ __('auth.back_home') }}</a>
    </p>
@endsection
