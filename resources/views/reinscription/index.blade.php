@extends('layouts.dashboard')

@section('title', __('messages.reinscription') . ' · ' . config('app.name'))

@section('content')
@php
    $profile = $user->doctorantProfile;
    $these = $user->these;
    $profileFields = [
        ['Nom (Fr)', $user->name],
        ['Prénom (Fr)', $user->prenom],
        ['الإسم العائلي', $profile?->nom_arabe, 'ar'],
        ['الإسم الشخصي', $profile?->prenom_arabe, 'ar'],
        ['CIN', $profile?->cin],
        ['CNE', $profile?->cne],
        ['Date de naissance', $profile?->date_naissance],
        ['Email', $user->email],
        ['Téléphone', $profile?->telephone],
        ['Genre', $profile?->genre],
        ['Situation familiale', $profile?->situation_familiale],
        ['Situation administrative', $profile?->situation_administrative],
        ['ORCID', $profile?->orcid],
    ];
    $thesisFields = [
        ['Apogée', $these?->apogee],
        ['Centre d’études doctorales', $these?->ced?->intitule],
        ['Formation doctorale', $these?->ped?->intitule],
        ['Sujet de thèse', $these?->sujet?->intitule_sujet],
        ['Année d’inscription', $these?->annee_inscription],
        ['Année de première inscription', $these?->annee_premiere_inscription],
        ['Établissement', $these?->etablissement?->intitulefr],
        ['Laboratoire', $these?->laboratoire?->intitule],
        ['Directeur de thèse', trim(($these?->directeur?->nom_fr ?? '') . ' ' . ($these?->directeur?->prenom ?? ''))],
    ];
    if ($these?->co_directeur_type && $these->co_directeur_type !== 'non') {
        $coDirector = $these->co_directeur_type === 'interne'
            ? trim(($these->coDirecteur?->nom_fr ?? '') . ' ' . ($these->coDirecteur?->prenom ?? '')) . ' (Interne)'
            : trim(($these->co_directeur_nom ?? '') . ' ' . ($these->co_directeur_prenom ?? '')) . ' (' . ($these->co_directeur_etablissement ?? '') . ')';
        $thesisFields[] = ['Co-directeur', $coDirector];
    }
    $thesisFields[] = ['Date prévue de soutenance', $these?->date_prevue_soutenance];

    $information = [
        ['icon' => 'person', 'title' => __('messages.profile'), 'complete' => $isProfileComplete, 'fields' => $profileFields],
        ['icon' => 'mortarboard', 'title' => __('messages.my_thesis'), 'complete' => $isTheseComplete, 'fields' => $thesisFields],
    ];
    $publications = [
        ['icon' => 'file-earmark-text', 'title' => __('messages.articles'), 'records' => $articles, 'empty' => __('messages.no_articles')],
        ['icon' => 'megaphone', 'title' => __('messages.communications'), 'records' => $communications, 'empty' => __('messages.no_communications')],
    ];
@endphp

<section class="registration-page" aria-labelledby="registration-title">
    <div class="registration-heading">
        <div>
            <nav class="registration-breadcrumb" aria-label="Fil d’Ariane">
                <a href="{{ route('dashboard') }}"><i class="bi bi-house-door-fill" aria-hidden="true"></i> {{ __('messages.dashboard') }}</a>
                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                <span aria-current="page">{{ __('messages.reinscription') }}</span>
            </nav>
            <h1 id="registration-title">{{ __('messages.reinscription_title') }}</h1>
        </div>
        <div class="registration-year">
            <i class="bi bi-calendar3" aria-hidden="true"></i>
            <div>
                <span>{{ __('messages.academic_year') }}</span>
                <strong>{{ date('Y') }}–{{ date('Y') + 1 }}</strong>
            </div>
        </div>
    </div>

    @if (session('error'))
        <div class="registration-notice registration-error" role="alert">{{ session('error') }}</div>
    @endif

    @if (!$isProfileComplete || !$isTheseComplete)
        <div class="registration-notice">
            <i class="bi bi-info-circle" aria-hidden="true"></i>
            <div>
                <strong>Votre dossier est incomplet.</strong>
                <p>Complétez les informations ci-dessous pour pouvoir enregistrer votre réinscription.</p>
                <div class="registration-notice-links">
                    @unless ($isProfileComplete)
                        <a href="{{ route('dashboard') }}">Compléter le profil <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    @endunless
                    @unless ($isTheseComplete)
                        <a href="{{ route('these') }}">Compléter la thèse <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    @endunless
                </div>
            </div>
        </div>
    @endif

    <div class="registration-grid">
        <section class="registration-card" aria-labelledby="registration-progress-title">
            <header class="registration-card-header">
                <span class="registration-icon" aria-hidden="true"><i class="bi bi-journal-check"></i></span>
                <h2 id="registration-progress-title">{{ __('messages.progress_file') }}</h2>
            </header>

            <form id="reinscriptionForm" class="registration-form" method="POST" action="{{ route('reinscription.store') }}"
                data-profile-complete="{{ $isProfileComplete ? '1' : '0' }}"
                data-thesis-complete="{{ $isTheseComplete ? '1' : '0' }}">
                @csrf

                <div class="registration-field">
                    <label for="thesis_progress">{{ __('messages.thesis_progress') }} <span class="profile-required" aria-hidden="true">*</span></label>
                    <textarea id="thesis_progress" name="thesis_progress" rows="7" minlength="10" maxlength="5000" required
                        aria-describedby="registration-progress-help @error('thesis_progress') registration-progress-error @enderror"
                        @error('thesis_progress') aria-invalid="true" @enderror
                        placeholder="Décrivez les travaux réalisés, les résultats obtenus et les prochaines étapes.">{{ old('thesis_progress') }}</textarea>
                    <div id="registration-progress-help" class="registration-field-help">
                        <span>10 à 5 000 caractères</span>
                        <span id="registration-progress-count" aria-hidden="true"></span>
                    </div>
                    @error('thesis_progress')
                        <p id="registration-progress-error" class="registration-field-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="registration-confirmation">
                    <input id="directeur_valide" name="directeur_valide" type="checkbox" value="1" required @checked(old('directeur_valide')) @error('directeur_valide') aria-describedby="registration-certification-error" aria-invalid="true" @enderror>
                    <label for="directeur_valide">
                        {{ __('messages.certification') }}
                        <span lang="ar" dir="rtl">أشهد بصحة المعلومات</span>
                    </label>
                </div>
                @error('directeur_valide')
                    <p id="registration-certification-error" class="registration-field-error" role="alert">{{ $message }}</p>
                @enderror

                <input type="hidden" id="derniere_publication" name="derniere_publication" value="{{ old('derniere_publication') }}">

                <div class="registration-actions">
                    <button id="submitBtn" type="submit" class="btn btn-primary" disabled>
                        <i class="bi bi-check2" aria-hidden="true"></i> {{ __('messages.save') }}
                    </button>
                </div>
            </form>
        </section>

        <aside class="registration-card" aria-labelledby="registration-file-title">
            <header class="registration-card-header">
                <span class="registration-icon" aria-hidden="true"><i class="bi bi-folder2-open"></i></span>
                <h2 id="registration-file-title">Votre dossier</h2>
            </header>

            @foreach ($information as $section)
                <details class="registration-disclosure">
                    <summary>
                        <i class="bi bi-{{ $section['icon'] }}" aria-hidden="true"></i>
                        <span class="registration-disclosure-title">{{ $section['title'] }}</span>
                        <span class="registration-status {{ $section['complete'] ? 'registration-status-complete' : 'registration-status-pending' }}">
                            {{ $section['complete'] ? 'Complet' : 'À compléter' }}
                        </span>
                        <i class="bi bi-chevron-down registration-chevron" aria-hidden="true"></i>
                    </summary>
                    <dl class="registration-facts">
                        @foreach ($section['fields'] as $field)
                            <div>
                                <dt @if (isset($field[2])) lang="{{ $field[2] }}" dir="rtl" @endif>{{ $field[0] }}</dt>
                                <dd dir="auto">{{ filled($field[1]) ? $field[1] : '—' }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </details>
            @endforeach

            @foreach ($publications as $section)
                <details class="registration-disclosure">
                    <summary>
                        <i class="bi bi-{{ $section['icon'] }}" aria-hidden="true"></i>
                        <span class="registration-disclosure-title">{{ $section['title'] }}</span>
                        <span class="registration-status">{{ $section['records']->count() }}</span>
                        <i class="bi bi-chevron-down registration-chevron" aria-hidden="true"></i>
                    </summary>
                    <div class="registration-records">
                        @forelse ($section['records'] as $publication)
                            <article>
                                <strong>{{ $publication->titre }}</strong>
                                <p>
                                    @if ($publication->type)
                                        {{ ucfirst($publication->type) }} ·
                                    @endif
                                    {{ $publication->annee }}
                                </p>
                                @if ($publication->doi)
                                    <p>DOI: {{ $publication->doi }}</p>
                                @endif
                                @if ($publication->lien)
                                    <a href="{{ $publication->lien }}" target="_blank" rel="noopener noreferrer">{{ __('messages.article_link') }}</a>
                                @endif
                            </article>
                        @empty
                            <p class="registration-empty">{{ $section['empty'] }}</p>
                        @endforelse
                    </div>
                </details>
            @endforeach
        </aside>
    </div>
</section>

@include('reinscription._reinscription_js')
@endsection
