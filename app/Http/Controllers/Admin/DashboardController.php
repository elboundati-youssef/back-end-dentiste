<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Compter le nombre total de rendez-vous reçus aujourd'hui
        $appointmentsToday = Appointment::whereDate('created_at', Carbon::today())->count();

        // Compter le nombre total d'articles de blog
        $totalBlogs = Blog::count();

        // Envoyer les données à la vue admin/index.blade.php
        return view('admin.index', compact('appointmentsToday', 'totalBlogs'));
    }
}