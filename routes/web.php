<?php

use App\Http\Controllers\DailyMoodController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('loading');
});

Route::get('/dashboard', [DailyMoodController::class, 'dashboard'])->name('dashboard');
Route::resource('daily-moods', DailyMoodController::class);

