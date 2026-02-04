@extends('admin.layout')

@section('title', 'Tableau de Bord')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Rendez-vous aujourd'hui</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $appointmentsToday }}</h3>
                </div>
                <div class="p-3 bg-blue-50 rounded-full text-blue-500">
                    <i data-lucide="calendar"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Articles publiés</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalBlogs }}</h3>
                </div>
                <div class="p-3 bg-green-50 rounded-full text-green-500">
                    <i data-lucide="file-text"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-8 bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Statut du système</h3>
        <p class="text-gray-600">Bienvenue, {{ Auth::user()->name }}. Votre plateforme est connectée et prête à gérer vos patients.</p>
    </div>
@endsection