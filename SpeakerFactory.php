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

    // عرض قائمة المتحدثين
    public function index()
    {
        $speakers = Speaker::all();
        return view('speakers.index', ['speakers' => $speakers]);
    }

    // إظهار فورم إنشاء متحدث
    public function create()
    {
        return view('speakers.create');
    }

    // حفظ متحدث جديد
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

    // عرض تفاصيل المتحدث
    public function show(Speaker $speaker)
    {
        return view('speakers.show', ['speaker' => $speaker]);
    }

    // إظهار فورم تعديل المتحدث
    public function edit(Speaker $speaker)
    {
        return view('speakers.edit', ['speaker' => $speaker]);
    }

    // حفظ التعديلات على المتحدث
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

    // حذف المتحدث
    public function destroy(Speaker $speaker)
    {
        $speaker->delete();
        return redirect()->route('speakers.index')->with('success', 'Speaker deleted successfully.');
    }
}