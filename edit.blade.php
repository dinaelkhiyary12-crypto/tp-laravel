@extends('layouts.app')

@section('content')
<h3>Edit Event</h3>

<form method="POST" action="{{ route('events.update', $event->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $event->title }}" required><br><br>

    <textarea name="description" required>{{ $event->description }}</textarea><br><br>

    <input type="date" name="date" value="{{ $event->date }}" required><br><br>

    <input type="text" name="location" value="{{ $event->location }}" required><br><br>

    <label>Speakers:</label><br>
    <select name="speakers[]" multiple>
        @foreach($speakers as $speaker)
            <option value="{{ $speaker->id }}"
                {{ $event->speakers->contains($speaker->id) ? 'selected' : '' }}>
                {{ $speaker->name }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('events.index') }}">Back to Events List</a>
@endsection