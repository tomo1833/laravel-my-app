<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoremusicRequest;
use App\Http\Requests\UpdatemusicRequest;
use App\Models\music;
use Inertia\Inertia;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musics = Music::get();

        return Inertia::render('Musics/Index', [
            'musics' => $musics,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Musics/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremusicRequest $request)
    {
        Music::create([
            'title' => $request->title,
            'artist' => $request->artist,
            'youtube_url' => $request->youtube_url,
            'body' => $request->body,
        ]);

        return to_route('music.index')->with([
            'message' => '登録しました。',
            'status' => 'create',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(music $music)
    {
        return Inertia::render('Musics/Show', [
            'music' => $music,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(music $music)
    {
        return Inertia::render('Musics/Edit', [
            'music' => $music,
         ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemusicRequest $request, music $music)
    {
        $music->title = $request->title;
        $music->artist = $request->artist;
        $music->youtube_url = $request->youtube_url;
        $music->body = $request->body;
        $music->save();

        return to_route('music.index')->with([
           'message' => '登録しました。',
           'status' => 'create',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(music $music)
    {
        $music->delete();

        return to_route('music.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);

    }
}
