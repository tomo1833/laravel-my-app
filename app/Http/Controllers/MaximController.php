<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoremaximRequest;
use App\Http\Requests\UpdatemaximRequest;
use App\Models\maxim;

use Inertia\Inertia;

class MaximController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maxims = Maxim::get();

        return Inertia::render('Maxims/Index', [
            'maxims' => $maxims,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Maxims/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremaximRequest $request)
    {
        Maxim::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('maxim.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(maxim $maxim)
    {
        return Inertia::render('Maxims/Show', [
            'maxim' => $maxim,
         ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(maxim $maxim)
    {
        return Inertia::render('Maxims/Edit', [
            'maxim' => $maxim,
         ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemaximRequest $request, maxim $maxim)
    {
        $maxim->title = $request->title;
        $maxim->body = $request->body;
        $maxim->save();

        return to_route('maxim.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(maxim $maxim)
    {
        $maxim->delete();

        return to_route('maxim.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }
}
