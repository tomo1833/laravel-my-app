<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeducationRequest;
use App\Http\Requests\UpdateeducationRequest;
use App\Models\education;

use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Educations/Index', [

            'educations' => Education::leftJoin('education_larges', 'educations.large_kbn', '=', 'education_larges.id')
            ->leftJoin('education_middles', 'educations.middle_kbn', '=', 'education_middles.id')
            ->leftJoin('education_smalls', 'educations.small_kbn', '=', 'education_smalls.id')
            ->orderBy('educations.order', 'asc')
            ->select(
                'educations.id',
                'educations.title',
                'educations.body',
                'educations.body_html',
                'educations.order',
                'educations.large_kbn',
                'educations.middle_kbn',
                'education_larges.name as large_name',
                'education_middles.name as middle_name',
                'education_smalls.name as small_name',
            )
            ->get(),

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
            'large_kbn' => $request->large_kbn,
            'middle_kbn' => $request->middle_kbn,
            'small_kbn' => $request->small_kbn,
        ]);

        return to_route('education.index')->with([
            'message' => '登録しました。',
            'status' => 'create',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(education $education)
    {
        $userId = Auth::id();
        $user = Auth::user();

        return Inertia::render('Educations/Show', [
            'education' => $education,
            'user' => $user,

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
        $education->large_kbn = $request->large_kbn;
        $education->middle_kbn = $request->middle_kbn;
        $education->small_kbn = $request->small_kbn;

        $education->save();

        return to_route('education.index')->with([
            'message' => '更新しました。',
            'status' => 'create',
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
            'status' => 'delete',
        ]);
    }
}
