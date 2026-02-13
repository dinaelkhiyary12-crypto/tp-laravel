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
        return view('speakers.index', compact('speakers'));
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

        Speaker::create($request->all());

        return redirect()->route('speakers.index')->with('success', 'Speaker created');
    }

    public function show(Speaker $speaker)
    {
        return view('speakers.show', compact('speaker'));
    }

    public function edit(Speaker $speaker)
    {
        return view('speakers.edit', compact('speaker'));
    }

    public function update(Request $request, Speaker $speaker)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required',
            'email' => 'required|email|unique:speakers,email,' . $speaker->id
        ]);

        $speaker->update($request->all());

        return redirect()->route('speakers.index')->with('success', 'Speaker updated');
    }

    public function destroy(Speaker $speaker)
    {
        $speaker->delete();
        return redirect()->route('speakers.index')->with('success', 'Speaker deleted');
    }
}
