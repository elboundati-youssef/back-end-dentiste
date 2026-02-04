@extends('admin.layout')

@section('title', 'Créer un nouvel article')

@section('content')

    <div class="max-w-4xl mx-auto">
        
        <a href="{{ route('admin.blogs.index') }}" class="flex items-center text-gray-500 hover:text-gray-700 mb-6">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Retour à la liste
        </a>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'article</label>
                    <input type="text" name="title" id="title" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border"
                        placeholder="Ex: Les bienfaits du blanchiment dentaire">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                        <select name="category" id="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border">
                            <option value="Santé Dentaire">Santé Dentaire</option>
                            <option value="Esthétique">Esthétique</option>
                            <option value="Orthodontie">Orthodontie</option>
                            <option value="Conseils">Conseils</option>
                            <option value="Actualités">Actualités</option>
                        </select>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image de couverture</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu de l'article</label>
                    <textarea name="content" id="content" rows="8" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3 border"
                        placeholder="Écrivez le contenu de votre article ici..."></textarea>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-all transform hover:scale-105">
                        Publier l'article
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection