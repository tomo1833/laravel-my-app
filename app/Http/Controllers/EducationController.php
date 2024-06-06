<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeducationRequest;
use App\Http\Requests\UpdateeducationRequest;
use App\Models\education;

use Inertia\Inertia;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Educations/Index', [
            'educations' => Education::orderBy('order', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Educations/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreeducationRequest $request)
    {
        Education::create([
            'title' => $request->title,
            'body' => $request->body_html,
            'body_html' => $request->body_html,
            'order' => $request->order,
        ]);

        return to_route('education.index')->with([
            'message' => '登録しました。',
            'status' => 'sucess',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(education $education)
    {
        return Inertia::render('Educations/Show', [
            'education' => $education,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(education $education)
    {
        return Inertia::render('Educations/Edit', [
            'education' => $education
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateeducationRequest $request, education $education)
    {
        $education->title = $request->title;
        $education->body = $request->body;
        $education->body_html = $request->body_html;
        $education->order = $request->order;
        $education->save();


        return to_route('education.index')->with([
            'message' => '更新しました。',
            'status' => 'sucess',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(education $education)
    {
        $education->delete();
        return to_route('education.index')->with([
            'message' => '削除しました。',
            'status' => 'danger',
        ]);
    }
}
