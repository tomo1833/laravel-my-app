<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AnimeGenresController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\BroadcastPeriodController;
use App\Http\Controllers\BlogController;

use App\Http\Controllers\CameraController;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\DataController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EducationLargeController;
use App\Http\Controllers\EducationMiddleController;
use App\Http\Controllers\EducationSmallController;

use App\Http\Controllers\EventController;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\MaximController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShougiController;
use App\Http\Controllers\WikiController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UdemyController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\UserController;

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

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'verified']);

Route::resource('attendance', AttendanceController::class)
->middleware(['auth', 'verified']);

Route::resource('education', EducationController::class)
->middleware(['auth', 'verified']);

Route::resource('camera', CameraController::class)
->middleware(['auth', 'verified']);

Route::post('/chatgpt', [ChatGPTController::class, 'chat']);

Route::resource('anime', AnimeController::class)
->middleware(['auth', 'verified', 'role:member']);

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


// マスター関連
Route::resource('educationLarge', EducationLargeController::class)
->middleware(['auth', 'verified', 'role:admin']);

Route::resource('educationMiddle', EducationMiddleController::class)
->middleware(['auth', 'verified', 'role:admin']);

Route::resource('educationSmall', EducationSmallController::class)
->middleware(['auth', 'verified', 'role:admin']);

Route::resource('animeGenres', AnimeGenresController::class)
->middleware(['auth', 'verified', 'role:admin']);

Route::resource('broadcast_period', BroadcastPeriodController::class)
->middleware(['auth', 'verified', 'role:admin']);



Route::resource('novel', NovelController::class)
->middleware(['auth', 'verified']);

Route::resource('udemy', UdemyController::class)
->middleware(['auth', 'verified']);

Route::resource('maxim', MaximController::class)
->middleware(['auth', 'verified']);

Route::resource('todo', TodoController::class)
->middleware(['auth', 'verified']);

Route::patch('/todo/{todo}/status', [TodoController::class, 'updateStatus'])->name('todo.updateStatus');

Route::get('/image-upload', [ImageController::class, 'index'])->name('images.index');
Route::post('/image-upload', [ImageController::class, 'store'])->name('images.store');

Route::resource('events', EventController::class);

Route::get('flow', [FlowController::class, 'index'])->name('flow.index');

/**
 *
 */
Route::get('data', [DataController::class, 'index'])->name('data.index');
Route::get('/download-json', [DataController::class, 'downloadJson']);


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('user', UserController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
