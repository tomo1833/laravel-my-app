<?php

namespace App\Http\Controllers;

use App\Models\anime;
use App\Models\animeUser;
use App\Models\education;
use App\Models\music;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $education = Education::count();
        $animeCount = Anime::count();
        $animeUserCount = AnimeUser::where('user_id', $userId)
        ->where('watched', 1)
        ->count();
        $musicCount = Music::count();


        return Inertia::render('Dashboard', [
            'educationCount' => $education,
            'animeCount' => $animeCount,
            'animeUserCount' => $animeUserCount,
            'musicCount' => $musicCount,
        ]);
    }
}
