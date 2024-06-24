<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreanimeRequest;
use App\Http\Requests\UpdateanimeRequest;

use App\Models\anime;
use App\Models\animeGenres;
use App\Models\music;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Inertia\Inertia;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = Auth::id();
        $user = Auth::user();

        $animes = Anime::leftJoin('anime_genres', 'animes.genre', '=', 'anime_genres.id')
        ->leftJoin('anime_users', function ($join) use ($userId) {
            $join->on('animes.id', '=', 'anime_users.anime_id')
                 ->where('anime_users.user_id', '=', $userId);
        })
        ->orderBy('animes.title_kana', 'asc')
        ->orderBy('animes.title', 'asc')
        ->select(
            'animes.id',
            'animes.title',
            'animes.genre',
            'animes.path',
            'animes.body',
            'anime_genres.name as genre_name',
            DB::raw('COALESCE(anime_users.watched, false) as watched'),
        )
        ->get()
        ->map(function ($anime) {
            $anime->watched = (bool) $anime->watched;
            return $anime;
        });

        return Inertia::render('Animes/Index', [
            'animes' => $animes,
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $musics = music::get();
        $formattedMusics = $musics->map(function ($music) {
            return [
                'value' => $music->id,
                'label' => $music->title.' : '. $music->artist,
            ];
        });
        $formattedMusics->prepend(['value' => 0, 'label' => '']);
        $formattedMusicsArray = $formattedMusics->toArray();

        $animeGenres = animeGenres::get();
        $formattedAnimeGenres = $animeGenres->map(function ($animeGenres) {
            return [
                'value' => $animeGenres->id,
                'label' => $animeGenres->name,
            ];
        });
        $formattedAnimeGenres->prepend(['value' => 0, 'label' => '']);
        $formattedAnimeGenresArray = $formattedAnimeGenres->toArray();

        return Inertia::render('Animes/Create', [
            'animeGenresList' => $formattedAnimeGenresArray,
            'musicList' => $formattedMusicsArray,
        ]);
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
        $musics = music::get();
        $formattedMusics = $musics->map(function ($music) {
            return [
                'value' => $music->id,
                'label' => $music->title.' : '. $music->artist,
            ];
        });
        $formattedMusics->prepend(['value' => 0, 'label' => '']);
        $formattedMusicsArray = $formattedMusics->toArray();

        $animeGenres = animeGenres::get();
        $formattedAnimeGenres = $animeGenres->map(function ($animeGenres) {
            return [
                'value' => $animeGenres->id,
                'label' => $animeGenres->name,
            ];
        });
        $formattedAnimeGenres->prepend(['value' => 0, 'label' => '']);
        $formattedAnimeGenresArray = $formattedAnimeGenres->toArray();

        return Inertia::render('Animes/Edit', [
            'anime' => $anime,
            'animeGenresList' => $formattedAnimeGenresArray,
            'musicList' => $formattedMusicsArray,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateanimeRequest $request, anime $anime)
    {
        $anime->title = $request->title;
        if (!is_null($request->title_kana) && $request->title_kana !== 'null') {
            $anime->title_kana = $request->title_kana;
        }
        if (!is_null($request->genre) && $request->genre !== 'null') {
            $anime->genre = $request->genre;
        }
        if (!is_null($request->season_1_opening) && $request->season_1_opening !== 'null') {
            $anime->season_1_opening = $request->season_1_opening;
        }
        if (!is_null($request->season_1_ending) && $request->season_1_ending !== 'null') {
            $anime->season_1_ending = $request->season_1_ending;
        }
        if (!is_null($request->season_2_opening) && $request->season_2_opening !== 'null') {
            $anime->season_2_opening = $request->season_2_opening;
        }
        if (!is_null($request->season_2_ending) && $request->season_2_ending !== 'null') {
            $anime->season_2_ending = $request->season_2_ending;
        }

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
            'status' => 'create',
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
           'status' => 'delete',
        ]);

    }
}
