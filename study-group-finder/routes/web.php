<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyRequestController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\StudyGroupController;
use App\Http\Controllers\MessageController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default route redirects to login (Breeze guest view)
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard (requires auth + email verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('study-requests', StudyRequestController::class);
});

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile routes (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // MEMBER 2 CRUD ROUTES
    Route::resource('study-requests', StudyRequestController::class);
    Route::resource('project-requests', ProjectRequestController::class);
    Route::resource('skills', SkillController::class);
});
// Matching
Route::get('study-requests/{studyRequest}/match', [StudyRequestController::class, 'match'])
    ->name('study-requests.match');
Route::post('study-requests/{studyRequest}/{target}/send-match-request', [StudyRequestController::class, 'sendMatchRequest'])
    ->name('study-requests.send-match-request');
Route::post('match/{match}/accept', [StudyRequestController::class, 'acceptMatch'])
    ->name('match.accept');
Route::post('match/{match}/decline', [StudyRequestController::class, 'declineMatch'])
    ->name('match.decline');
Route::post('study-requests/{studyRequest}/create-group', [StudyRequestController::class, 'createGroupFromMatches'])
    ->name('study-requests.create-group');


// Conversations
Route::get('conversations', [ConversationController::class, 'index'])->name('conversations.index');
Route::get('conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
Route::post('conversations/{conversation}/send', [ConversationController::class, 'sendMessage'])->name('conversations.send');


// Analytics
Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// Study profile
Route::get('study-profile', [UserProfileController::class, 'edit'])->name('study-profile.edit');
Route::put('study-profile', [UserProfileController::class, 'update'])->name('study-profile.update');


// existing routes...

Route::resource('study-requests', StudyRequestController::class);
Route::resource('project-requests', ProjectRequestController::class);
Route::resource('skills', SkillController::class);

// Matching – create group from a specific study request
Route::post('study-requests/{studyRequest}/create-group', 
    [StudyRequestController::class, 'createGroupFromMatches']
)->name('study-requests.create-group');

// Study groups
Route::get('study-groups', [StudyGroupController::class, 'index'])
    ->name('study-groups.index');

Route::get('study-groups/{studyGroup}', [StudyGroupController::class, 'show'])
    ->name('study-groups.show');

Route::post('study-groups/{studyGroup}/join', [StudyGroupController::class, 'join'])
    ->name('study-groups.join');

Route::post('study-groups/{studyGroup}/leave', [StudyGroupController::class, 'leave'])
    ->name('study-groups.leave');

// Group messages
Route::post('study-groups/{studyGroup}/messages', [MessageController::class, 'store'])
    ->name('study-groups.messages.store');

// Breeze authentication routes
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
