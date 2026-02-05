<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index']);

    // Categories
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);

    // Properties
    Route::resource('/properties', App\Http\Controllers\Admin\PropertyController::class);

    // Users
    Route::resource('/users', App\Http\Controllers\Admin\UserController::class);

    // Agent Requests
    Route::get('/agent-requests', [App\Http\Controllers\Admin\AgentRequestController::class, 'index']);
    Route::post('/agent-requests/{id}/approve', [App\Http\Controllers\Admin\AgentRequestController::class, 'approve']);
    Route::post('/agent-requests/{id}/reject', [App\Http\Controllers\Admin\AgentRequestController::class, 'reject']);

    // Feedback
    Route::get('/feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index']);

    // Announcements
    Route::resource('/announcements', App\Http\Controllers\Admin\AnnouncementController::class);

    // Profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit']);
    Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['agent'])->prefix('agent')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index']);

    // Properties
    Route::resource('/properties', App\Http\Controllers\Agent\PropertyController::class);

    // Queries
    Route::get('/queries', [App\Http\Controllers\Agent\QueryController::class, 'index']);
    Route::post('/queries/{id}/reply', [App\Http\Controllers\Agent\QueryController::class, 'reply']);

    // Profile
    Route::get('/profile', [App\Http\Controllers\Agent\ProfileController::class, 'edit']);
    Route::post('/profile', [App\Http\Controllers\Agent\ProfileController::class, 'update']);
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['user'])->prefix('user')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\User\UserDashboardController::class, 'index']);

    // View Properties
    Route::get('/properties', [App\Http\Controllers\User\PropertyController::class, 'index']);
    Route::get('/properties/{id}', [App\Http\Controllers\User\PropertyController::class, 'show']);

    // Send Query
    Route::post('/query', [App\Http\Controllers\User\QueryController::class, 'store']);

    // Agent Request
    Route::post('/agent-request', [App\Http\Controllers\User\AgentRequestController::class, 'store']);

    // Profile
    Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'edit']);
    Route::post('/profile', [App\Http\Controllers\User\ProfileController::class, 'update']);
});
