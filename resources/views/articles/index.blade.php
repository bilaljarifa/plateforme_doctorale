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
                        <span class="text-gray-700">Articles</span>
                    </div>
                </div>

                <div class="p-6" x-data="{ showAddModal: false }">
                    <!-- En-tête -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Mes Articles</h2>

                        <!-- Blue round + button triggers modal -->
                        <button type="button" @click="showAddModal = true" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white hover:bg-blue-700">
                            <span class="text-xl">+</span>
                        </button>
                    </div>
                    <!-- Table PowerGrid -->
                    <div>
                        <livewire:article-table/>
                    </div>

                    <!-- Ajouter Publication Modal -->
                    <div x-show="showAddModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center">
                        <div class="fixed inset-0 bg-black bg-opacity-50" @click="showAddModal = false"></div>

                        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 z-50">
                            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-800">Ajouter Publication</h3>
                                <button @click="showAddModal = false" class="text-gray-500 hover:text-gray-700">✕</button>
                            </div>

                            <form action="{{ route('articles.store') }}" method="POST">
                                @csrf
                                <div class="p-6 space-y-4">
                                    <div>
                                        <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                                        <input type="text" name="titre" id="titre" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2" />
                                    </div>

                                    <div>
                                        <label for="annee" class="block text-sm font-medium text-gray-700">Année de publication</label>
                                        <input type="number" name="annee" id="annee" value="{{ date('Y') }}" required class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2" />
                                    </div>

                                    <div>
                                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                                        <select name="type" id="type" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2">
                                            <option value="article">Article scientifique</option>
                                            <option value="conference">Article de conférence</option>
                                            <option value="chapter">Chapitre de livre</option>
                                            <option value="book">Livre</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="lien" class="block text-sm font-medium text-gray-700">Lien</label>
                                        <input type="url" name="lien" id="lien" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2" />
                                    </div>

                                    <div>
                                        <label for="doi" class="block text-sm font-medium text-gray-700">DOI</label>
                                        <input type="text" name="doi" id="doi" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-3 py-2" />
                                    </div>
                                </div>

                                <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                                    <button type="button" @click="showAddModal = false" class="mr-3 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end modal -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
