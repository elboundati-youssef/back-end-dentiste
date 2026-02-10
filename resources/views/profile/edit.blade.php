@extends('admin.layout')

@section('title', 'Mon Profil')

@section('content')
    {{-- AJOUT DE CE STYLE POUR CORRIGER LES LABELS --}}
    <style>
        /* Force les labels à être noirs et gras */
        label {
            color: #1a202c !important; /* Gris très foncé */
            font-weight: 700 !important; /* Gras */
            font-size: 0.95rem !important;
            margin-bottom: 0.5rem !important;
            display: block !important;
        }
        /* Améliore aussi les champs de saisie si nécessaire */
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
        }
    </style>

    <div class="space-y-6">

        {{-- Section 1 : Informations du profil --}}
        <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                <header class="mb-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Informations du profil') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Mettez à jour les informations de profil et l'adresse email de votre compte.") }}
                    </p>
                </header>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- ... Les autres sections (Mot de passe, Suppression) restent pareilles ... --}}
        <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                <header class="mb-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Mettre à jour le mot de passe') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.") }}
                    </p>
                </header>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border border-gray-100">
            <div class="max-w-xl">
                <header class="mb-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Supprimer le compte') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.") }}
                    </p>
                </header>
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
@endsection