@extends('layouts.app')

@section('content')
<h3>Participants</h3>

<a href="{{ route('participants.create') }}">Add Participant</a><br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>

    @forelse($participants as $participant)
        <tr>
            <td>{{ $participant->first_name }}</td>
            <td>{{ $participant->last_name }}</td>
            <td>{{ $participant->email }}</td>
            <td>{{ $participant->phone }}</td>
            <td>
                <a href="{{ route('participants.edit', $participant->id) }}">Edit</a>

                <form action="{{ route('participants.destroy', $participant->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">No participants found.</td>
        </tr>
    @endforelse
</table>
@endsection