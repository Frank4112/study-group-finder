<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\StudyRequestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController as AuthPasswordController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StudyGroupController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SkillRequestController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

// Breeze authentication routes
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Authenticated Routes
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
    | Profile
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
    | Study Requests CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('study-requests', StudyRequestController::class);

    // Match UI
    Route::get('study-requests/{studyRequest}/match',
        [StudyRequestController::class, 'match']
    )->name('study-requests.match');

    Route::post(
        'study-requests/{studyRequest}/{target}/send-match-request',
        [StudyRequestController::class, 'sendMatchRequest']
    )->name('study-requests.send-match-request');

    Route::post('match/{match}/accept', [StudyRequestController::class, 'acceptMatch'])
        ->name('match.accept');

    Route::post('match/{match}/decline', [StudyRequestController::class, 'declineMatch'])
        ->name('match.decline');

    Route::post(
        'study-requests/{studyRequest}/create-group',
        [StudyRequestController::class, 'createGroupFromMatches']
    )->name('study-requests.create-group');


    /*
    |--------------------------------------------------------------------------
    | Projects & Skills CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('project-requests', ProjectRequestController::class);
    Route::resource('projects', ProjectsController::class);
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

    Route::post('study-groups/{studyGroup}/join', [StudyGroupController::class, 'join'])
        ->name('study-groups.join');

    Route::post('study-groups/{studyGroup}/leave', [StudyGroupController::class, 'leave'])
        ->name('study-groups.leave');

    Route::post(
        'study-groups/{studyGroup}/messages',
        [MessageController::class, 'store']
    )->name('study-groups.messages.store');

    Route::get('my-study-groups', [StudyGroupController::class, 'myGroups'])
        ->name('study-groups.my');


    /*
    |--------------------------------------------------------------------------
    | Messages (Unified entry point)
    |--------------------------------------------------------------------------
    |
    | This is your new /messages page, listing all study groups
    | the user belongs to, with last message preview.
    |
    */
    Route::get('messages', [MessageController::class, 'index'])
        ->name('messages.index');


    /*
    |--------------------------------------------------------------------------
    | Analytics
    |--------------------------------------------------------------------------
    */
    Route::get('analytics', [AnalyticsController::class, 'index'])
        ->name('analytics.index');


    /*
    |--------------------------------------------------------------------------
    | Study Profile
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
    | Logout (POST ONLY)
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
