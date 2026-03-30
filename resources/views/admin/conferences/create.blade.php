@extends('layouts.app')

@section('title', __('admin.conference_new'))

@section('content')
    <h1>{{ __('admin.conference_create_h1') }}</h1>

    @if ($errors->any())
        <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    @endif

    <form method="post" action="{{ route('admin.conferences.store') }}">
        @csrf
        @include('admin.conferences._form', ['conference' => null])
        <p><button type="submit">{{ __('admin.save') }}</button></p>
    </form>
    <p><a href="{{ route('admin.conferences.index') }}">{{ __('conference.back_to_list') }}</a></p>
@endsection
