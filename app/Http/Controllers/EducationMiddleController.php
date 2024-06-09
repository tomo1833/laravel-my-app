<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeducationMiddleRequest;
use App\Http\Requests\UpdateeducationMiddleRequest;
use App\Models\educationMiddle;
use Inertia\Inertia;

class EducationMiddleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationMiddles = Educationmiddle::get();

        return Inertia::render('Educationmiddles/Index', [
            'educationMiddles' => $educationMiddles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Educationmiddles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeducationMiddleRequest $request)
    {
        Educationmiddle::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return to_route('educationMiddle.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(educationMiddle $educationMiddle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(educationMiddle $educationMiddle)
    {
        return Inertia::render('Educationmiddles/Edit', [
            'educationMiddle' => $educationMiddle,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeducationMiddleRequest $request, educationMiddle $educationMiddle)
    {
        $educationMiddle->name = $request->name;
        $educationMiddle->order = $request->order;
        $educationMiddle->save();

        return to_route('educationMiddle.index')->with([
           'message' => '登録しました。',
           'status' => 'create',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(educationMiddle $educationMiddle)
    {
        $educationMiddle->delete();

        return to_route('educationMiddle.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);

    }
}
