<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // 1. Validation automatique
        // Si ça échoue, Laravel renvoie automatiquement une erreur 422 au React
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ], [
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Format d\'email invalide.',
            'email.unique' => 'Vous êtes déjà inscrit à la newsletter.'
        ]);

        // 2. Création
        NewsletterSubscriber::create([
            'email' => $validated['email']
        ]);

        // 3. Réponse JSON
        return response()->json([
            'message' => 'Inscription réussie ! Merci.'
        ], 201);
    }
    public function index()
{
    // Retourne la liste complète des abonnés (triés par le plus récent)
    return response()->json(NewsletterSubscriber::orderBy('created_at', 'desc')->get());
}
}