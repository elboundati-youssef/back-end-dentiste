<?php

namespace App\Http\Controllers; // <--- C'est ici que l'erreur se trouvait (c'était écrit \Admin)

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog; 

class BlogController extends Controller
{
    // Récupérer tous les articles
    public function index()
    {
        $blogs = Blog::latest()->get();
        return response()->json($blogs);
    }

    // Récupérer un article spécifique
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Article introuvable'], 404);
        }

        return response()->json($blog);
    }
}