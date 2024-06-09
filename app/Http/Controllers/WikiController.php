<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorewikiRequest;
use App\Http\Requests\UpdatewikiRequest;
use App\Models\wiki;
use Inertia\Inertia;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wikis = Wiki::get();

        return Inertia::render('Wikis/Index', [
            'wikis' => $wikis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Wikis/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorewikiRequest $request)
    {
        Wiki::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('wiki.index')->with([
             'message' => '登録しました。',
             'status' => 'create',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(wiki $wiki)
    {
        return Inertia::render('Wikis/Show', [
            'wiki' => $wiki,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(wiki $wiki)
    {
        return Inertia::render('Wikis/Edit', [
            'wiki' => $wiki,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatewikiRequest $request, wiki $wiki)
    {
        $wiki->title = $request->title;
        $wiki->body = $request->body;
        $wiki->save();

        return to_route('wiki.index')->with([
           'message' => '登録しました。',
           'status' => 'create',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wiki $wiki)
    {
        $wiki->delete();

        return to_route('wiki.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }
}
