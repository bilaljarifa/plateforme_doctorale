@extends('layouts.dashboard')

@section('content')
<div class="success-container">
    <div class="container mx-auto px-4 py-8 max-w-4xl">

        <!-- Receipt Card -->
        <div class="receipt-card">
            <!-- Receipt Header -->
            <div class="receipt-header">
                <h2 class="receipt-title">Reçu de Réinscription || إيصال إعادة التسجيل</h2>
                <p class="receipt-university">Université Ibn Tofail | جامعة ابن طفيل</p>
            </div>

            <!-- Student Info -->
            <div class="receipt-section">
                <h3 class="section-title">Informations Étudiant || معلومات الطالب</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Nom et Prénom</span>
                        <span class="value">{{ $user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Email</span>
                        <span class="value">{{ $user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">CNE</span>
                        <span class="value">{{ optional($user->doctorantProfile)->cne ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">CIN</span>
                        <span class="value">{{ optional($user->doctorantProfile)->cin ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Thesis Info -->
            <div class="receipt-section">
                <h3 class="section-title">Informations Thèse || معلومات الأطروحة</h3>
                <div class="space-y-3">
                    <div class="info-item">
                        <span class="label">Sujet de Thèse</span>
                        <span class="value">{{ optional($user->these)->sujet->intitule_sujet ?? 'N/A' }}</span>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Directeur de Thèse</span>
                            <span class="value">{{ optional(optional($user->these)->directeur)->nom_fr ?? 'N/A' }} {{ optional(optional($user->these)->directeur)->prenom ?? '' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Laboratoire</span>
                            <span class="value">{{ optional(optional($user->these)->laboratoire)->intitule ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reinscription Details -->
            <div class="receipt-section">
                <h3 class="section-title">Détails de Réinscription || تفاصيل إعادة التسجيل</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="label">Année Académique</span>
                        <span class="value-highlight">{{ $annee_academique }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Année d'Inscription</span>
                        <span class="value-highlight">
                            @php
                                $annee = optional($user->these)->annee_inscription;
                                $map = ['2' => '2ème Année','3' => '3ème Année','4' => '4ème Année (Dérogation)','5' => '5ème Année (Dérogation)','6' => '6ème Année (Dérogation)'];
                            @endphp
                            {{ $annee ? ($map[$annee] ?? $annee) : 'N/A' }}
                        </span>
                    </div>
                    @if(!empty($reinscription->rapport_path))
                        <div class="info-item">
                            <span class="label">Rapport d'Activité</span>
                            <span class="value">{{ basename($reinscription->rapport_path) }}</span>
                        </div>
                    @endif
                    <div class="info-item">
                        <span class="label">Date de Soumission</span>
                        <span class="value">{{ $reinscription->created_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a id="download-pdf-btn" href="{{ route('reinscription.download-receipt', $reinscription->id) }}" class="btn-pdf">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Télécharger PDF
            </a>
            <a href="{{ route('dashboard') }}" class="btn-dashboard">
                Retour au Tableau de Bord
            </a>
        </div>
    </div>
</div>

<style>
.success-container {
    background: #f9fafb;
    min-height: calc(100vh - 100px);
    padding: 40px 0;
}

.receipt-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 20px;
}

.receipt-header {
    background: white;
    padding: 24px;
    text-align: center;
    border-bottom: 2px solid #e5e7eb;
}

.receipt-title {
    font-size: 20px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 6px 0;
}

.receipt-university {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
}

.receipt-section {
    padding: 20px 24px;
    border-bottom: 1px solid #f3f4f6;
}

.receipt-section:last-of-type {
    border-bottom: none;
}

.section-title {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 14px;
    padding-bottom: 6px;
    border-bottom: 1px solid #e5e7eb;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 14px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    color: #6b7280;
    letter-spacing: 0.5px;
}

.value {
    font-size: 14px;
    color: #111827;
}

.value-highlight {
    font-size: 14px;
    font-weight: 600;
    color: #059669;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

@media (min-width: 640px) {
    .action-buttons {
        flex-direction: row;
        justify-content: center;
    }
}

.btn-pdf {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 20px;
    background: #3b82f6;
    color: white;
    font-weight: 600;
    font-size: 13px;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-pdf:hover {
    background: #2563eb;
}

.btn-dashboard {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 8px 20px;
    background: white;
    color: #374151;
    font-weight: 600;
    font-size: 13px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-dashboard:hover {
    background: #f9fafb;
}

@media (max-width: 640px) {
    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

@endsection
