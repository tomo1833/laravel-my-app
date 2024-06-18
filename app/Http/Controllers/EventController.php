<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $events = Event::all();
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
            'start' => $request->input('start'),
            'end' => $request->input('end'),
            'is_public' => $request->input('is_public'),
            'user_id' => $request->user()->id,
        ]);
    
        return redirect()->route('events.index');
    }
}
