<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog; // On garde uniquement le modèle Blog
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Compter le nombre total d'articles de blog
        $totalBlogs = Blog::count();

        // 2. Récupérer les 5 derniers articles (Pour remplir le tableau du dashboard)
        $latestBlogs = Blog::latest()->take(5)->get();

        // Envoyer les données à la vue
        // Note : Assure-toi que le nom de ta vue est bien 'admin.index' ou 'dashboard'
        return view('admin.index', compact('totalBlogs', 'latestBlogs'));
    }
}