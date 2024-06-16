<?php

use App\Http\Controllers\AnimeUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('anime-user/update', [AnimeUserController::class, 'update']);
