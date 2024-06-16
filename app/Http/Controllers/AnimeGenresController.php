<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreanimeGenresRequest;
use App\Http\Requests\UpdateanimeGenresRequest;
use App\Models\animeGenres;

use Inertia\Inertia;

class AnimeGenresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animeGenress = Animegenres::get();

        return Inertia::render('AnimeGenress/Index', [
            'animeGenress' => $animeGenress,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('AnimeGenress/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreanimeGenresRequest $request)
    {
        Animegenres::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return to_route('animeGenres.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(animeGenres $animeGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(animeGenres $animeGenre)
    {
        return Inertia::render('AnimeGenress/Edit', [
            'animeGenres' => $animeGenre,
         ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateanimeGenresRequest $request, animeGenres $animeGenre)
    {
        $animeGenre->name = $request->name;
        $animeGenre->order = $request->order;
        $animeGenre->save();

        return to_route('animeGenres.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(animeGenres $animeGenres)
    {
        $animeGenres->delete();

        return to_route('animeGenres.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);

    }
}
