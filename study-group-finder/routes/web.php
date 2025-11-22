<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudyRequestController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SkillRequestsController;
use App\Http\Controllers\StudyRequestsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectRequestsController;

Route::resource('projects', ProjectsController::class);
Route::resource('project_requests', ProjectRequestsController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('study-requests', StudyRequestController::class);
    Route::resource('project-requests', ProjectRequestController::class);
    Route::resource('skills', SkillController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', UsersController::class);

Route::resource('study_requests', StudyRequestsController::class);
Route::resource('skill_requests', SkillRequestsController::class);



