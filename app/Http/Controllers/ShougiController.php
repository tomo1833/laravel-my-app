<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreshougiRequest;
use App\Http\Requests\UpdateshougiRequest;
use App\Models\shougi;
use Inertia\Inertia;

class ShougiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $shougis = Shougi::get();

        return Inertia::render('Shougis/Index', [
            'shougis' => $shougis,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Shougis/Create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreshougiRequest $request)
    {
        Shougi::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('shougi.index')->with([
             'message' => '登録しました。',
             'status' => 'create',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(shougi $shougi)
    {
        return Inertia::render('Shougis/Show', [
          'shougi' => $shougi,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(shougi $shougi)
    {
        return Inertia::render('Shougis/Edit', [
          'shougi' => $shougi,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateshougiRequest $request, shougi $shougi)
    {
        $shougi->title = $request->title;
        $shougi->body = $request->body;
        $shougi->save();

        return to_route('shougi.index')->with([
           'message' => '登録しました。',
           'status' => 'create',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(shougi $shougi)
    {
        $shougi->delete();

        return to_route('shougi.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }

}
