@extends('layouts.app')

@section('content')
<h3>Events List</h3>

<form method="GET" action="{{ route('events.index') }}">
    <input type="text" name="search" placeholder="Search by title" value="{{ request('search') }}">
    <button type="submit">Search</button>
</form>

<a href="{{ route('events.create') }}">Create Event</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Title</th>
        <th>Date</th>
        <th>Location</th>
        <th>Actions</th>
    </tr>
    @forelse($events as $event)
    <tr>
        <td>{{ $event->title }}</td>
        <td>{{ $event->date }}</td>
        <td>{{ $event->location }}</td>
        <td>
            <a href="{{ route('events.show', $event->id) }}">Show</a> |
            <a href="{{ route('events.edit', $event->id) }}">Edit</a> |

            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form> |

            <a href="{{ route('events.pdf', $event->id) }}">PDF</a> |
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">No events found.</td>
    </tr>
    @endforelse
</table>
@endsection