<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorenovelRequest;
use App\Http\Requests\UpdatenovelRequest;
use App\Models\novel;

use Inertia\Inertia;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $novels = Novel::get();

        return Inertia::render('Novels/Index', [
            'novels' => $novels,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Novels/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorenovelRequest $request)
    {
        Novel::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('novel.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(novel $novel)
    {
        return Inertia::render('Novels/Show', [
            'novel' => $novel,
         ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(novel $novel)
    {
        return Inertia::render('Novels/Edit', [
            'novel' => $novel,
         ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenovelRequest $request, novel $novel)
    {
        $novel->title = $request->title;
        $novel->body = $request->body;
        $novel->save();

        return to_route('novel.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(novel $novel)
    {
        $novel->delete();

        return to_route('novel.index')->with([
           'message' => '削除しました。',
           'status' => 'delete',
        ]);

    }
}
