@extends('layouts.app')

@section('content')
<h3>Create Event</h3>

<form method="POST" action="{{ route('events.store') }}">
    @csrf

    <input type="text" name="title" placeholder="Title" required><br><br>

    <textarea name="description" placeholder="Description" required></textarea><br><br>

    <input type="date" name="date" required><br><br>

    <input type="text" name="location" placeholder="Location" required><br><br>

    <label>Speakers:</label><br>
    <select name="speakers[]" multiple>
        @foreach($speakers as $speaker)
            <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
        @endforeach
    </select><br><br>

    <button type="submit">Save</button>
</form>

<a href="{{ route('events.index') }}">Back to Events List</a>
@endsection