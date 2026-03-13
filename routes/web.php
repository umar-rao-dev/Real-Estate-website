<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AgentRequestController as AdminAgentRequestController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\PropertyController as AgentPropertyController;
use App\Http\Controllers\Agent\OrderController as AgentOrderController;
use App\Http\Controllers\Agent\QueryController as AgentQueryController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\PropertyController as UserPropertyController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\QueryController as UserQueryController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\AgentRequestController as UserAgentRequestController;
use App\Http\Controllers\User\AnnouncementController as UserAnnouncementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// LANDING PAGE: User Dashboard (Publicly Accessible)
Route::get('/', [UserDashboardController::class, 'index'])->name('home');

// Auth Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Public Property Modules
Route::get('property/{id}', [UserPropertyController::class, 'show'])->name('properties.show');
Route::get('properties', [UserPropertyController::class, 'index'])->name('properties.index');

// Role Based Routes
Route::middleware(['auth'])->group(function () {

    // ADMIN ROUTES
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        
        // Property Management
        Route::resource('properties', AdminPropertyController::class);
        Route::post('properties/{property}/approve', [AdminPropertyController::class, 'approve'])->name('properties.approve');
        Route::post('properties/{property}/reject', [AdminPropertyController::class, 'reject'])->name('properties.reject');
        
        Route::resource('users', UserController::class);
        Route::get('agent-requests', [AdminAgentRequestController::class, 'index'])->name('agent-requests.index');
        Route::post('agent-requests/{agentRequest}/approve', [AdminAgentRequestController::class, 'approve'])->name('agent-requests.approve');
        Route::post('agent-requests/{agentRequest}/reject', [AdminAgentRequestController::class, 'reject'])->name('agent-requests.reject');
        
        Route::get('orders', function() {
            $orders = \App\Models\Order::with(['property', 'buyer', 'agent'])->latest()->get();
            return view('admin.orders.index', compact('orders'));
        })->name('orders.index');
        
        Route::get('feedback', [AdminFeedbackController::class, 'index'])->name('feedback.index');
        Route::delete('feedback/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedback.destroy');
        Route::resource('announcements', AdminAnnouncementController::class);
        Route::get('profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::post('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    });

    // AGENT ROUTES
    Route::prefix('agent')->name('agent.')->middleware('agent')->group(function () {
        Route::get('dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
        Route::resource('properties', AgentPropertyController::class);
        Route::get('orders', [AgentOrderController::class, 'index'])->name('orders.index');
        Route::post('orders/{order}/update', [AgentOrderController::class, 'update'])->name('orders.update');
        Route::get('queries', [AgentQueryController::class, 'index'])->name('queries.index');
        Route::get('profile', [AgentProfileController::class, 'index'])->name('profile.index');
        Route::post('profile', [AgentProfileController::class, 'update'])->name('profile.update');
    });

    // USER ROUTES (Protected)
    Route::prefix('user')->name('user.')->middleware('user')->group(function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::post('orders', [UserOrderController::class, 'store'])->name('orders.store');
        Route::post('queries', [UserQueryController::class, 'store'])->name('queries.store');
        Route::get('profile', [UserProfileController::class, 'index'])->name('profile.index');
        Route::post('profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::get('announcements', [UserAnnouncementController::class, 'index'])->name('announcements.index');
        Route::post('agent-request', [UserAgentRequestController::class, 'store'])->name('agent-request.store');
    });

});
