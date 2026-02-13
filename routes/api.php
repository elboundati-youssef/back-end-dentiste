<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AppointmentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- ROUTES PUBLIQUES (Accessibles par tout le monde) ---

// Authentification
Route::post('/login', [AuthController::class, 'login']);

// Lecture du Blog (Pour les visiteurs du site)
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::post('/appointments', [AppointmentController::class, 'store']);


// --- ROUTES PROTÉGÉES (Nécessitent un Token / Admin connecté) ---
Route::middleware('auth:sanctum')->group(function () {

    // Utilisateur & Session
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Gestion des Rendez-vous
    Route::get('/appointments', [AppointmentController::class, 'index']); // Voir la liste
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']); // Supprimer
    Route::put('/appointments/{id}/status', [AppointmentController::class, 'updateStatus']); // Changer statut
    Route::get('/appointments/{id}', [AppointmentController::class, 'show']);

    // Gestion du Blog (Actions Administrateur)
    Route::post('/blogs', [BlogController::class, 'store']);    // Créer
    Route::put('/blogs/{id}', [BlogController::class, 'update']); // Modifier
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']); // <--- SUPPRIMER AJOUTÉ ICI
});