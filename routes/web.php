<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\PropertyController as UserPropertyController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\QueryController as UserQueryController;
use App\Http\Controllers\User\AgentRequestController as UserAgentRequestController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\AnnouncementController as UserAnnouncementController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\PropertyController as AgentPropertyController;
use App\Http\Controllers\Agent\OrderController as AgentOrderController;
use App\Http\Controllers\Agent\QueryController as AgentQueryController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AgentRequestController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/properties', [UserPropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [UserPropertyController::class, 'show'])->name('properties.show');

// User Protected Routes
Route::prefix('user')->name('user.')->middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders', [UserOrderController::class, 'store'])->name('orders.store');
    Route::post('/queries', [UserQueryController::class, 'store'])->name('queries.store');
    Route::post('/agent-request', [UserAgentRequestController::class, 'store'])->name('agent-request.store');
    Route::get('/announcements', [UserAnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
});

// Agent Protected Routes
Route::prefix('agent')->name('agent.')->middleware(['auth', 'agent'])->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', AgentPropertyController::class);
    Route::get('/orders', [AgentOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/update', [AgentOrderController::class, 'update'])->name('orders.update');
    Route::get('/queries', [AgentQueryController::class, 'index'])->name('queries.index');
    Route::get('/profile', [AgentProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [AgentProfileController::class, 'update'])->name('profile.update');
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('properties', AdminPropertyController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::resource('users', UserController::class);
    Route::get('/agent-requests', [AgentRequestController::class, 'index'])->name('agent-requests.index');
    Route::post('/agent-requests/{agentRequest}/approve', [AgentRequestController::class, 'approve'])->name('agent-requests.approve');
    Route::post('/agent-requests/{agentRequest}/reject', [AgentRequestController::class, 'reject'])->name('agent-requests.reject');
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::resource('announcements', AnnouncementController::class);
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
});
