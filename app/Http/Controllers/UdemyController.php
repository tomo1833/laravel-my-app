<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreudemyRequest;
use App\Http\Requests\UpdateudemyRequest;
use App\Models\udemy;

use Inertia\Inertia;

class UdemyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $udemys = Udemy::get();

        return Inertia::render('Udemys/Index', [
            'udemys' => $udemys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Udemys/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreudemyRequest $request)
    {
        Udemy::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('udemy.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(udemy $udemy)
    {
        return Inertia::render('Udemys/Show', [
            'udemy' => $udemy,
         ]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(udemy $udemy)
    {
        return Inertia::render('Udemys/Edit', [
            'udemy' => $udemy,
         ]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateudemyRequest $request, udemy $udemy)
    {
        $udemy->title = $request->title;
        $udemy->body = $request->body;
        $udemy->save();

        return to_route('udemy.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(udemy $udemy)
    {
        $udemy->delete();

        return to_route('udemy.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }
}
