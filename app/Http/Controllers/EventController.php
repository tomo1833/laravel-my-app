<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = Auth::id();
        $events = Event::where('user_id', $userId)->get();
        return Inertia::render('Events/Index', ['events' => $events, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'is_public' => 'required|boolean',
        ]);

        Event::create([
            'title' => $request->input('title'),
            'start' => Carbon::parse($request->input('start'))->utc(),
            'end' => $request->input('end') ? Carbon::parse($request->input('end'))->utc() : null,
            'is_public' => $request->input('is_public'),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('events.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'is_public' => 'required|boolean',
        ]);

        $event->update([
            'title' => $request->input('title'),
            'start' => Carbon::parse($request->input('start'))->utc(),
            'end' => $request->input('end') ? Carbon::parse($request->input('end'))->utc() : null,
            'is_public' => $request->input('is_public'),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
    }
}
