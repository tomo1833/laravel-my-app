<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\AnimeUser;

class AnimeUserController extends Controller
{
    public function update(Request $request)
    {
        try {
            $request->validate([
                'anime_id' => 'required|integer|exists:animes,id',
                'watched' => 'required|boolean',
                'user_id' => 'required|integer|exists:users,id', // ユーザーIDのバリデーション
            ]);

            $userId = $request->input('user_id'); // リクエストからユーザーIDを取得
            $animeId = $request->input('anime_id');

            $animeUser = AnimeUser::where('user_id', $userId)->where('anime_id', $animeId)->first();

            if ($animeUser) {
                $animeUser->watched = $request->input('watched');
            } else {
                $animeUser = new AnimeUser();
                $animeUser->user_id = $userId;
                $animeUser->anime_id = $animeId;
                $animeUser->watched = $request->input('watched');
            }

            $animeUser->save();

            return response()->json(['message' => '視聴状況が更新されました']);
        } catch (\Exception $e) {
            Log::error('視聴状況の更新に失敗しました: ' . $e->getMessage());
            return response()->json(['message' => '視聴状況の更新に失敗しました', 'error' => $e->getMessage()], 500);
        }

    }
}
