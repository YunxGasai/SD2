@extends('layouts.app')

@section('title', __('messages.main_heading'))

@section('content')
    <h1 class="h3 mb-3">{{ __('messages.main_heading') }}</h1>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ __('messages.bootstrap_hint') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h2 class="h5 card-title">{{ __('messages.student_block_title') }}</h2>
            <ul class="mb-0 ps-3">
                <li>{{ __('student.first_name') }}</li>
                <li>{{ __('student.last_name') }}</li>
                <li>{{ __('student.group_label') }}</li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="h5 card-title">{{ __('messages.subsystems_title') }}</h2>
            <div class="d-grid gap-2 col-md-6">
                <a class="btn btn-primary" href="{{ route('client.index') }}">{{ __('messages.link_client') }}</a>
                <a class="btn btn-primary" href="{{ route('employee.index') }}">{{ __('messages.link_employee') }}</a>
                <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">{{ __('messages.link_admin') }}</a>
            </div>
        </div>
    </div>
@endsection
