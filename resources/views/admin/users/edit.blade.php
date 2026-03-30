@extends('layouts.app')

@section('title', __('admin.user_edit'))

@section('content')
    <h1>{{ __('admin.user_edit') }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <p>
            <label>{{ __('admin.user_first_name') }} *<br>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required style="width:280px">
            </label>
        </p>
        <p>
            <label>{{ __('admin.user_last_name') }} *<br>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required style="width:280px">
            </label>
        </p>
        <p>
            <label>{{ __('conference.field_email') }} *<br>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width:280px">
            </label>
        </p>
        <p><button type="submit">{{ __('admin.save') }}</button></p>
    </form>

    <p><a href="{{ route('admin.users.index') }}">{{ __('conference.back_to_list') }}</a></p>
@endsection
