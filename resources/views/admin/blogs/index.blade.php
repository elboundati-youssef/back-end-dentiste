@extends('admin.layout')

@section('title', 'Gestion des Articles')

@section('content')

    <div x-data="{ showImageModal: false, imageUrl: '' }">

        <div class="flex justify-between items-center mb-6">
            <p class="text-gray-600">Gérez les articles de votre blog visible sur le site.</p>
            <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                <span>Nouvel Article</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="p-4">Image</th>
                        <th class="p-4">Titre</th>
                        <th class="p-4">Catégorie</th>
                        <th class="p-4">Date</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($blogs as $blog)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" 
                                     class="w-16 h-10 object-cover rounded cursor-pointer hover:opacity-80 transition shadow-sm border border-gray-200" 
                                     alt="img"
                                     title="Cliquez pour agrandir"
                                     @click="imageUrl = '{{ asset('storage/' . $blog->image) }}'; showImageModal = true">
                            @else
                                <div class="w-16 h-10 bg-gray-100 rounded flex items-center justify-center text-gray-400 border border-gray-200">
                                    <i data-lucide="image" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="p-4 font-medium text-gray-800">{{ $blog->title }}</td>
                        <td class="p-4">
                            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-xs font-medium">
                                {{ $blog->category }}
                            </span>
                        </td>
                        <td class="p-4 text-sm text-gray-500">{{ $blog->created_at->format('d/m/Y') }}</td>
                        
                        <td class="p-4 text-right flex justify-end gap-3">
                            
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-blue-500 hover:text-blue-700 transition-colors" title="Modifier">
                                <i data-lucide="pencil" class="w-5 h-5"></i>
                            </a>

                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" title="Supprimer">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">Aucun article publié.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div x-show="showImageModal" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80 backdrop-blur-sm p-4"
             @click.self="showImageModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div class="relative bg-white p-2 rounded-lg shadow-2xl max-w-5xl max-h-[90vh] overflow-hidden">
                
                <button @click="showImageModal = false" class="absolute top-4 right-4 bg-white text-gray-800 rounded-full p-2 shadow-lg hover:bg-gray-100 transition z-10">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>

                <img :src="imageUrl" class="max-w-full max-h-[85vh] object-contain rounded" alt="Grand format">
            </div>
        </div>

    </div>

@endsection