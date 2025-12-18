<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reçu de Réinscription Doctorat</title>
    <style>
        @page { margin: 20px; }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9px;
            line-height: 1.3;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .header h2 { margin: 0; color: #0066cc; font-size: 14px; }
        .header p { margin: 0; color: #666; font-size: 10px; }
        
        .section-title {
            background-color: #f0f7ff;
            color: #0066cc;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 10px;
            border-left: 3px solid #0066cc;
            margin: 10px 0 5px 0;
        }

        /* 2-Column Grid using Table for PDF compatibility */
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
        .info-table td { width: 50%; vertical-align: top; padding: 2px 0; }
        
        .label { font-weight: bold; color: #444; font-size: 8px; display: inline-block; width: 110px; }
        .value { color: #000; font-size: 9px; }

        /* Thesis Progress */
        .thesis-progress {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 5px;
            font-size: 8px;
            text-align: justify;
            margin-bottom: 5px;
        }

        /* Compact Lists */
        .compact-list { margin: 0; padding: 0; list-style: none; }
        .compact-item {
            padding: 3px 0;
            border-bottom: 1px dashed #eee;
            page-break-inside: avoid;
        }
        .compact-item:last-child { border-bottom: none; }
        .item-title { font-weight: bold; font-size: 9px; color: #000; display: inline; }
        .item-meta { font-size: 8px; color: #666; display: inline; margin-left: 5px; }

        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 8px;
            color: #888;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reçu de Réinscription | وصل إعادة التسجيل</h2>
        <p>Université Ibn Tofail | جامعة ابن طفيل</p>
    </div>

    <!-- Student Info -->
    <div class="section-title">Informations de l'Étudiant | معلومات الطالب</div>
    <table class="info-table">
        <tr>
            <td><span class="label">Nom et Prénom (Fr):</span> <span class="value">{{ $user->name }} {{ $user->prenom }}</span></td>
            <td><span class="label">Nom et Prénom (Ar):</span> <span class="value">{{ optional($user->doctorantProfile)->nom_arabe }} {{ optional($user->doctorantProfile)->prenom_arabe }}</span></td>
        </tr>
        <tr>
            <td><span class="label">CIN:</span> <span class="value">{{ optional($user->doctorantProfile)->cin ?? '-' }}</span></td>
            <td><span class="label">CNE:</span> <span class="value">{{ optional($user->doctorantProfile)->cne ?? '-' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Email:</span> <span class="value">{{ $user->email }}</span></td>
            <td><span class="label">Téléphone:</span> <span class="value">{{ optional($user->doctorantProfile)->telephone ?? '-' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Genre:</span> <span class="value">{{ ucfirst(optional($user->doctorantProfile)->genre ?? '-') }}</span></td>
            <td><span class="label">Date Naissance:</span> <span class="value">{{ optional($user->doctorantProfile)->date_naissance ?? '-' }}</span></td>
        </tr>
    </table>

    <!-- Thesis Info -->
    <div class="section-title">Informations de la Thèse | معلومات الأطروحة</div>
    <table class="info-table">
        <tr>
            <td colspan="2"><span class="label">Sujet:</span> <span class="value">{{ optional(optional($user->these)->sujet)->intitule_sujet ?? '-' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Directeur:</span> <span class="value">{{ optional(optional($user->these)->directeur)->nom_fr ?? '-' }}</span></td>
            <td><span class="label">Co-Directeur:</span> <span class="value">
                @if(optional($user->these)->co_directeur_type === 'interne')
                    {{ optional(optional($user->these)->coDirecteur)->nom_fr ?? '' }} (Interne)
                @elseif(optional($user->these)->co_directeur_type)
                    {{ optional($user->these)->co_directeur_nom ?? '' }} ({{ optional($user->these)->co_directeur_etablissement ?? '' }})
                @else
                    -
                @endif
            </span></td>
        </tr>
        <tr>
            <td><span class="label">Etablissement:</span> <span class="value">{{ optional(optional($user->these)->etablissement)->intitulefr ?? '-' }}</span></td>
            <td><span class="label">Laboratoire:</span> <span class="value">{{ optional(optional($user->these)->laboratoire)->intitule ?? '-' }}</span></td>
        </tr>
        <tr>
            <td><span class="label"> CED:</span> <span class="value">{{ optional(optional($user->these)->ced)->intitule ?? '-' }}</span></td>
            <td><span class="label">1ère Inscription:</span> <span class="value">{{ optional($user->these)->annee_premiere_inscription ?? '-' }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="label">Date Prévue Soutenance:</span> <span class="value">{{ optional($user->these)->date_prevue_soutenance ?? '-' }}</span></td>
        </tr>
    </table>

    <!-- Registration & Progress -->
    <div class="section-title">Détails de la Réinscription | تفاصيل إعادة التسجيل</div>
    <table class="info-table">
        <tr>
            <td><span class="label">Année Académique:</span> <span class="value">{{ $annee_academique }}</span></td>
            <td><span class="label">Année d'Inscription:</span> <span class="value">{{ $user->these->annee_inscription ?? '-' }}</span></td>
        </tr>
        <tr>
            <td><span class="label">Rapport d'Activité:</span> <span class="value">{{ !empty($reinscription->rapport_path) ? basename($reinscription->rapport_path) : 'Non fourni' }}</span></td>
            <td><span class="label">Validé par Directeur:</span> <span class="value">{{ $reinscription->directeur_valide ? 'Oui ✓' : 'Non' }}</span></td>
        </tr>
    </table>

    @if(!empty($reinscription->thesis_progress))
        <div class="section-title" style="margin-top: 5px; padding: 2px 8px;">État d'Avancement | تقدم الاطروحة</div>
        <div class="thesis-progress">
             {{ \Illuminate\Support\Str::limit($reinscription->thesis_progress, 400) }}
        </div>
    @endif

    <!-- Compact Articles & Communications List -->
    @if(($articles && $articles->count() > 0) || ($communications && $communications->count() > 0))
    <table style="width: 100%; margin-top: 5px;">
        <tr>
            @if($articles && $articles->count() > 0)
            <td style="width: {{ ($communications && $communications->count() > 0) ? '50%' : '100%' }}; vertical-align: top; padding-right: 5px;">
                <div class="section-title" style="margin-top: 0;">Articles ({{ $articles->count() }})</div>
                <ul class="compact-list">
                    @foreach($articles->take(3) as $article)
                        <li class="compact-item">
                            <div class="item-title">{{ \Illuminate\Support\Str::limit($article->titre, 40) }}</div>
                            <div class="item-meta">Type: {{ $article->type }} | {{ $article->annee }}</div>
                        </li>
                    @endforeach
                    @if($articles->count() > 3)
                        <li class="compact-item" style="text-align: center; color: #666;">+ {{ $articles->count() - 3 }} autres...</li>
                    @endif
                </ul>
            </td>
            @endif

            @if($communications && $communications->count() > 0)
            <td style="width: {{ ($articles && $articles->count() > 0) ? '50%' : '100%' }}; vertical-align: top; padding-left: 5px;">
                <div class="section-title" style="margin-top: 0;">Communications ({{ $communications->count() }})</div>
                <ul class="compact-list">
                    @foreach($communications->take(3) as $comm)
                        <li class="compact-item">
                            <div class="item-title">{{ \Illuminate\Support\Str::limit($comm->titre, 40) }}</div>
                            <div class="item-meta">{{ $comm->annee }}</div>
                        </li>
                    @endforeach
                    @if($communications->count() > 3)
                        <li class="compact-item" style="text-align: center; color: #666;">+ {{ $communications->count() - 3 }} autres...</li>
                    @endif
                </ul>
            </td>
            @endif
        </tr>
    </table>
    @endif

    <div class="footer">
        Reçu généré le {{ now()->format('d/m/Y à H:i') }} | ID: {{ $reinscription->id }} | Page 1/1
    </div>
</body>
</html>
