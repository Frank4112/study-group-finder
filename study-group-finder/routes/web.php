<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\StudyRequestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StudyGroupController;
use App\Http\Controllers\MessageController;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\SkillRequestsController;
use App\Http\Controllers\ProjectsController;



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

// Breeze login/register
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
        


    /*
    |--------------------------------------------------------------------------
    | CRUD Routes
    |--------------------------------------------------------------------------
    */

    Route::resource('study-requests', StudyRequestController::class);
    Route::resource('project-requests', ProjectRequestController::class);
    Route::resource('projects', ProjectsController::class);
    Route::resource('skills', SkillController::class);


    /*
    |--------------------------------------------------------------------------
    | Matching + Study Groups
    |--------------------------------------------------------------------------
    */

    // Match listing UI
    Route::get('study-requests/{studyRequest}/match',
        [StudyRequestController::class, 'match']
    )->name('study-requests.match');

    // Send match request
    Route::post(
        'study-requests/{studyRequest}/{target}/send-match-request',
        [StudyRequestController::class, 'sendMatchRequest']
    )->name('study-requests.send-match-request');

    // Accept/Decline match
    Route::post('match/{match}/accept', [StudyRequestController::class, 'acceptMatch'])
        ->name('match.accept');

    Route::post('match/{match}/decline', [StudyRequestController::class, 'declineMatch'])
        ->name('match.decline');

    // Auto-create study group from matches
    Route::post(
        'study-requests/{studyRequest}/create-group',
        [StudyRequestController::class, 'createGroupFromMatches']
    )->name('study-requests.create-group');


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

    // Group messages
    Route::post(
        'study-groups/{studyGroup}/messages',
        [MessageController::class, 'store']
    )->name('study-groups.messages.store');
    Route::get('my-study-groups', [StudyGroupController::class, 'myGroups'])
    ->name('study-groups.my');



    /*
    |--------------------------------------------------------------------------
    | Conversations
    |--------------------------------------------------------------------------
    */
    Route::get('conversations', [ConversationController::class, 'index'])
        ->name('conversations.index');

    Route::get('conversations/{conversation}', [ConversationController::class, 'show'])
        ->name('conversations.show');

    Route::post(
        'conversations/{conversation}/send',
        [ConversationController::class, 'sendMessage']
    )->name('conversations.send');


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
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
