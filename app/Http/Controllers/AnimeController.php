<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreanimeRequest;
use App\Http\Requests\UpdateanimeRequest;
use App\Models\anime;
use Inertia\Inertia;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animes = Anime::get();

        return Inertia::render('Animes/Index', [
            'animes' => $animes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Animes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreanimeRequest $request)
    {
        Anime::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('anime.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(anime $anime)
    {
        return Inertia::render('Animes/Show', [
            'anime' => $anime,
          ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(anime $anime)
    {
        return Inertia::render('Animes/Edit', [
            'anime' => $anime,
          ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateanimeRequest $request, anime $anime)
    {
        $anime->title = $request->title;
        $anime->body = $request->body;
        $anime->save();

        return to_route('anime.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(anime $anime)
    {
        $anime->delete();

        return to_route('anime.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);

    }
}
