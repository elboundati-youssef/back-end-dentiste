@extends('admin.layout')

@section('title', 'Gestion des Rendez-vous')

@section('content')

    <div x-data="{ showModal: false, selected: {} }">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="p-4">Patient</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Téléphone</th>
                        <th class="p-4">Service</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Message (Aperçu)</th>
                        <th class="p-4 text-right">Reçu le</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appointment)
                    <tr @click="selected = {{ $appointment->toJson() }}; showModal = true" 
                        class="hover:bg-blue-50 transition-colors cursor-pointer group">
                        
                        <td class="p-4 font-medium text-gray-800 group-hover:text-blue-600">
                            {{ $appointment->full_name ?? $appointment->name ?? 'Nom inconnu' }}
                        </td>
                        <td class="p-4 text-sm text-gray-600">{{ $appointment->email }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ $appointment->phone }}</td>
                        <td class="p-4">
                            <span class="bg-purple-50 text-purple-600 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $appointment->service }}
                            </span>
                        </td>
                        <td class="p-4 text-sm text-gray-600">{{ $appointment->preferred_date }}</td>
                        
                        <td class="p-4 text-sm text-gray-500 italic">
                            {{ Str::limit($appointment->message, 30, '...') }}
                        </td>

                        <td class="p-4 text-right text-xs text-gray-400">
                            {{ $appointment->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            Aucun rendez-vous pour le moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="showModal" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <div @click.outside="showModal = false" 
                 class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">

                <div class="bg-blue-600 p-6 flex justify-between items-center text-white">
                    <h3 class="text-xl font-bold flex items-center gap-2">
                        <i data-lucide="user" class="w-6 h-6"></i>
                        <span x-text="selected.full_name || selected.name"></span>
                    </h3>
                    <button @click="showModal = false" class="hover:bg-blue-700 p-1 rounded-full transition">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-500 uppercase font-bold">Email</p>
                            <p class="text-gray-800 break-words" x-text="selected.email"></p>
                        </div>
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <p class="text-xs text-gray-500 uppercase font-bold">Téléphone</p>
                            <p class="text-gray-800" x-text="selected.phone"></p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1 bg-purple-50 p-3 rounded-lg border border-purple-100">
                            <p class="text-xs text-purple-600 uppercase font-bold">Service</p>
                            <p class="text-purple-900 font-medium" x-text="selected.service"></p>
                        </div>
                        <div class="flex-1 bg-blue-50 p-3 rounded-lg border border-blue-100">
                            <p class="text-xs text-blue-600 uppercase font-bold">Date souhaitée</p>
                            <p class="text-blue-900 font-medium" x-text="selected.preferred_date"></p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase font-bold mb-2">Message complet du patient</p>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-gray-700 text-sm leading-relaxed max-h-48 overflow-y-auto">
                            <p x-text="selected.message"></p>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-50 p-4 flex justify-end">
                    <button @click="showModal = false" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition shadow-sm font-medium">
                        Fermer
                    </button>
                    </div>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.effect(() => {
                // Relance les icônes quand la modale s'ouvre (optionnel mais utile)
                setTimeout(() => lucide.createIcons(), 100);
            });
        });
    </script>

@endsection