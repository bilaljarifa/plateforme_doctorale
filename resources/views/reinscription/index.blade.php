@extends('layouts.dashboard')

@section('content')
<div class="reinscription-container">
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header (compact) -->
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-semibold text-gray-900">Réinscription au Doctorat || إعادة التسجيل في الدكتوراه</h1>
                <p class="text-sm text-gray-500 mt-1">Année Universitaire: {{ date('Y') }}-{{ date('Y') + 1 }}</p>
            </div>

            <!-- TWO COLUMN LAYOUT: Zone A (Left) + Zone B (Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- ZONE A: Fixed Information (Left Column) -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b-2 border-blue-600 pb-2">Informations Fixes || المعلومات الثابتة</h2>

                    <!-- Row 1: Name, CNE, CIN -->
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Nom et Prénom || الاسم الكامل</label>
                            <input type="text" readonly value="{{ $user->name }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">CNE</label>
                            <input type="text" readonly value="{{ optional($user->doctorantProfile)->cne ?? 'N/A' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">CIN</label>
                            <input type="text" readonly value="{{ optional($user->doctorantProfile)->cin ?? 'N/A' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                    </div>

                    <!-- Row 2: Thesis Info -->
                    <div class="space-y-3 pt-4 border-t">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Sujet de Thèse || موضوع الأطروحة</label>
                            <input type="text" readonly value="{{ optional($user->these)->sujet->intitule_sujet ?? 'N/A' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Laboratoire || المختبر</label>
                            <input type="text" readonly value="{{ optional(optional($user->these)->laboratoire)->intitule ?? 'N/A' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Directeur de Thèse || المشرف</label>
                            <input type="text" readonly value="{{ optional(optional($user->these)->directeur)->nom_fr ?? 'N/A' }} {{ optional(optional($user->these)->directeur)->prenom ?? '' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                    </div>

                    <!-- Row 3: Contact & Personal Info -->
                    <div class="space-y-3 pt-4 border-t">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                            <input type="email" readonly value="{{ $user->email ?? 'N/A' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Téléphone</label>
                            <input type="text" readonly value="{{ optional($user->doctorantProfile)->telephone ?? 'N/A' }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Genre || النوع</label>
                            <input type="text" readonly value="{{ ucfirst(optional($user->doctorantProfile)->genre ?? 'N/A') }}" class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded text-gray-700 text-sm" />
                        </div>
                    </div>
                </div>

                <!-- ZONE B: Editable Information (Right Column) -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 border-b-2 border-green-600 pb-2 mb-4">Dossier d'Avancement || ملف التقدم</h2>

                    <form action="{{ route('reinscription.store') }}" method="POST" enctype="multipart/form-data" id="reinscriptionForm" class="space-y-4">
                        @csrf

                        <!-- Field 1: Niveau d'inscription -->
                        <div>
                            <label for="annee_inscription" class="block text-xs font-medium text-gray-700 mb-1">
                                Niveau d'Inscription || سنة التسجيل <span class="text-red-600">*</span>
                            </label>
                            <select
                                id="annee_inscription"
                                name="annee_inscription"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">-- Sélectionnez --</option>
                                <option value="2">2ème Année</option>
                                <option value="3">3ème Année</option>
                                <option value="4">4ème Année (Dérogation)</option>
                                <option value="5">5ème Année (Dérogation)</option>
                                <option value="6">6ème Année (Dérogation)</option>
                            </select>
                            @error('annee_inscription') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror

                            <!-- Derogation Alert -->
                            <div id="derogationAlert" class="hidden mt-2 p-2 bg-amber-50 border border-amber-200 rounded text-xs text-amber-800">
                                <p>⚠️ Demande de dérogation requise</p>
                            </div>
                        </div>

                        <!-- Field 2: Rapport d'activité (Drag & Drop) -->
                        <div>
                            <label for="rapport_file" class="block text-xs font-medium text-gray-700 mb-1">
                                Rapport d'Activité Signé || تقرير النشاط <span class="text-red-600">*</span>
                            </label>

                            <div id="dropZone" class="relative border-2 border-dashed border-gray-300 rounded p-4 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition bg-gray-50">
                                <p class="text-xs text-gray-600 mb-2">📄 PDF (Max 5MB)</p>
                                <p class="text-xs text-gray-500">Cliquez ou glissez-déposez votre fichier ici</p>
                                <input
                                    type="file"
                                    id="rapport_file"
                                    name="rapport_file"
                                    accept="application/pdf"
                                    required
                                    class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer"
                                    style="z-index: 1;"
                                />
                            </div>

                            <!-- Selected file display -->
                            <div id="filePreview" class="hidden mt-2 p-2 bg-green-50 border border-green-200 rounded text-xs text-green-800">
                                ✓ <span id="fileName">Fichier sélectionné</span>
                            </div>

                            @error('rapport_file') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Field 3: Thesis Progress / État d'Avancement -->
                        <div>
                            <label for="thesis_progress" class="block text-xs font-medium text-gray-700 mb-1">
                                État d'Avancement de la Thèse || تقدم الاطروحة <span class="text-red-600">*</span>
                            </label>
                            <textarea
                                id="thesis_progress"
                                name="thesis_progress"
                                required
                                rows="4"
                                placeholder="Décrivez le progrès actuel de votre thèse, les chapitres complétés, les résultats obtenus, et les prochaines étapes... || اكتب عن التقدم الحالي لأطروحتك..."
                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            ></textarea>
                            @error('thesis_progress') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Field 4: Validation Checkbox -->
                        <div class="pt-2 border-t">
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
                                    Je certifie l'exactitude des informations || أشهد بصحة المعلومات
                                    <span class="text-red-600">*</span>
                                </label>
                            </div>
                            @error('directeur_valide') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <input type="hidden" id="derniere_publication" name="derniere_publication" value="" />

                        <!-- Submit Button -->
                        <div class="flex justify-end gap-2 pt-4 border-t">
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
    background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
    min-height: calc(100vh - 150px);
    padding: 2rem 0;
}

/* Page Header */
.reinscription-container h1 {
    color: #1f2937;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.reinscription-container .text-gray-500 {
    color: #6b7280;
    font-weight: 500;
}

/* Section Headers */
.reinscription-container h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #050372;
    padding-bottom: 0.75rem;
    margin-bottom: 1rem;
    border-bottom: 3px solid #050372;
}

/* Form Cards */
.reinscription-container .space-y-4,
.reinscription-container > div {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

/* Input Fields - Read Only */
.reinscription-container input[readonly] {
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.65rem 1rem;
    color: #374151;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Labels */
.reinscription-container label {
    color: #374151;
    font-weight: 600;
    font-size: 0.85rem;
    margin-bottom: 0.4rem;
}

/* Form Inputs */
.reinscription-container select,
.reinscription-container textarea {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background: white;
}

.reinscription-container select:focus,
.reinscription-container textarea:focus {
    outline: none;
    border-color: #050372;
    box-shadow: 0 0 0 3px rgba(5,3,114,0.1);
}

/* Drop Zone */
#dropZone {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    transition: all 0.3s ease;
    cursor: pointer;
}

#dropZone:hover {
    border-color: #050372;
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(5,3,114,0.15);
}

#dropZone p {
    pointer-events: none;
    margin: 0.25rem 0;
}

/* File Preview */
#filePreview {
    background: #d1fae5;
    border: 1px solid #6ee7b7;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    color: #065f46;
    font-weight: 600;
}

/* Alert Boxes */
#derogationAlert {
    background: #fef3c7;
    border: 1px solid #fbbf24;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    color: #92400e;
}

.reinscription-container .bg-blue-50 {
    background: #eff6ff;
    border: 1px solid #93c5fd;
    border-radius: 8px;
    padding: 1rem;
}

/* Checkbox */
.reinscription-container input[type="checkbox"] {
    width: 1.1rem;
    height: 1.1rem;
    border-radius: 4px;
    border: 2px solid #d1d5db;
    cursor: pointer;
}

.reinscription-container input[type="checkbox"]:checked {
    background-color: #050372;
    border-color: #050372;
}

/* Submit Button */
.btn-primary {
    background: #050372;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(5,3,114,0.3);
}

.btn-primary:hover:not(:disabled) {
    background: #040261;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5,3,114,0.4);
}

.btn-primary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Required Star */
.text-red-600 {
    color: #dc2626;
    font-weight: 700;
}

/* Spacing Improvements */
.reinscription-container .space-y-3 > * + * {
    margin-top: 1rem;
}

.reinscription-container .space-y-4 > * + * {
    margin-top: 1.25rem;
}

/* Border Top sections */
.reinscription-container .border-t {
    border-top: 2px solid #e5e7eb;
    padding-top: 1.25rem;
    margin-top: 1.25rem;
}

/* Grid improvements */
.reinscription-container .grid {
    gap: 2rem;
}

@media (max-width: 1024px) {
    .reinscription-container .grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}
</style>

@include('reinscription._reinscription_js')
@endsection
