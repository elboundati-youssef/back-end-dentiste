<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// TA ROUTE DE RENDEZ-VOUS
Route::post('/appointments', [AppointmentController::class, 'store']);



// Lecture (Public pour le site React)
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);

// Création (Normalement protégé, mais on le laisse ouvert pour ton test Postman)
Route::post('/blogs', [BlogController::class, 'store']);