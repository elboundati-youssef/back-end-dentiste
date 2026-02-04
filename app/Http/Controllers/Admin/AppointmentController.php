<?php

namespace App\Http\Controllers\Admin; // <--- C'EST CETTE LIGNE QUI COMPTE

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('admin.appointments.index', compact('appointments'));
    }
}