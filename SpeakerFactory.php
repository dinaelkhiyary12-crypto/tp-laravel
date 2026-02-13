<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $speakers = Speaker::all();
        return view('speakers.index', ['speakers' => $speakers]);
    }

    public function create()
    {
        return view('speakers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'email' => 'required|email|unique:speakers'
        ]);

        $speaker = new Speaker();
        $speaker->name = $request->name;
        $speaker->bio = $request->bio;
        $speaker->email = $request->email;
        $speaker->save();

        return redirect()->route('speakers.index')->with('success', 'Speaker created successfully.');
    }

    public function show(Speaker $speaker)
    {
        return view('speakers.show', ['speaker' => $speaker]);
    }

    public function edit(Speaker $speaker)
    {
        return view('speakers.edit', ['speaker' => $speaker]);
    }

    public function update(Request $request, Speaker $speaker)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'email' => 'required|email|unique:speakers,email,' . $speaker->id
        ]);

        $speaker->name = $request->name;
        $speaker->bio = $request->bio;
        $speaker->email = $request->email;
        $speaker->save();

        return redirect()->route('speakers.index')->with('success', 'Speaker updated successfully.');
    }

    public function destroy(Speaker $speaker)
    {
        $speaker->delete();
        return redirect()->route('speakers.index')->with('success', 'Speaker deleted successfully.');
    }
}
