<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoremovieRequest;
use App\Http\Requests\UpdatemovieRequest;
use App\Models\movie;
use Inertia\Inertia;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $movies = Movie::get();

        return Inertia::render('Movies/Index', [
            'movies' => $movies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Movies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremovieRequest $request)
    {
        //
        Movie::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('movie.index')->with([
             'message' => '登録しました。',
             'status' => 'create',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(movie $movie)
    {
        return Inertia::render('Movies/Show', [
            'movie' => $movie,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(movie $movie)
    {
        return Inertia::render('Movies/Edit', [
          'movie' => $movie,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemovieRequest $request, movie $movie)
    {
        {
            $movie->title = $request->title;
            $movie->body = $request->body;
            $movie->save();

            return to_route('movie.index')->with([
               'message' => '登録しました。',
               'status' => 'create',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(movie $movie)
    {
        {
            $movie->delete();

            return to_route('movie.index')->with([
               'message' => '削除しました。',
               'status' => damger,
            ]);
        }
    }


}
