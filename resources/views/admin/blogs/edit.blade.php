@extends('admin.layout')

@section('title', 'Modifier l\'article')

@section('content')

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('admin.blogs.index') }}" class="flex items-center text-gray-500 hover:text-gray-700 mb-6">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Retour à la liste
        </a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') 

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category" class="w-full rounded-lg border-gray-300 shadow-sm p-2.5 border">
                            <option value="Santé Dentaire" {{ $blog->category == 'Santé Dentaire' ? 'selected' : '' }}>Santé Dentaire</option>
                            <option value="Esthétique" {{ $blog->category == 'Esthétique' ? 'selected' : '' }}>Esthétique</option>
                            <option value="Orthodontie" {{ $blog->category == 'Orthodontie' ? 'selected' : '' }}>Orthodontie</option>
                            <option value="Pédiatrie" {{ $blog->category == 'Pédiatrie' ? 'selected' : '' }}>Pédiatrie</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Changer l'image (Optionnel)</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                    <textarea name="content" rows="8" required
                        class="w-full rounded-lg border-gray-300 shadow-sm p-3 border">{{ old('content', $blog->content) }}</textarea>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-all">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection