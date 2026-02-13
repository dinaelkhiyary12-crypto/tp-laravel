<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $eventsQuery = Event::query();

        if ($request->has('search') && $request->search != '') {
            $eventsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $eventsQuery->get();

        return view('events.index', ['events' => $events]);
    }

    public function create()
    {
        $speakers = Speaker::all();
        return view('events.create', ['speakers' => $speakers]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->location = $request->location;
        $event->user_id = Auth::id();
        $event->save();

        if ($request->speakers) {
            $event->speakers()->attach($request->speakers);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    public function edit(Event $event)
    {
        $speakers = Speaker::all();
        return view('events.edit', [
            'event' => $event,
            'speakers' => $speakers
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->location = $request->location;
        $event->save();

        if ($request->speakers) {
            $event->speakers()->sync($request->speakers);
        } else {
            $event->speakers()->detach();
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function generatePdf(Event $event)
    {
        $pdf = Pdf::loadView('events.pdf', ['event' => $event]);
        return $pdf->download('event.pdf');
    }
}