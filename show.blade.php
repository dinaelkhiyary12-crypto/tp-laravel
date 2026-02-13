@extends('layouts.app')

@section('content')
<h3>Event Details</h3>

<p><strong>Title:</strong> {{ $event->title }}</p>
<p><strong>Description:</strong> {{ $event->description }}</p>
<p><strong>Date:</strong> {{ $event->date }}</p>
<p><strong>Location:</strong> {{ $event->location }}</p>

<h4>Speakers:</h4>
<ul>
    @foreach($event->speakers as $speaker)
        <li>{{ $speaker->name }}</li>
    @endforeach
</ul>

<a href="{{ route('events.index') }}">Back to Events List</a>
<a href="{{ route('events.edit', $event->id) }}">Edit Event</a>
@endsection