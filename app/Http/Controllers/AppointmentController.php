<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Liste des rendez-vous (Pour le Dashboard Admin)
     */
    public function index()
    {
        // On retourne les rendez-vous du plus récent au plus ancien
        return Appointment::orderBy('created_at', 'desc')->get();
    }

    /**
     * Sauvegarder un nouveau rendez-vous (Formulaire Public)
     */
    public function store(StoreAppointmentRequest $request)
    {
        // Création du rendez-vous
        $appointment = Appointment::create($request->validated());

        return response()->json([
            'message' => 'Rendez-vous enregistré avec succès.',
            'data' => $appointment
        ], 201);
    }

    /**
     * Supprimer un rendez-vous (Admin)
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(['message' => 'Rendez-vous supprimé']);
    }
    
    /**
     * Mettre à jour le statut (Admin - ex: Confirmer le RDV)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => $request->status]);

        return response()->json(['message' => 'Statut mis à jour', 'data' => $appointment]);
    }

    /**
     * Afficher un rendez-vous spécifique
     */
    public function show($id)
    {
        return Appointment::findOrFail($id);
    }
}