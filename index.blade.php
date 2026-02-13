@extends('layouts.app')

@section('content')
<h3>Speakers</h3>

<a href="{{ route('speakers.create') }}">Add Speaker</a><br><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    @forelse($speakers as $speaker)
        <tr>
            <td>{{ $speaker->name }}</td>
            <td>{{ $speaker->email }}</td>
            <td>
                <a href="{{ route('speakers.edit', $speaker->id) }}">Edit</a>

                <form action="{{ route('speakers.destroy', $speaker->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3">No speakers found.</td>
        </tr>
    @endforelse
</table>
@endsection