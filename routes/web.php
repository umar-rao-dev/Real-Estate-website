<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page / welcome
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Contact form submission (User → Admin / Agent)
Route::post('/contact', [App\Http\Controllers\User\QueryController::class, 'store']);

// Public Property Routes
Route::get('/properties', [App\Http\Controllers\User\PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [App\Http\Controllers\User\PropertyController::class, 'show'])->name('properties.show');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Properties
    Route::resource('properties', App\Http\Controllers\Admin\PropertyController::class);

    // Users / Agents
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);

    // Agent Requests
    Route::get('agent-requests', [App\Http\Controllers\Admin\AgentRequestController::class, 'index'])->name('agent-requests.index');
    Route::post('agent-requests/{agentRequest}/approve', [App\Http\Controllers\Admin\AgentRequestController::class, 'approve'])->name('agent-requests.approve');
    Route::post('agent-requests/{agentRequest}/reject', [App\Http\Controllers\Admin\AgentRequestController::class, 'reject'])->name('agent-requests.reject');

    // Feedback
    Route::get('feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');

    // Announcements
    Route::resource('announcements', App\Http\Controllers\Admin\AnnouncementController::class);

    // Profile
    Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
*/

Route::prefix('agent')->name('agent.')->middleware(['agent'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Agent\AgentDashboardController::class, 'index'])->name('dashboard');

    // Properties
    Route::resource('properties', App\Http\Controllers\Agent\PropertyController::class);

    // Queries from users
    Route::get('queries', [App\Http\Controllers\Agent\QueryController::class, 'index'])->name('queries.index');
    Route::get('queries/{id}', [App\Http\Controllers\Agent\QueryController::class, 'show'])->name('queries.show');

    // Profile
    Route::get('profile', [App\Http\Controllers\Agent\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [App\Http\Controllers\Agent\ProfileController::class, 'update'])->name('profile.update');
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::prefix('user')->name('user.')->middleware(['user'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('dashboard');

    // Property browsing
    Route::get('properties', [App\Http\Controllers\User\PropertyController::class, 'index'])->name('properties.index');
    Route::get('properties/{id}', [App\Http\Controllers\User\PropertyController::class, 'show'])->name('properties.show');

    // Contact agent / queries
    Route::post('queries', [App\Http\Controllers\User\QueryController::class, 'store'])->name('queries.store');

    // Become Agent Request
    Route::post('agent-request', [App\Http\Controllers\User\AgentRequestController::class, 'store'])->name('agent-request.store');

    // Announcements
    Route::get('announcements', [App\Http\Controllers\User\AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/{id}', [App\Http\Controllers\User\AnnouncementController::class, 'show'])->name('announcements.show');

    // Profile
    Route::get('profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');
});
