@extends('layouts.app')

@section('title', __('admin.conference_edit'))

@section('content')
    <h1>{{ __('admin.conference_edit') }}</h1>

    @if ($errors->any())
        <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    @endif

    <form method="post" action="{{ route('admin.conferences.update', $conference->id) }}">
        @csrf
        @method('PUT')
        @include('admin.conferences._form', ['conference' => $conference])
        <p><button type="submit">{{ __('admin.save') }}</button></p>
    </form>
    <p><a href="{{ route('admin.conferences.index') }}">{{ __('conference.back_to_list') }}</a></p>
@endsection
