<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PropertyApiController;
use App\Http\Controllers\Api\QueryApiController;
use App\Http\Controllers\Api\AnnouncementApiController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Register & login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Sanctum-protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    // Properties
    Route::get('properties', [PropertyApiController::class, 'index']);
    Route::get('properties/{id}', [PropertyApiController::class, 'show']);
    Route::get('properties/search', [PropertyApiController::class, 'search']);

    // User → Queries
    Route::post('queries', [QueryApiController::class, 'store']);
    Route::get('queries', [QueryApiController::class, 'index']);

    // Announcements
    Route::get('announcements', [AnnouncementApiController::class, 'index']);
    Route::get('announcements/{id}', [AnnouncementApiController::class, 'show']);
});
