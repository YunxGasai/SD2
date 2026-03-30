@extends('layouts.app')

@section('title', __('admin.link_users'))

@section('content')
    <h1>{{ __('admin.link_users') }}</h1>
    <p>{{ __('admin.users_placeholder') }}</p>
    <p><a href="{{ route('admin.dashboard') }}">{{ __('conference.back_to_list') }}</a></p>
@endsection
