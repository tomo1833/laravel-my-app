<?php

namespace App\Http\Controllers;

use App\Models\LearningProgress;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LearningProgressController extends Controller
{

    /**
     * 
     */
    public function getUnderstanding(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'educationId' => 'required|integer|exists:educations,id',
        ]);

        $userId = $request->input('user_id');
        $educationId = $request->input('educationId');

        $learningProgress = LearningProgress::where('user_id', $userId)->where('education_id', $educationId)->first();

        if ($learningProgress) {
            return response()->json(['score' => $learningProgress->score]);
        } else {
            return response()->json(['score' => 0]);
        }
    }

    /**
     *
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'educationId' => 'required|integer',
                'score' => 'required|integer'
            ]);

            $userId = $request->input('user_id');
            $educationId = $request->input('educationId');

            $learningProgress = LearningProgress::where('user_id', $userId)->where('education_id', $educationId)->first();

            if ($learningProgress) {
                $learningProgress->score = $request->input('score');
            } else {
                $learningProgress = new LearningProgress();
                $learningProgress->education_id = $educationId;
                $learningProgress->user_id = $userId;
                $learningProgress->score = $request->input('score');
            }

            $learningProgress->save();

            return response()->json(['message' => '視聴状況が更新されました']);
        } catch (\Exception $e) {
            return response()->json(['message' => '視聴状況の更新に失敗しました', 'error' => $e->getMessage()], 500);
        }

    }
}
