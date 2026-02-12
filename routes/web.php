<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ici, on ne garde que la page d'accueil par défaut pour vérifier que
| le serveur tourne. Tout le reste est dans routes/api.php.
|
*/

Route::get('/', function () {
    return view('welcome'); // Ou return "API is running";
});