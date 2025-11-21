<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
