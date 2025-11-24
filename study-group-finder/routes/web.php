<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController as AuthPasswordController;

use App\Http\Controllers\StudyRequestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SkillRequestController;

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectRequestsController;
use App\Http\Controllers\ProjectJoinRequestController;

use App\Http\Controllers\StudyGroupController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/', fn() => redirect()->route('home'));

// Breeze auth routes
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated & Verified Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile Management
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/password', [AuthPasswordController::class, 'update'])
        ->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | Study Requests
    |--------------------------------------------------------------------------
    */
    Route::resource('study-requests', StudyRequestController::class);

    Route::get('study-requests/{studyRequest}/match', 
        [StudyRequestController::class, 'match']
    )->name('study-requests.match');

    Route::post('study-requests/{studyRequest}/{target}/send-match-request',
        [StudyRequestController::class, 'sendMatchRequest']
    )->name('study-requests.send-match-request');

    Route::post('match/{match}/accept', [StudyRequestController::class, 'acceptMatch'])
        ->name('match.accept');

    Route::post('match/{match}/decline', [StudyRequestController::class, 'declineMatch'])
        ->name('match.decline');

    Route::post('study-requests/{studyRequest}/create-group',
        [StudyRequestController::class, 'createGroupFromMatches']
    )->name('study-requests.create-group');


    /*
    |--------------------------------------------------------------------------
    | Project Requests (FULL CRUD)
    |--------------------------------------------------------------------------
    */
    Route::resource('project-requests', ProjectRequestsController::class);

    // Like Project Request
    Route::post('project-requests/{projectRequest}/like',
        [ProjectRequestsController::class, 'like']
    )->name('project-requests.like');

    /*
    |--------------------------------------------------------------------------
    | Project Join Requests (Join → Pending → Accept/Reject)
    |--------------------------------------------------------------------------
    */
    Route::post('project-requests/{projectRequest}/join-request',
        [ProjectJoinRequestController::class, 'store']
    )->name('project.join-request');

    Route::post('project-join-requests/{joinRequest}/accept',
        [ProjectJoinRequestController::class, 'accept']
    )->name('project.join-request.accept');

    Route::post('project-join-requests/{joinRequest}/reject',
        [ProjectJoinRequestController::class, 'reject']
    )->name('project.join-request.reject');


    /*
    |--------------------------------------------------------------------------
    | Projects (Separate from project-requests)
    |--------------------------------------------------------------------------
    */
    Route::resource('projects', ProjectsController::class);


    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */
    Route::resource('skills', SkillController::class);
    Route::resource('skill-requests', SkillRequestController::class);


    /*
    |--------------------------------------------------------------------------
    | Study Groups
    |--------------------------------------------------------------------------
    */
    Route::get('study-groups', [StudyGroupController::class, 'index'])
        ->name('study-groups.index');

    Route::get('study-groups/{studyGroup}', [StudyGroupController::class, 'show'])
        ->name('study-groups.show');

    Route::post('study-groups/{studyGroup}/join',
        [StudyGroupController::class, 'join']
    )->name('study-groups.join');

    Route::post('study-groups/{studyGroup}/leave',
        [StudyGroupController::class, 'leave']
    )->name('study-groups.leave');

    Route::delete('study-groups/{studyGroup}',
        [StudyGroupController::class, 'destroy']
    )->name('study-groups.destroy');

    Route::post('study-groups/{studyGroup}/messages',
        [MessageController::class, 'store']
    )->name('study-groups.messages.store');

    Route::get('my-study-groups', [StudyGroupController::class, 'myGroups'])
        ->name('study-groups.my');


    /*
    |--------------------------------------------------------------------------
    | Messages Overview
    |--------------------------------------------------------------------------
    */
    Route::get('messages', [MessageController::class, 'index'])
        ->name('messages.index');


    /*
    |--------------------------------------------------------------------------
    | Analytics Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('analytics', [AnalyticsController::class, 'index'])
        ->name('analytics.index');


    /*
    |--------------------------------------------------------------------------
    | Study Profile (User academic information)
    |--------------------------------------------------------------------------
    */
    Route::get('study-profile', [UserProfileController::class, 'edit'])
        ->name('study-profile.edit');

    Route::put('study-profile', [UserProfileController::class, 'update'])
        ->name('study-profile.update');


    /*
    |--------------------------------------------------------------------------
    | Settings Page
    |--------------------------------------------------------------------------
    */
    Route::get('settings', function () {
        return view('settings.index');
    })->name('settings');


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
