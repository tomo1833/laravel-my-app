<?php

use App\Http\Controllers\LearningProgressController;
use App\Http\Controllers\AnimeUserController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('anime-user/update', [AnimeUserController::class, 'update']);

Route::get('learning-progress', [LearningProgressController::class, 'getUnderstanding']);
Route::post('submit-understanding', [LearningProgressController::class, 'update']);
