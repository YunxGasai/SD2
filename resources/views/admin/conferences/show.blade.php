@extends('layouts.app')

@section('title', $conference['title'])

@section('content')
    <h1>{{ $conference['title'] }}</h1>

    <p>{{ __('conference.description') }}: {{ $conference['description'] }}</p>
    <p>{{ __('conference.lecturers') }}: {{ $conference['lecturers'] }}</p>
    <p>{{ __('conference.date') }}: {{ $conference['date'] }}</p>
    <p>{{ __('conference.time') }}: {{ $conference['time'] }}</p>
    <p>{{ __('conference.address') }}: {{ $conference['address'] }}</p>
    <p>@if ($conference['is_past']) {{ __('conference.past_badge') }} @else {{ __('conference.planned_badge') }} @endif</p>

    <p>
        <a href="{{ route('admin.conferences.edit', $conference['id']) }}">{{ __('admin.edit') }}</a>
        —
        <a href="{{ route('admin.conferences.index') }}">{{ __('conference.back_to_list') }}</a>
    </p>
@endsection
