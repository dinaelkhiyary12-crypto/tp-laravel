<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $participants = Participant::all();
        return view('participant.index', ['participants' => $participants]);
    }

    public function create()
    {
        return view('participant.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:participants',
            'phone' => 'required'
        ]);

        $participant = new Participant();
        $participant->first_name = $request->first_name;
        $participant->last_name = $request->last_name;
        $participant->email = $request->email;
        $participant->phone = $request->phone;
        $participant->save();

        return redirect()->route('participant.index')->with('success', 'Participant created successfully.');
    }

    public function show(Participant $participant)
    {
        return view('participant.show', ['participant' => $participant]);
    }

    public function edit(Participant $participant)
    {
        return view('participant.edit', ['participant' => $participant]);
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:participants,email,' . $participant->id,
            'phone' => 'required'
        ]);

        $participant->first_name = $request->first_name;
        $participant->last_name = $request->last_name;
        $participant->email = $request->email;
        $participant->phone = $request->phone;
        $participant->save();

        return redirect()->route('participant.index')->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participant.index')->with('success', 'Participant deleted successfully.');
    }
}