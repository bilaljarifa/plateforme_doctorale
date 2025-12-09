@extends('layouts.dashboard')

@section('content')
<div class="reinscription-success">
    <div class="container mx-auto px-4 py-12 max-w-2xl">
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
                <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-green-700 mb-2">Réinscription Enregistrée</h1>
            <p class="text-gray-600">Votre demande de réinscription a été soumise avec succès.</p>
        </div>

        <!-- Receipt Box -->
        <div class="bg-white border-2 border-green-200 rounded-lg shadow-lg p-8 mb-8">
            <!-- Receipt Header -->
            <div class="border-b-2 border-green-300 pb-4 mb-6 text-center">
                <h2 class="text-2xl font-bold text-green-700">Reçu de Réinscription</h2>
                <p class="text-sm text-gray-500 mt-2">Université Ibn Tofail - جامعة ابن طفيل</p>
            </div>

            <!-- Student Info -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b-2 border-blue-600 pb-2">Informations Étudiant</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium text-gray-600">Nom et Prénom</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">CNE</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $user->cne ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">CIN</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $user->cin ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Email</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Thesis Info -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b-2 border-blue-600 pb-2">Informations Thèse</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-medium text-gray-600">Sujet de Thèse</p>
                        <p class="text-sm text-gray-900">{{ optional($user->these)->sujet->intitule_sujet ?? 'N/A' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-medium text-gray-600">Directeur de Thèse</p>
                            <p class="text-sm text-gray-900">{{ optional(optional($user->these)->directeur)->nom_fr ?? 'N/A' }} {{ optional(optional($user->these)->directeur)->prenom ?? '' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600">Laboratoire</p>
                            <p class="text-sm text-gray-900">{{ optional(optional($user->these)->laboratoire)->intitule ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reinscription Details -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b-2 border-blue-600 pb-2">Détails de Réinscription</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium text-gray-600">Année Académique</p>
                        <p class="text-sm font-semibold text-green-700">{{ $annee_academique }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600">Année d'Inscription</p>
                        <p class="text-sm font-semibold text-green-700">
                            @php
                                $map = ['2' => '2ème Année','3' => '3ème Année','4' => '4ème Année (Dérogation)','5' => '5ème Année (Dérogation)','6' => '6ème Année (Dérogation)'];
                            @endphp
                            {{ $map[$reinscription->annee_inscription] ?? $reinscription->annee_inscription }}
                        </p>
                    </div>
                    @if(!empty($reinscription->rapport_path))
                        <div>
                            <p class="text-xs font-medium text-gray-600">Rapport d'Activité</p>
                            <p class="text-sm text-gray-900">{{ basename($reinscription->rapport_path) }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-xs font-medium text-gray-600">Date de Soumission</p>
                        <p class="text-sm text-gray-900">{{ $reinscription->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Certification -->
            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded">
                <p class="text-sm text-blue-900">
                    <strong>✓ Certification:</strong> L'étudiant(e) est régulièrement réinscrit(e) en Doctorat pour l'année académique <strong>{{ $annee_academique }}</strong>.
                </p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('reinscription.download-receipt', $reinscription->id) }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8m0 0l-4 4m4-4l4 4"/>
                </svg>
                Télécharger PDF
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-2m-9-2l4 2m0-11L9 3m6 6l4-2"/>
                </svg>
                Retour au Tableau de Bord
            </a>
        </div>
    </div>
</div>

<style>
    .reinscription-success {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: calc(100vh - 150px);
        display: flex;
        align-items: center;
        padding: 20px 0;
    }
</style>
@endsection
