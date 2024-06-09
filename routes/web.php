<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WikiController;
use App\Http\Controllers\ShougiController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EducationLargeController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('attendance', AttendanceController::class)
->middleware(['auth', 'verified']);

Route::resource('education', EducationController::class)
->middleware(['auth', 'verified']);

Route::resource('camera', CameraController::class)
->middleware(['auth', 'verified']);

Route::post('/chatgpt', [ChatGPTController::class, 'chat']);

Route::resource('anime', AnimeController::class)
->middleware(['auth', 'verified']);

Route::resource('book', BookController::class)
->middleware(['auth', 'verified']);

Route::resource('blog', BlogController::class)
->middleware(['auth', 'verified']);

Route::resource('music', MusicController::class)
->middleware(['auth', 'verified']);

Route::resource('wiki', WikiController::class)
->middleware(['auth', 'verified']);

Route::resource('shougi', ShougiController::class)
->middleware(['auth', 'verified']);

Route::resource('manga', MangaController::class)
->middleware(['auth', 'verified']);

Route::resource('movie', MovieController::class)
->middleware(['auth', 'verified']);

Route::resource('educationLarge', EducationLargeController::class)
->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
