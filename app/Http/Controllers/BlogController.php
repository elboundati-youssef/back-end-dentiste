<?php

namespace App\Http\Controllers\Admin; // ⚠️ Note le namespace "Admin"

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // 1. AFFICHER LA LISTE (Pour le Dashboard)
    public function index()
    {
        // On récupère les articles (Models) pour les passer à la vue Blade
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    // 2. AFFICHER LE FORMULAIRE DE CRÉATION
    public function create()
    {
        return view('admin.blogs.create');
    }

    // 3. ENREGISTRER L'ARTICLE (Depuis le formulaire Admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048' // Max 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imagePath
        ]);

        // ⚠️ IMPORTANT : Redirection vers la liste (pas de JSON ici !)
        return redirect()->route('admin.blogs.index')->with('success', 'Article publié avec succès !');
    }
}