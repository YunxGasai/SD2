@extends('layouts.app')

@section('title', __('messages.main_heading'))

@section('content')
    <h1>{{ __('messages.main_heading') }}</h1>

    <div class="sd-box">
        <h2>{{ __('messages.student_block_title') }}</h2>
        <ul>
            <li>{{ __('student.first_name') }}</li>
            <li>{{ __('student.last_name') }}</li>
            <li>{{ __('student.group_label') }}</li>
        </ul>
    </div>

    <div class="sd-box">
        <h2>{{ __('messages.subsystems_title') }}</h2>
        <div class="sd-links">
            <a href="{{ route('client.index') }}">{{ __('messages.link_client') }}</a>
            <a href="{{ route('employee.index') }}">{{ __('messages.link_employee') }}</a>
            <a href="{{ route('admin.dashboard') }}">{{ __('messages.link_admin') }}</a>
        </div>
    </div>
@endsection
