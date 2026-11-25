@extends('layouts.dashboard')

@section('title', 'Reçu de réinscription · ' . config('app.name'))

@section('content')
@php
    $profile = $user->doctorantProfile;
    $these = $user->these;
    $year = $these?->annee_inscription;
    $yearLabels = [
        '2' => '2ème Année', '3' => '3ème Année', '4' => '4ème Année (Dérogation)',
        '5' => '5ème Année (Dérogation)', '6' => '6ème Année (Dérogation)',
    ];
    $receiptGroups = [
        [
            'title' => 'Informations étudiant', 'icon' => 'person',
            'fields' => [
                ['Nom et prénom', trim($user->name . ' ' . $user->prenom)],
                ['Email', $user->email],
                ['CNE', $profile?->cne],
                ['CIN', $profile?->cin],
            ],
        ],
        [
            'title' => 'Informations thèse', 'icon' => 'mortarboard',
            'fields' => [
                ['Sujet de thèse', $these?->sujet?->intitule_sujet],
                ['Directeur de thèse', trim(($these?->directeur?->nom_fr ?? '') . ' ' . ($these?->directeur?->prenom ?? ''))],
                ['Laboratoire', $these?->laboratoire?->intitule],
            ],
        ],
        [
            'title' => 'Détails de réinscription', 'icon' => 'calendar3',
            'fields' => [
                ['Année académique', $annee_academique],
                ['Année d’inscription', $year ? ($yearLabels[$year] ?? $year) : null],
                ['Date de soumission', $reinscription->created_at->format('d/m/Y à H:i')],
            ],
        ],
    ];
    if ($reinscription->rapport_path) {
        $receiptGroups[2]['fields'][] = ['Rapport d’activité', basename($reinscription->rapport_path)];
    }
@endphp

<section class="registration-page registration-receipt" aria-labelledby="registration-receipt-title">
    <div class="registration-heading">
        <div>
            <nav class="registration-breadcrumb" aria-label="Fil d’Ariane">
                <a href="{{ route('reinscription.index') }}">{{ __('messages.reinscription') }}</a>
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                <span aria-current="page">Reçu</span>
            </nav>
            <h1 id="registration-receipt-title">Reçu de réinscription</h1>
            <p class="registration-receipt-ar" lang="ar" dir="rtl">إيصال إعادة التسجيل</p>
        </div>
        <div class="registration-year">
            <i class="bi bi-check-circle" aria-hidden="true"></i>
            <div>
                <span>Réinscription enregistrée</span>
                <strong>{{ $annee_academique }}</strong>
            </div>
        </div>
    </div>

    <div class="registration-receipt-grid">
        @foreach ($receiptGroups as $group)
            <section class="registration-card">
                <header class="registration-card-header">
                    <span class="registration-icon" aria-hidden="true"><i class="bi bi-{{ $group['icon'] }}"></i></span>
                    <h2>{{ $group['title'] }}</h2>
                </header>
                <dl class="registration-facts">
                    @foreach ($group['fields'] as [$label, $value])
                        <div>
                            <dt>{{ $label }}</dt>
                            <dd dir="auto">{{ filled($value) ? $value : '—' }}</dd>
                        </div>
                    @endforeach
                </dl>
            </section>
        @endforeach
    </div>

    <div class="registration-actions">
        <a href="{{ route('dashboard') }}" class="btn btn-light">Retour au tableau de bord</a>
        <a id="download-pdf-btn" href="{{ route('reinscription.download-receipt', $reinscription->id) }}" class="btn btn-primary">
            <i class="bi bi-download" aria-hidden="true"></i> Télécharger le PDF
        </a>
    </div>
</section>
@endsection
