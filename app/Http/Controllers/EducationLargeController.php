<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeducationLargeRequest;
use App\Http\Requests\UpdateeducationLargeRequest;
use App\Models\educationLarge;
use Inertia\Inertia;

class EducationLargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationLarges = Educationlarge::get();

        return Inertia::render('Educationlarges/Index', [
            'educationLarges' => $educationLarges,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Educationlarges/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeducationLargeRequest $request)
    {
        Educationlarge::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return to_route('educationLarge.index')->with([
             'message' => '登録しました。',
             'status' => 'create',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(educationLarge $educationLarge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(educationLarge $educationLarge)
    {
        return Inertia::render('Educationlarges/Edit', [
            'educationLarge' => $educationLarge,
         ]);
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeducationLargeRequest $request, educationLarge $educationLarge)
    {
        $educationLarge->name = $request->name;
        $educationLarge->order = $request->order;
        $educationLarge->save();

        return to_route('educationLarge.index')->with([
           'message' => '登録しました。',
           'status' => 'create',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(educationLarge $educationLarge)
    {
        $educationLarge->delete();

        return to_route('educationLarge.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }
}
