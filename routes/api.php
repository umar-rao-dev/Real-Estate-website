<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\QueryController;
use App\Http\Controllers\Api\AnnouncementController;

// PUBLIC ROUTES
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// PROTECTED ROUTES (requires Bearer token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Properties
    Route::get('properties', [PropertyController::class, 'index']);
    Route::get('properties/{id}', [PropertyController::class, 'show']);
    Route::get('properties/search', [PropertyController::class, 'search']);

    // Queries
    Route::post('queries', [QueryController::class, 'store']);
    Route::get('queries', [QueryController::class, 'index']);

    // Announcements
    Route::get('announcements', [AnnouncementController::class, 'index']);
});
