@extends('layouts.app')

@section('title', __('admin.users_title'))

@section('content')
    <h1>{{ __('admin.users_title') }}</h1>

    @if (session('status'))
        <p style="color:green">{{ session('status') }}</p>
    @endif

    <p><a href="{{ route('admin.dashboard') }}">{{ __('conference.back_to_list') }}</a> ({{ __('admin.dashboard_title') }})</p>

    <table border="1" cellpadding="6" cellspacing="0" style="background:#fff">
        <tr>
            <th>{{ __('admin.user_first_name') }}</th>
            <th>{{ __('admin.user_last_name') }}</th>
            <th>{{ __('conference.email_col') }}</th>
            <th>{{ __('conference.actions_col') }}</th>
        </tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u['first_name'] }}</td>
                <td>{{ $u['last_name'] }}</td>
                <td>{{ $u['email'] }}</td>
                <td><a href="{{ route('admin.users.edit', $u['id']) }}">{{ __('admin.edit') }}</a></td>
            </tr>
        @endforeach
    </table>
@endsection
