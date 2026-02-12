<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog; 
use Illuminate\Support\Facades\Storage; // Important pour supprimer les images

class BlogController extends Controller
{
    // =========================================================================
    // 1. LISTER LES ARTICLES (GET /api/blogs)
    // =========================================================================
    public function index()
    {
        // On récupère les articles du plus récent au plus ancien
        $blogs = Blog::latest()->get()->map(function($blog) {
            $blog->image = $this->getFormatImageUrl($blog->image);
            return $blog;
        });

        return response()->json($blogs);
    }

    // =========================================================================
    // 2. VOIR UN ARTICLE (GET /api/blogs/{id})
    // =========================================================================
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Article introuvable'], 404);
        }

        $blog->image = $this->getFormatImageUrl($blog->image);

        return response()->json($blog);
    }

    // =========================================================================
    // 3. CRÉER UN ARTICLE (POST /api/blogs)
    // =========================================================================
    public function store(Request $request)
    {
        // 1. Validation des données reçues de React
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096', // Max 4MB
        ]);

        $imagePath = null;

        // 2. Gestion de l'upload d'image
        if ($request->hasFile('image')) {
            // Stocke l'image dans le dossier "storage/app/public/blogs"
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        // 3. Création en base de données
        $blog = Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imagePath,
            // 'user_id' => auth()->id(), // Décommentez si vous voulez lier à l'admin connecté
        ]);

        // On renvoie l'article créé avec l'URL formatée
        $blog->image = $this->getFormatImageUrl($blog->image);

        return response()->json([
            'message' => 'Article créé avec succès',
            'data' => $blog
        ], 201);
    }

    // =========================================================================
    // 4. MODIFIER UN ARTICLE (POST/PUT /api/blogs/{id})
    // Note: Avec FormData en React, il vaut mieux utiliser POST avec _method: PUT
    // =========================================================================
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Article introuvable'], 404);
        }

        // 1. Validation (parfois 'image' n'est pas requise si on ne la change pas)
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        // 2. Mise à jour des textes
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;

        // 3. Gestion de la nouvelle image (si envoyée)
        if ($request->hasFile('image')) {
            // A. Supprimer l'ancienne image si elle existe
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            // B. Upload de la nouvelle
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->save();

        $blog->image = $this->getFormatImageUrl($blog->image);

        return response()->json([
            'message' => 'Article mis à jour avec succès',
            'data' => $blog
        ]);
    }

    // =========================================================================
    // 5. SUPPRIMER UN ARTICLE (DELETE /api/blogs/{id})
    // =========================================================================
  public function destroy($id)
{
    $blog = Blog::find($id);

    if (!$blog) {
        return response()->json(['message' => 'Article introuvable'], 404);
    }

    // 1. Supprimer l'image physiquement du dossier storage
    if ($blog->image && \Storage::disk('public')->exists($blog->image)) {
        \Storage::disk('public')->delete($blog->image);
    }

    // 2. Supprimer l'entrée en base de données
    $blog->delete();

    return response()->json(['message' => 'Article supprimé avec succès']);
}

    // =========================================================================
    // HELPER : FORMATER L'URL DE L'IMAGE
    // =========================================================================
    private function getFormatImageUrl($imagePath)
    {
        if (!$imagePath) return null;

        // Si c'est déjà une URL complète (ex: https://via.placeholder.com...), on ne touche pas
        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        // Sinon, on génère l'URL complète vers le storage Laravel
        return asset('storage/' . $imagePath);
    }
}