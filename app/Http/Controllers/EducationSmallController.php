<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeducationSmallRequest;
use App\Http\Requests\UpdateeducationSmallRequest;
use App\Models\educationSmall;
use Inertia\Inertia;


class EducationSmallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educationSmalls = Educationsmall::get();

        return Inertia::render('Educationsmalls/Index', [
            'educationSmalls' => $educationSmalls,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Educationsmalls/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeducationSmallRequest $request)
    {
        Educationsmall::create([
            'name' => $request->name,
            'order' => $request->order,
        ]);

        return to_route('educationSmall.index')->with([
             'message' => '登録しました。',
             'status' => 'sucess',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(educationSmall $educationSmall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(educationSmall $educationSmall)
    {
        return Inertia::render('Educationsmalls/Edit', [
            'educationSmall' => $educationSmall,
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeducationSmallRequest $request, educationSmall $educationSmall)
    {
        $educationSmall->name = $request->name;
        $educationSmall->order = $request->order;
        $educationSmall->save();

        return to_route('educationSmall.index')->with([
           'message' => '登録しました。',
           'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(educationSmall $educationSmall)
    {
        $educationSmall->delete();

        return to_route('educationSmall.index')->with([
           'message' => '削除しました。',
           'status' => 'damger',
        ]);
    }
}
