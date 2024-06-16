<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreanimeRequest;
use App\Http\Requests\UpdateanimeRequest;
use App\Models\anime;

use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animes = Anime::leftJoin('anime_genres', 'animes.genre', '=', 'anime_genres.id')
        ->orderBy('animes.title', 'asc')
        ->select(
            'animes.id',
            'animes.title',
            'animes.genre',
            'animes.path',
            'animes.body',
            'anime_genres.name as genre_name',
        )
        ->get();

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
        $path = $request->file('image')->store('images', 'public');

        Anime::create([
            'title' => $request->title,
            'title_kana' => $request->title_kana,
            'season_1_opening' => $request->season_1_opening,
            'season_1_ending' => $request->season_1_ending,
            'season_2_opening' => $request->season_2_opening,
            'season_2_ending' => $request->season_2_ending,
            'path' => $path,
            'genre' => $request->genre,
            'body' => $request->body,
        ]);

        return to_route('anime.index')->with([
            'message' => '登録しました。',
            'status' => 'create',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(anime $anime)
    {

        $animeEdit = Anime::leftJoin('anime_genres', 'animes.genre', '=', 'anime_genres.id')
        ->leftJoin('music as season_1_opening_music', 'animes.season_1_opening', '=', 'season_1_opening_music.id')
        ->leftJoin('music as season_1_ending_music', 'animes.season_1_ending', '=', 'season_1_ending_music.id')
        ->leftJoin('music as season_2_opening_music', 'animes.season_2_opening', '=', 'season_2_opening_music.id')
        ->leftJoin('music as season_2_ending_music', 'animes.season_2_ending', '=', 'season_2_ending_music.id')
        ->where('animes.id', $anime->id)
        ->select(
            'animes.id',
            'animes.title',
            'animes.genre',
            'animes.path',
            'animes.body',
            'anime_genres.name as genre_name',
            'season_1_opening_music.title as season_1_opening_title',
            'season_1_opening_music.artist as season_1_opening_artist',
            'season_1_opening_music.youtube_url as season_1_opening_youtube_url',
            'season_1_ending_music.title as season_1_ending_title',
            'season_1_ending_music.artist as season_1_ending_artist',
            'season_1_ending_music.youtube_url as season_1_ending_youtube_url',
            'season_2_opening_music.title as season_2_opening_title',
            'season_2_opening_music.artist as season_2_opening_artist',
            'season_2_opening_music.youtube_url as season_2_opening_youtube_url',
            'season_2_ending_music.title as season_2_ending_title',
            'season_2_ending_music.artist as season_2_ending_artist',
            'season_2_ending_music.youtube_url as season_2_ending_youtube_url',
        )
        ->firstOrFail();

        return Inertia::render('Animes/Show', [
            'anime' => $animeEdit,
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
        $anime->title_kana = $request->title_kana;
        $anime->genre = $request->genre;
        $anime->season_1_opening = $request->season_1_opening;
        $anime->season_1_ending = $request->season_1_ending;
        $anime->season_2_opening = $request->season_2_opening;
        $anime->season_2_ending = $request->season_2_ending;
        $anime->body = $request->body;

        if ($request->hasFile('image')) {
            // 古い画像があれば削除
            if ($anime->path) {
                Storage::disk('public')->delete($anime->path);
            }
            // 新しい画像を保存
            $path = $request->file('image')->store('images', 'public');
            $anime->path = $path;
        }

        $anime->save();

        return to_route('anime.index')->with([
            'message' => '更新しました。',
            'status' => 'update',
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
