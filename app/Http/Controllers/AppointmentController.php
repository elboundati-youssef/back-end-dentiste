<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validation adaptée au nouveau formulaire React
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'          => 'required|email',
            'phone'          => 'required|string',
            'preferred_date' => 'required|string', // Peut être 'date' si le format est strict
            'service'        => 'required|string',
            'message'        => 'required|string',
            'terms_accepted' => 'accepted'
        ]);

        $appointment = Appointment::create($validated);

        return response()->json(['message' => 'Success', 'data' => $appointment], 201);
    }

    public function index()
    {
        $appointments = Appointment::latest()->get();
        return view('dashboard', compact('appointments'));
    }
}