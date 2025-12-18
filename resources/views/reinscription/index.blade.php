@extends('layouts.dashboard')

@section('content')
<div class="reinscription-container">
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Completeness Check Logic -->
            <div id="completeness-status" 
                 data-profile="{{ $isProfileComplete ? '1' : '0' }}" 
                 data-these="{{ $isTheseComplete ? '1' : '0' }}"
                 class="hidden">
            </div>

            <!-- TWO COLUMN LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- ZONE A: Comprehensive Information (Left Column) -->
                <div class="space-y-3 overflow-y-auto" style="max-height: 75vh;">
                    
                    <!-- PROFIL -->
                    <details class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                        <summary class="text-sm font-semibold text-blue-700 cursor-pointer mb-2 hover:text-blue-900">PROFIL</summary>
                        <div class="space-y-1.5 pl-2">
                            <div><label class="block text-xs font-medium text-gray-600">Nom (Fr) <span class="text-red-600">*</span></label><input type="text" readonly value="{{ $user->name ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Prénom (Fr) <span class="text-red-600">*</span></label><input type="text" readonly value="{{ $user->prenom ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">الإسم العائلي <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->nom_arabe ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" dir="rtl" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">الإسم الشخصي <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->prenom_arabe ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" dir="rtl" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">CIN <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->cin ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">CNE <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->cne ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Date de naissance <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->date_naissance ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Email <span class="text-red-600">*</span></label><input type="text" readonly value="{{ $user->email ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Téléphone <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->telephone ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Genre <span class="text-red-600">*</span></label><input type="text" readonly value="{{ ucfirst(optional($user->doctorantProfile)->genre ?? 'N/A') }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Situation Familiale <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->situation_familiale ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Situation Administrative <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->situation_administrative ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">ORCID <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->doctorantProfile)->orcid ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                        </div>
                    </details>

                    <!-- THÈSE -->
                    <details class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                        <summary class="text-sm font-semibold text-blue-700 cursor-pointer mb-2 hover:text-blue-900">THÈSE</summary>
                        <div class="space-y-1.5 pl-2">
                            <div><label class="block text-xs font-medium text-gray-600">Apogée <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->these)->apogee ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Centre Etudes Doctorales <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional(optional($user->these)->ced)->intitule ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Formations doctorales <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional(optional($user->these)->ped)->intitule ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Sujet de Thèse <span class="text-red-600">*</span></label><textarea readonly class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" rows="2">{{ optional(optional($user->these)->sujet)->intitule_sujet ?? 'N/A' }}</textarea></div>
                            <div><label class="block text-xs font-medium text-gray-600">Année inscription <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->these)->annee_inscription ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Année 1ère inscription <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->these)->annee_premiere_inscription ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Etablissement <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional(optional($user->these)->etablissement)->intitulefr ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Laboratoire <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional(optional($user->these)->laboratoire)->intitule ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            <div><label class="block text-xs font-medium text-gray-600">Directeur de thèse <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional(optional($user->these)->directeur)->nom_fr ?? 'N/A' }} {{ optional(optional($user->these)->directeur)->prenom ?? '' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                            @if(optional($user->these)->co_directeur_type && optional($user->these)->co_directeur_type !== 'non')
                            <div><label class="block text-xs font-medium text-gray-600">Co-Directeur <span class="text-red-600">*</span></label>
                                @if(optional($user->these)->co_directeur_type === 'interne')
                                    <input type="text" readonly value="{{ optional(optional($user->these)->coDirecteur)->nom_fr ?? '' }} {{ optional(optional($user->these)->coDirecteur)->prenom ?? '' }} (Interne)" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" />
                                @else
                                    <input type="text" readonly value="{{ optional($user->these)->co_directeur_nom ?? '' }} {{ optional($user->these)->co_directeur_prenom ?? '' }} ({{ optional($user->these)->co_directeur_etablissement ?? '' }})" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" />
                                @endif
                            </div>
                            @endif
                            <div><label class="block text-xs font-medium text-gray-600">Date prévue soutenance <span class="text-red-600">*</span></label><input type="text" readonly value="{{ optional($user->these)->date_prevue_soutenance ?? 'N/A' }}" class="w-full px-2 py-1 bg-gray-50 border border-gray-200 rounded text-gray-700 text-xs" /></div>
                        </div>
                    </details>

                    <!-- ARTICLES -->
                    <details class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                        <summary class="text-sm font-semibold text-blue-700 cursor-pointer mb-2 hover:text-blue-900">ARTICLES ({{ $articles->count() }})</summary>
                        @if($articles->count() > 0)
                            <div class="space-y-2 pl-2 max-h-48 overflow-y-auto">
                                @foreach($articles as $article)
                                    <div class="p-2 bg-gray-50 border-l-2 border-blue-500 rounded text-xs">
                                        <div class="font-semibold text-gray-800">{{ $article->titre }} <span class="text-red-600">*</span></div>
                                        <div class="text-gray-600 mt-0.5">
                                            <strong>Type:</strong> {{ ucfirst($article->type ?? 'N/A') }} <span class="text-red-600">*</span> | 
                                            <strong>Année:</strong> {{ $article->annee ?? 'N/A' }} <span class="text-red-600">*</span>
                                        </div>
                                        @if($article->doi)<div class="text-gray-600">DOI: {{ $article->doi }}</div>@endif
                                        @if($article->lien)<div class="text-gray-600 truncate">Lien: <a href="{{ $article->lien }}" target="_blank" class="text-blue-600">{{ Str::limit($article->lien, 30) }}</a></div>@endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-500 italic pl-2">Aucun article enregistré</p>
                        @endif
                    </details>

                    <!-- COMMUNICATIONS -->
                    <details class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
                        <summary class="text-sm font-semibold text-blue-700 cursor-pointer mb-2 hover:text-blue-900">COMMUNICATIONS ({{ $communications->count() }})</summary>
                        @if($communications->count() > 0)
                            <div class="space-y-2 pl-2 max-h-48 overflow-y-auto">
                                @foreach($communications as $communication)
                                    <div class="p-2 bg-gray-50 border-l-2 border-green-500 rounded text-xs">
                                        <div class="font-semibold text-gray-800">{{ $communication->titre }} <span class="text-red-600">*</span></div>
                                        <div class="text-gray-600 mt-0.5"><strong>Année:</strong> {{ $communication->annee ?? 'N/A' }} <span class="text-red-600">*</span></div>
                                        @if($communication->doi)<div class="text-gray-600">DOI: {{ $communication->doi }}</div>@endif
                                        @if($communication->lien)<div class="text-gray-600 truncate">Lien: <a href="{{ $communication->lien }}" target="_blank" class="text-blue-600">{{ Str::limit($communication->lien, 30) }}</a></div>@endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-gray-500 italic pl-2">Aucune communication enregistrée</p>
                        @endif
                    </details>
                </div>

                <!-- ZONE B: Form (Right Column) -->
                <div class="bg-white p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-green-700 border-b-2 border-green-600 pb-2 mb-4">Dossier d'Avancement</h2>

                    <form action="{{ route('reinscription.store') }}\" method="POST" enctype="multipart/form-data" id="reinscriptionForm">
                        @csrf

                        <!-- Thesis Progress -->
                        <div class="mb-4">
                            <label for="thesis_progress" class="block text-xs font-medium text-gray-700 mb-1">
                                État d'Avancement de la Thèse || تقدم الاطروحة <span class="text-red-600">*</span>
                            </label>
                            <textarea
                                id="thesis_progress"
                                name="thesis_progress"
                                required
                                rows="6"
                                placeholder="Décrivez le progrès actuel de votre thèse, les chapitres complétés, les résultats obtenus, et les prochaines étapes..."
                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            ></textarea>
                            @error('thesis_progress') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Certification Checkbox -->
                        <div class="mb-4 pt-3 border-t">
                            <div class="flex items-start gap-2">
                                <input
                                    id="directeur_valide"
                                    name="directeur_valide"
                                    type="checkbox"
                                    value="1"
                                    required
                                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-0.5"
                                />
                                <label for="directeur_valide" class="text-xs text-gray-700">
                                    Je certifie l'exactitude des informations || أشهد بصحة المعلومات <span class="text-red-600">*</span>
                                </label>
                            </div>
                            @error('directeur_valide') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <input type="hidden" id="derniere_publication" name="derniere_publication" value="" />

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-3 border-t">
                            <button
                                id="submitBtn"
                                type="submit"
                                disabled
                                class="btn btn-primary"
                                style="opacity: 0.5; cursor: not-allowed;"
                            >
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.reinscription-container {
    background: #ffffff;
    min-height: calc(100vh - 150px);
    padding: 2rem 0;
}

/* Card Styling */
details, .bg-white {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

details:hover, .bg-white:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}

/* Details/Summary Styling */
details summary {
    list-style: none;
    user-select: none;
    background: linear-gradient(135deg, #f6f8fb 0%, #e9ecef 100%);
    padding: 0.75rem;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
}

details summary::-webkit-details-marker {
    display: none;
}

details summary::before {
    content: '▶';
    display: inline-block;
    margin-right: 0.5em;
    transition: transform 0.3s ease;
    font-size: 0.8em;
}

details[open] summary::before {
    transform: rotate(90deg);
}

details summary:hover {
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
}

/* Form Section Header */
h2 {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white !important;
    padding: 1rem;
    border-radius: 0.5rem 0.5rem 0 0;
    margin: -1rem -1rem 1rem -1rem;
    border: none !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Input Fields */
input[readonly], textarea[readonly] {
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
}

textarea, input[type="text"]:not([readonly]) {
    transition: all 0.3s ease;
    border: 2px solid #e5e7eb;
}

textarea:focus, input[type="text"]:not([readonly]):focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

/* Button Styling */
.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover:not(:disabled) {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
}

.btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
}

/* Status Badges */
.text-green-600 {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white !important;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
}

.text-red-600 {
    color: #dc2626;
    font-weight: 600;
}

/* Article/Communication Cards */
.border-l-2 {
    transition: all 0.2s ease;
}

.border-l-2:hover {
    background: white !important;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transform: translateX(4px);
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .grid {
        grid-template-columns: 1fr !important;
    }
    
    .reinscription-container {
        padding: 1rem 0;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

details {
    animation: fadeIn 0.3s ease;
}

/* Checkbox Styling */
input[type="checkbox"] {
    cursor: pointer;
    accent-color: #667eea;
}

input[type="checkbox"]:checked {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>

@include('reinscription._reinscription_js')
@endsection
