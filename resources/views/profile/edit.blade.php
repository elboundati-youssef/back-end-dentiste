@extends('admin.layout')

@section('title', 'Mon Profil')

@section('content')
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

        {{-- Section 2 : Mot de passe --}}
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

        {{-- Section 3 : Supprimer le compte --}}
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