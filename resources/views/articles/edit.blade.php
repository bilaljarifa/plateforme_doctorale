@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-white">
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex text-sm text-gray-500">
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Accueil</a>
                        <span class="mx-2">&gt;</span>
                        <a href="{{ route('articles.index') }}" class="hover:text-gray-700">Articles</a>
                        <span class="mx-2">&gt;</span>
                        <span class="text-gray-700">Modifier l'article</span>
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Modifier l'article</h2>

                    <form action="{{ route('articles.update', $article) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                <select id="type" name="type" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="article" {{ $article->type == 'article' ? 'selected' : '' }}>Article scientifique</option>
                                    <option value="conference" {{ $article->type == 'conference' ? 'selected' : '' }}>Article de conférence</option>
                                    <option value="chapter" {{ $article->type == 'chapter' ? 'selected' : '' }}>Chapitre de livre</option>
                                    <option value="book" {{ $article->type == 'book' ? 'selected' : '' }}>Livre</option>
                                </select>
                            </div>

                            <div>
                                <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                                <input type="text" name="titre" id="titre" value="{{ $article->titre }}" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>

                            <div>
                                <label for="annee" class="block text-sm font-medium text-gray-700">Année</label>
                                <input type="number" name="annee" id="annee" value="{{ $article->annee }}" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>

                            <div>
                                <label for="lien" class="block text-sm font-medium text-gray-700">Lien</label>
                                <input type="url" name="lien" id="lien" value="{{ $article->lien }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>

                            <div>
                                <label for="doi" class="block text-sm font-medium text-gray-700">DOI</label>
                                <input type="text" name="doi" id="doi" value="{{ $article->doi }}" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('articles.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
