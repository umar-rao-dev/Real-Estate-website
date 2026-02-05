<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page / welcome
Route::get('/', function () {
    return view('welcome');
});

// Contact form submission (User → Admin / Agent)
Route::post('/contact', [App\Http\Controllers\User\QueryController::class, 'store']);


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index']);

    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Properties
    Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class);

    // Users / Agents
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Agent Requests
    Route::get('agent-requests', [App\Http\Controllers\Admin\AgentRequestController::class, 'index']);
    Route::post('agent-requests/{id}/approve', [App\Http\Controllers\Admin\AgentRequestController::class, 'approve']);
    Route::post('agent-requests/{id}/reject', [App\Http\Controllers\Admin\AgentRequestController::class, 'reject']);

    // Feedback
    Route::get('feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index']);

    // Announcements
    Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);

    // Profile
    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update']);
});


/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
*/

Route::prefix('agent')->middleware(['agent'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index']);

    // Properties
    Route::resource('properties', App\Http\Controllers\Agent\PropertyController::class);

    // Queries from users
    Route::get('queries', [App\Http\Controllers\Agent\QueryController::class, 'index']);
    Route::get('queries/{id}', [App\Http\Controllers\Agent\QueryController::class, 'show']);

    // Profile
    Route::get('profile', [App\Http\Controllers\Agent\ProfileController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Agent\ProfileController::class, 'update']);
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')->middleware(['user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\UserDashboardController::class, 'index']);

    // Property browsing
    Route::get('properties', [App\Http\Controllers\User\PropertyController::class, 'index']);
    Route::get('properties/{id}', [App\Http\Controllers\User\PropertyController::class, 'show']);

    // Contact agent / queries
    Route::post('queries', [App\Http\Controllers\User\QueryController::class, 'store']);

    // Become Agent Request
    Route::post('agent-request', [App\Http\Controllers\User\AgentRequestController::class, 'store']);

    // Announcements
    Route::get('announcements', [App\Http\Controllers\User\AnnouncementController::class, 'index']);
    Route::get('announcements/{id}', [App\Http\Controllers\User\AnnouncementController::class, 'show']);

    // Profile
    Route::get('profile', [App\Http\Controllers\User\ProfileController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\User\ProfileController::class, 'update']);
});
