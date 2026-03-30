@extends('layouts.app')

@section('title', __('admin.dashboard_title'))

@section('content')
    <h1>{{ __('admin.dashboard_title') }}</h1>
    <ul>
        <li><a href="{{ route('admin.users.index') }}">{{ __('admin.link_users') }}</a></li>
        <li><a href="{{ route('admin.conferences.index') }}">{{ __('admin.link_conferences') }}</a></li>
    </ul>
@endsection
