@extends('layouts.app')

@section('title', __('conference.register_title'))

@section('content')
    <h1>{{ __('conference.register_title') }}</h1>
    <p class="lead">{{ $conference->title }}</p>

    <p>{{ __('conference.register_intro') }}</p>
    <ul class="bg-white border rounded p-3" style="max-width: 420px">
        <li><strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong></li>
        <li>{{ auth()->user()->email }}</li>
    </ul>

    @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form method="post" action="{{ route('client.conferences.register.store', $conference->id) }}" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-primary">{{ __('conference.register_submit') }}</button>
    </form>

    <p class="mt-3"><a href="{{ route('client.conferences.show', $conference->id) }}">{{ __('conference.back_to_list') }}</a></p>
@endsection
