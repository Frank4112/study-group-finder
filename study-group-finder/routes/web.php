<?php

use App\Http\Controllers\StudyRequestController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\SkillController;

Route::middleware(['auth'])->group(function () {
    Route::resource('study-requests', StudyRequestController::class);
    Route::resource('project-requests', ProjectRequestController::class);
    Route::resource('skills', SkillController::class);
});
Route::get('/', function () {
    return view('welcome');
});