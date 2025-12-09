<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de Réinscription Doctorat</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 3px solid #0066cc;
            padding-bottom: 12px;
        }
        .header h2 {
            margin: 0;
            color: #0066cc;
            font-size: 15px;
        }
        .header p {
            margin: 2px 0;
            color: #666;
            font-size: 9px;
        }
        .content { margin: 0 5px; }
        .field {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }
        .label {
            font-weight: 700;
            min-width: 150px;
        }
        .value {
            flex: 1;
            padding-left: 8px;
        }
        .section-title {
            margin-top: 10px;
            margin-bottom: 6px;
            font-weight: 700;
            border-bottom: 1px solid #0066cc;
            padding-bottom: 3px;
            color: #0066cc;
            font-size: 11px;
        }
        .item {
            margin-left: 10px;
            padding: 4px;
            border-left: 2px solid #ddd;
            margin-bottom: 4px;
            font-size: 9px;
        }
        .item-title {
            font-weight: 600;
            color: #333;
        }
        .item-detail {
            margin-left: 5px;
            color: #555;
        }
        .thesis-progress {
            background-color: #f5f5f5;
            border-left: 3px solid #0066cc;
            padding: 6px;
            margin-top: 6px;
            font-size: 9px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .certification {
            margin-top: 12px;
            padding: 8px;
            background-color: #e9f2ff;
            border-left: 3px solid #0066cc;
            border-radius: 2px;
            font-size: 9px;
        }
        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 9px;
            color: #666;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reçu de Réinscription au Doctorat</h2>
        <p>Université Ibn Tofail | جامعة ابن طفيل</p>
    </div>

    <div class="content">
        <!-- Student Information -->
        <div class="section-title">Informations de l'Étudiant</div>
        <div class="field">
            <span class="label">Nom et Prénom:</span>
            <span class="value">{{ $user->name }}</span>
        </div>
        <div class="field">
            <span class="label">Email:</span>
            <span class="value">{{ $user->email }}</span>
        </div>
        <div class="field">
            <span class="label">CNE:</span>
            <span class="value">{{ optional($user->doctorantProfile)->cne ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="label">CIN:</span>
            <span class="value">{{ optional($user->doctorantProfile)->cin ?? 'N/A' }}</span>
        </div>

        <!-- Thesis Information -->
        <div class="section-title">Informations de la Thèse</div>
        <div class="field">
            <span class="label">Sujet:</span>
            <span class="value">{{ optional($user->these)->sujet->intitule_sujet ?? 'N/A' }}</span>
        </div>
        <div class="field">
            <span class="label">Directeur:</span>
            <span class="value">{{ optional(optional($user->these)->directeur)->nom_fr ?? 'N/A' }} {{ optional(optional($user->these)->directeur)->prenom ?? '' }}</span>
        </div>
        <div class="field">
            <span class="label">Laboratoire:</span>
            <span class="value">{{ optional(optional($user->these)->laboratoire)->intitule ?? 'N/A' }}</span>
        </div>

        <!-- Registration Details -->
        <div class="section-title">Détails de la Réinscription</div>
        <div class="field">
            <span class="label">Année Académique:</span>
            <span class="value">{{ $annee_academique }}</span>
        </div>
        <div class="field">
            <span class="label">Année d'Inscription:</span>
            <span class="value">
                @php
                    $map = ['2' => '2ème Année','3' => '3ème Année','4' => '4ème Année (Dérogation)','5' => '5ème Année (Dérogation)','6' => '6ème Année (Dérogation)'];
                @endphp
                {{ isset($reinscription->annee_inscription) ? ($map[$reinscription->annee_inscription] ?? $reinscription->annee_inscription) : '' }}
            </span>
        </div>
        @if(!empty($reinscription->rapport_path))
            <div class="field">
                <span class="label">Rapport d'Activité:</span>
                <span class="value">{{ basename($reinscription->rapport_path) }}</span>
            </div>
        @endif
        <div class="field">
            <span class="label">Validé par le Directeur:</span>
            <span class="value">{{ $reinscription->directeur_valide ? 'Oui ✓' : 'Non' }}</span>
        </div>

        <!-- Thesis Progress -->
        @if(!empty($reinscription->thesis_progress))
            <div class="section-title">État d'Avancement de la Thèse | تقدم الاطروحة</div>
            <div class="thesis-progress">{{ $reinscription->thesis_progress }}</div>
        @endif

        <!-- Articles -->
        @if($articles && $articles->count() > 0)
            <div class="section-title">Articles Publiés ({{ $articles->count() }})</div>
            @foreach($articles as $article)
                <div class="item">
                    <div class="item-title">{{ $article->titre ?? 'Sans titre' }}</div>
                    <div class="item-detail"><strong>Auteurs:</strong> {{ $article->auteurs ?? 'N/A' }}</div>
                    <div class="item-detail"><strong>Journal:</strong> {{ $article->revue ?? 'N/A' }}</div>
                    <div class="item-detail"><strong>Année:</strong> {{ $article->annee ?? 'N/A' }}</div>
                </div>
            @endforeach
        @endif

        <!-- Communications -->
        @if($communications && $communications->count() > 0)
            <div class="section-title">Communications ({{ $communications->count() }})</div>
            @foreach($communications as $communication)
                <div class="item">
                    <div class="item-title">{{ $communication->titre ?? 'Sans titre' }}</div>
                    <div class="item-detail"><strong>Événement:</strong> {{ $communication->evenement ?? 'N/A' }}</div>
                    <div class="item-detail"><strong>Année:</strong> {{ $communication->annee ?? 'N/A' }}</div>
                </div>
            @endforeach
        @endif

        <!-- Certification -->
        <div class="certification">
            <strong>Certification:</strong> L'étudiant est régulièrement réinscrit en Doctorat pour l'année académique {{ $annee_academique }}. Ce reçu confirme que tous les documents requis ont été soumis et validés.
        </div>

        <div class="footer">
            <p>Date d'émission: {{ now()->format('d/m/Y à H:i') }}</p>
            <p>Reçu n°: {{ $reinscription->id }}</p>
        </div>
    </div>
</body>
</html>
