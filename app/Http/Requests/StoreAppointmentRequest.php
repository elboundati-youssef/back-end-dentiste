<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Autoriser tout le monde (formulaire public)
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date|after_or_equal:today', // Pas de date dans le passé
            'service' => 'required|string',
            'message' => 'nullable|string|max:1000',
            'terms_accepted' => 'required|accepted', // Doit être coché
        ];
    }
}