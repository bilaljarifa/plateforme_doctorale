@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-white">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Carte principale -->
            <div class="bg-white shadow-sm rounded-lg">
                <!-- Fil d'Ariane -->
                <div class="p-4 border-b border-gray-200">
                    <div class="flex text-sm text-gray-500">
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Accueil</a>
                        <span class="mx-2">&gt;</span>
                        <a href="{{ route('articles.index') }}" class="hover:text-gray-700">Articles</a>
                        <span class="mx-2">&gt;</span>
                        <span class="text-gray-700">Nouvel Article</span>
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Créer un Nouvel Article</h2>

                    <form action="{{ route('articles.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Type d'article -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type d'article</label>
                            <select id="type" name="type" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                                <option value="article">Article scientifique</option>
                                <option value="conference">Article de conférence</option>
                                <option value="chapter">Chapitre de livre</option>
                                <option value="book">Livre</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Titre -->
                        <div>
                            <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                            <input type="text" id="titre" name="titre" value="{{ old('titre') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            @error('titre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Année -->
                        <div>
                            <label for="annee" class="block text-sm font-medium text-gray-700">Année de publication</label>
                            <input type="number" id="annee" name="annee" value="{{ old('annee', date('Y')) }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            @error('annee')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- DOI -->
                        <div>
                            <label for="doi" class="block text-sm font-medium text-gray-700">DOI</label>
                            <input type="text" id="doi" name="doi" value="{{ old('doi') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            @error('doi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lien -->
                        <div>
                            <label for="lien" class="block text-sm font-medium text-gray-700">Lien URL</label>
                            <input type="url" id="lien" name="lien" value="{{ old('lien') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            @error('lien')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-3 pt-5">
                            <a href="{{ route('articles.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Créer l'article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
