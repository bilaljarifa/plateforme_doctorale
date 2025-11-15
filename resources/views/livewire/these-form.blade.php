<div class="max-w-4xl mx-auto">
    <!-- Notification container -->
    <div id="these-notification" class="fixed top-5 right-5 z-50" aria-live="polite"></div>
    <div class="bg-gray-50 rounded-lg shadow-sm p-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Détails</h2>

        {{-- Server-side flash messages (fallback) --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-700">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-700">{{ session('error') }}</div>
        @endif

        <form wire:submit.prevent="save" class="space-y-4">
            <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                <!-- Première colonne -->
                <div class="space-y-4">
                    <div>
                        <label for="apogee" class="block text-sm font-medium text-gray-600 mb-1">Apogée <span class="text-red-600">*</span></label>
                        <input type="text" id="apogee" wire:model="these.apogee" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="centre_etudes_doctorales" class="block text-sm font-medium text-gray-600 mb-1">Centre des Etudes Doctorales <span class="text-red-600">*</span></label>
                        <input type="text" id="centre_etudes_doctorales" wire:model="these.centre_etudes_doctorales" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="formations_doctorales" class="block text-sm font-medium text-gray-600 mb-1">Formations doctorales <span class="text-red-600">*</span></label>
                        <input type="text" id="formations_doctorales" wire:model="these.formations_doctorales" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="directeur_these" class="block text-sm font-medium text-gray-600 mb-1">Directeur de thèse <span class="text-red-600">*</span></label>
                        <select id="directeur_these" wire:model="these.directeur_these" required
                                class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            <option value="">Sélectionnez</option>
                            <option value="1">El Amrani Mohamed (Laboratoire d'Informatique)</option>
                            <option value="2">Benjelloun Amina (Laboratoire de Mathématiques)</option>
                            <option value="3">Kabbaj Youssef (Laboratoire de Physique)</option>
                        </select>
                    </div>

                    <div>
                        <label for="sujet_these" class="block text-sm font-medium text-gray-600 mb-1">Sujet de Thèse <span class="text-red-600">*</span></label>
                        <textarea id="sujet_these" wire:model="these.sujet_these" required rows="4"
                                  class="mt-1 block w-full text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3 py-2"></textarea>
                    </div>
                </div>

                <!-- Deuxième colonne -->
                <div class="space-y-4">
                    <div>
                        <label for="annee_inscription" class="block text-sm font-medium text-gray-600 mb-1">Année d'inscription <span class="text-red-600">*</span></label>
                        <input type="text" id="annee_inscription" wire:model="these.annee_inscription" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="annee_premiere_inscription" class="block text-sm font-medium text-gray-600 mb-1">Année 1ère inscription <span class="text-red-600">*</span></label>
                        <input type="text" id="annee_premiere_inscription" wire:model="these.annee_premiere_inscription" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="etablissement" class="block text-sm font-medium text-gray-600 mb-1">Etablissement <span class="text-red-600">*</span></label>
                        <input type="text" id="etablissement" wire:model="these.etablissement" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>

                    <div>
                        <label for="laboratoire" class="block text-sm font-medium text-gray-600 mb-1">Laboratoire <span class="text-red-600">*</span></label>
                        <select id="laboratoire" wire:model="these.laboratoire" required
                                class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            <option value="">Sélectionnez</option>
                            <option value="1">Laboratoire d'Informatique (Université Ibn Tofail)</option>
                            <option value="2">Laboratoire de Mathématiques (Université Ibn Tofail)</option>
                            <option value="3">Laboratoire de Physique (Université Hassan II)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Co-Directeur de thèse <span class="text-red-600">*</span></label>
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model="these.co_directeur_type" value="non" class="form-radio text-indigo-600">
                                <span class="ml-2 text-sm text-gray-700">Non</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" wire:model="these.co_directeur_type" value="interne" class="form-radio text-indigo-600">
                                <span class="ml-2 text-sm text-gray-700">Interne</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" wire:model="these.co_directeur_type" value="externe" class="form-radio text-indigo-600">
                                <span class="ml-2 text-sm text-gray-700">Externe</span>
                            </label>
                        </div>
                    </div>

                    <!-- Champs conditionnels pour co-directeur -->
                    @if($these['co_directeur_type'] === 'interne')
                        <div>
                            <label for="co_directeur_nom_complet" class="block text-sm font-medium text-gray-600 mb-1">Nom complet (co-directeur) <span class="text-red-600">*</span></label>
                                <select id="co_directeur_nom_complet" wire:model="these.co_directeur_nom_complet" required
                                    class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                                <option value="">Sélectionnez</option>
                                <option value="1">El Amrani Mohamed (Laboratoire d'Informatique)</option>
                                <option value="2">Benjelloun Amina (Laboratoire de Mathématiques)</option>
                                <option value="3">Kabbaj Youssef (Laboratoire de Physique)</option>
                            </select>
                        </div>
                    @elseif($these['co_directeur_type'] === 'externe')
                        <div class="space-y-4">
                            <div>
                                <label for="co_directeur_nom" class="block text-sm font-medium text-gray-600 mb-1">Nom (co-directeur) <span class="text-red-600">*</span></label>
                                <input type="text" id="co_directeur_nom" wire:model="these.co_directeur_nom" required
                                       class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            </div>
                            <div>
                                <label for="co_directeur_prenom" class="block text-sm font-medium text-gray-600 mb-1">Prénom (co-directeur) <span class="text-red-600">*</span></label>
                                <input type="text" id="co_directeur_prenom" wire:model="these.co_directeur_prenom" required
                                       class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            </div>
                            <div>
                                <label for="co_directeur_etablissement" class="block text-sm font-medium text-gray-600 mb-1">Etablissement (co-directeur) <span class="text-red-600">*</span></label>
                                <input type="text" id="co_directeur_etablissement" wire:model="these.co_directeur_etablissement" required
                                       class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="date_prevue_soutenance" class="block text-sm font-medium text-gray-600 mb-1">Date prévue de soutenance <span class="text-red-600">*</span></label>
                        <input type="date" id="date_prevue_soutenance" wire:model="these.date_prevue_soutenance" required
                               class="mt-1 block w-full h-10 text-sm rounded-md bg-white border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 px-3">
                    </div>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end mt-6">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                    Sauvegarder
                </button>
            </div>
        </form>
    </div>
    <script>
        // Listen for Livewire browser events and show a small toast
        function showToast(message, type = 'success') {
            const container = document.getElementById('these-notification');
            if (!container) return;
            const id = 'toast-' + Date.now();
            const bg = type === 'success' ? 'bg-green-50 border-green-200 text-green-700' : 'bg-red-50 border-red-200 text-red-700';
            const toast = document.createElement('div');
            toast.id = id;
            toast.className = `mb-2 p-3 rounded border ${bg}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 4500);
        }

        window.addEventListener('theseSaved', event => {
            showToast(event.detail.message, 'success');
        });

        window.addEventListener('theseError', event => {
            showToast(event.detail.message, 'error');
        });
    </script>
</div>
