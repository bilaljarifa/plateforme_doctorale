<div class="max-w-4xl mx-auto py-4">
    <div class="bg-gray-50 rounded-lg shadow-sm p-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Détails</h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="space-y-4">
            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                <!-- Première colonne -->
                <div class="space-y-4">
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-600 mb-1">Nom <span class="text-red-600">*</span></label>
                        <input type="text" id="nom" wire:model="nom_fr" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-600 mb-1">Prénom <span class="text-red-600">*</span></label>
                        <input type="text" id="prenom" wire:model="prenom_fr" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="cin" class="block text-sm font-medium text-gray-600 mb-1">CIN <span class="text-red-600">*</span></label>
                        <input type="text" id="cin" wire:model="cin"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="cne" class="block text-sm font-medium text-gray-600 mb-1">CNE <span class="text-red-600">*</span></label>
                        <input type="text" id="cne" wire:model="cne"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="date_naissance" class="block text-sm font-medium text-gray-600 mb-1">Date de naissance</label>
                        <input type="date" id="date_naissance" wire:model="date_naissance"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-600 mb-1">Téléphone</label>
                        <input type="tel" id="telephone" wire:model="telephone"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>
                </div>

                <!-- Deuxième colonne -->
                <div class="space-y-4">
                    <div>
                        <label for="nom_ar" class="block text-sm font-medium text-gray-600 mb-1">الإسم <span class="text-red-600">*</span></label>
                        <input type="text" id="nom_ar" wire:model="nom_arabe" dir="rtl"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="prenom_ar" class="block text-sm font-medium text-gray-600 mb-1">النسب <span class="text-red-600">*</span></label>
                        <input type="text" id="prenom_ar" wire:model="prenom_arabe" dir="rtl"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-600 mb-1">Genre <span class="text-red-600">*</span></label>
                        <select id="genre" wire:model="genre"
                                class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            <option value="">Sélectionnez</option>
                            <option value="Homme">Masculin</option>
                            <option value="Femme">Féminin</option>
                        </select>
                    </div>

                    <div>
                        <label for="situation_familiale" class="block text-sm font-medium text-gray-600 mb-1">Situation Familiale</label>
                        <select id="situation_familiale" wire:model="situation_familiale"
                                class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            <option value="">Sélectionnez</option>
                            <option value="Célibataire">Célibataire</option>
                            <option value="Marié(e)">Marié(e)</option>
                            <option value="Divorcé(e)">Divorcé(e)</option>
                            <option value="Veuf(ve)">Veuf(ve)</option>
                        </select>
                    </div>

                    <div>
                        <label for="situation_administrative" class="block text-sm font-medium text-gray-600 mb-1">Situation Administrative</label>
                        <select id="situation_administrative" wire:model="situation_administrative"
                                class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            <option value="">Sélectionnez</option>
                            <option value="Fonctionnaire">Fonctionnaire</option>
                            <option value="Salarié">Salarié</option>
                            <option value="Sans emploi">Sans emploi</option>
                        </select>
                    </div>

                    <div>
                        <label for="orcid" class="block text-sm font-medium text-gray-600 mb-1">ORCID</label>
                        <input type="text" id="orcid" wire:model="orcid"
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>
                </div>
            </div>

            <!-- Champ Email en pleine largeur -->
            <div class="mt-6">
                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">E-mail</label>
                <input type="email" id="email" wire:model="email"
                       class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
