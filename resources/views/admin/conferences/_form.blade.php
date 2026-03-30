@php
    $c = $conference ?? null;
@endphp

<p>
    <label>{{ __('conference.title_col') }} *<br>
        <input type="text" name="title" value="{{ old('title', $c->title ?? '') }}" required style="width:100%;max-width:400px">
    </label>
</p>
<p>
    <label>{{ __('conference.description') }} *<br>
        <textarea name="description" rows="3" required style="width:100%;max-width:500px">{{ old('description', $c->description ?? '') }}</textarea>
    </label>
</p>
<p>
    <label>{{ __('conference.lecturers') }} *<br>
        <input type="text" name="lecturers" value="{{ old('lecturers', $c->lecturers ?? '') }}" required style="width:100%;max-width:400px">
    </label>
</p>
<p>
    <label>{{ __('conference.date') }} *<br>
        <input type="date" name="date" value="{{ old('date', $c && $c->date ? $c->date->format('Y-m-d') : '') }}" required>
    </label>
</p>
<p>
    <label>{{ __('conference.time') }} *<br>
        <input type="text" name="time" value="{{ old('time', $c->time ?? '') }}" required placeholder="10:00">
    </label>
</p>
<p>
    <label>{{ __('conference.address') }} *<br>
        <input type="text" name="address" value="{{ old('address', $c->address ?? '') }}" required style="width:100%;max-width:400px">
    </label>
</p>
