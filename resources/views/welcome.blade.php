@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-r from-blue-600 to-indigo-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Portail des Études Doctorales
            </h1>
            <p class="text-xl md:text-2xl mb-8">
                Votre parcours vers l'excellence académique commence ici
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-semibold transition duration-300">
                    Postuler Maintenant
                </a>
                <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-semibold transition duration-300">
                    En savoir plus
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Informations importantes -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">
                Cycle Doctoral 2025-2026
            </h2>
            <p class="text-gray-600 mb-6">
                Bienvenue sur la plateforme officielle de gestion des études doctorales de l'Université Ibn Tofail.
            </p>
        </div>
    </div>
</div>
@endsection
