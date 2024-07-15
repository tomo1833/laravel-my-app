<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreeducationRequest;
use App\Http\Requests\UpdateeducationRequest;
use App\Models\education;

use Illuminate\Support\Facades\Auth;

use App\Models\educationLarge;
use App\Models\educationMiddle;
use App\Models\educationSmall;
use App\Models\LearningProgress;

use Inertia\Inertia;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = Auth::id();
        $user = Auth::user();

        return Inertia::render('Educations/Index', [


            'educations' => Education::leftJoin('education_larges', 'educations.large_kbn', '=', 'education_larges.id')
            ->leftJoin('education_middles', 'educations.middle_kbn', '=', 'education_middles.id')
            ->leftJoin('education_smalls', 'educations.small_kbn', '=', 'education_smalls.id')
            ->leftJoin('learning_progress', 'educations.id', '=', 'learning_progress.education_id')
            ->where('learning_progress.user_id', '=', $userId)
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
                'learning_progress.score'
            )
            ->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $largeKbnList = educationLarge::get();
        $formattedLargeKbns = $largeKbnList->map(function ($largeKbn) {
            return [
                'value' => $largeKbn->id,
                'label' => $largeKbn->name,
            ];
        });
        $formattedLargeKbns->prepend(['value' => 0, 'label' => '']);
        $formattedLargeKbnArray = $formattedLargeKbns->toArray();

        $middleKbnList = educationMiddle::get();
        $formattedMiddleKbns = $middleKbnList->map(function ($middleKbn) {
            return [
                'value' => $middleKbn->id,
                'label' => $middleKbn->name,
            ];
        });
        $formattedMiddleKbns->prepend(['value' => 0, 'label' => '']);
        $formattedMiddleKbnArray = $formattedMiddleKbns->toArray();

        $smallKbnList = educationSmall::get();
        $formattedSmallKbns = $smallKbnList->map(function ($smallKbn) {
            return [
                'value' => $smallKbn->id,
                'label' => $smallKbn->name,
            ];
        });
        $formattedSmallKbns->prepend(['value' => 0, 'label' => '']);
        $formattedSmallKbnArray = $formattedSmallKbns->toArray();

        return Inertia::render('Educations/Create', ['largeKbnList' => $formattedLargeKbnArray, 'middleKbnList' => $formattedMiddleKbnArray, 'smallKbnList' => $formattedSmallKbnArray]);

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

        $largeKbnList = educationLarge::get();
        $formattedLargeKbns = $largeKbnList->map(function ($largeKbn) {
            return [
                'value' => $largeKbn->id,
                'label' => $largeKbn->name,
            ];
        });
        $formattedLargeKbns->prepend(['value' => 0, 'label' => '']);
        $formattedLargeKbnArray = $formattedLargeKbns->toArray();

        $middleKbnList = educationMiddle::get();
        $formattedMiddleKbns = $middleKbnList->map(function ($middleKbn) {
            return [
                'value' => $middleKbn->id,
                'label' => $middleKbn->name,
            ];
        });
        $formattedMiddleKbns->prepend(['value' => 0, 'label' => '']);
        $formattedMiddleKbnArray = $formattedMiddleKbns->toArray();

        $smallKbnList = educationSmall::get();
        $formattedSmallKbns = $smallKbnList->map(function ($smallKbn) {
            return [
                'value' => $smallKbn->id,
                'label' => $smallKbn->name,
            ];
        });
        $formattedSmallKbns->prepend(['value' => 0, 'label' => '']);
        $formattedSmallKbnArray = $formattedSmallKbns->toArray();

        return Inertia::render('Educations/Edit', [
            'education' => $education, 'largeKbnList' => $formattedLargeKbnArray, 'middleKbnList' => $formattedMiddleKbnArray, 'smallKbnList' => $formattedSmallKbnArray
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
