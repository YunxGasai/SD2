@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <h1 class="h4 mb-3">{{ $pageTitle }}</h1>
    <p class="text-muted">{{ __('messages.placeholder_body') }}</p>
@endsection
