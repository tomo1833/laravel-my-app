<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\anime;
use App\Models\education;
use App\Models\music;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $education = Education::count();
        $animeCount = Anime::count();
        $musicCount = Music::count();


        return Inertia::render('Dashboard', [
            'educationCount' => $education,
            'animeCount' => $animeCount,
            'musicCount' => $musicCount,
        ]);
    }
}
