<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Nécessaire pour supprimer les images

class BlogController extends Controller
{
    // 1. AFFICHER LA LISTE (Cette fonction manquait !)
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    // 2. AFFICHER LE FORMULAIRE DE CRÉATION
    public function create()
    {
        return view('admin.blogs.create');
    }

    // 3. ENREGISTRER UN NOUVEL ARTICLE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
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

        return redirect()->route('admin.blogs.index')->with('success', 'Article publié avec succès !');
    }

    // 4. AFFICHER LE FORMULAIRE DE MODIFICATION
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    // 5. METTRE À JOUR L'ARTICLE
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['title', 'category', 'content']);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Article modifié avec succès !');
    }

    // 6. SUPPRIMER L'ARTICLE
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Article supprimé !');
    }
}