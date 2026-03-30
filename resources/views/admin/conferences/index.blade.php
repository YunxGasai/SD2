@extends('layouts.app')

@section('title', __('admin.conferences_title'))

@section('content')
    <h1>{{ __('admin.conferences_title') }}</h1>

    @if (session('status'))
        <p style="color:green">{{ session('status') }}</p>
    @endif
    @if (session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <p>
        <a href="{{ route('admin.conferences.create') }}">{{ __('admin.conference_new') }}</a>
        |
        <a href="{{ route('admin.dashboard') }}">{{ __('conference.back_to_list') }}</a>
    </p>

    <table border="1" cellpadding="6" cellspacing="0" style="background:#fff">
        <tr>
            <th>{{ __('conference.title_col') }}</th>
            <th>{{ __('conference.date_col') }}</th>
            <th>{{ __('conference.status_col') }}</th>
            <th>{{ __('conference.actions_col') }}</th>
        </tr>
        @foreach ($conferences as $c)
            <tr>
                <td>{{ $c->title }}</td>
                <td>{{ $c->date->format('Y-m-d') }}</td>
                <td>@if ($c->is_past) {{ __('conference.past_badge') }} @else {{ __('conference.planned_badge') }} @endif</td>
                <td>
                    <a href="{{ route('admin.conferences.show', $c->id) }}">{{ __('conference.view') }}</a>
                    <a href="{{ route('admin.conferences.edit', $c->id) }}">{{ __('admin.edit') }}</a>
                    @if ($c->is_past)
                        ({{ __('admin.delete') }})
                    @else
                        <form action="{{ route('admin.conferences.destroy', $c->id) }}" method="post" style="display:inline" onsubmit="return confirm('{{ __('admin.confirm_delete') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">{{ __('admin.delete') }}</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
