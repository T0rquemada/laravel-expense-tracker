<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\NoteController;

// Routes for vue-router
$vue_router = [ '/',  '/sign-up-view',  '/sign-in-view'];
foreach ($vue_router as $route) {
    Route::get($route, function () { 
        return Inertia::render('Index'); 
    });
}

// Auth interaction
Route::post('/sign-up', [AuthController::class, 'register']);
Route::post('/sign-in', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/auto-login', [AuthController::class, 'auto_login']);

// Expense / income notes interaction
Route::post('/create_note', [NoteController::class, 'create']);