<div class="profile-container">
    <div class="profile-header">
        <h2 class="profile-title">Détails Profil</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="save" class="profile-form">
        <div class="form-columns">
            <!-- Colonne Gauche: Français -->
            <div class="form-column">
                <div class="form-group">
                    <label>Nom <span class="required">*</span></label>
                    <input type="text" wire:model="nom_fr" required class="form-input" />
                </div>

                <div class="form-group">
                    <label>Prénom <span class="required">*</span></label>
                    <input type="text" wire:model="prenom_fr" required class="form-input" />
                </div>

                <div class="form-group">
                    <label>CIN || رقم البطاقة الوطنية <span class="required">*</span></label>
                    <input type="text" wire:model="cin" required class="form-input" />
                </div>

                <div class="form-group">
                    <label>CNE || الرقم الوطني للطالب  <span class="required">*</span></label>
                    <input type="text" wire:model="cne" required class="form-input" />
                </div>

                <div class="form-group">
                    <label>Date de naissance || تاريخ الميلاد <span class="required">*</span></label>
                    <input type="date" wire:model="date_naissance" required class="form-input" />
                </div>

                <div class="form-group">
                    <label>Téléphone || الرقم الاتصال <span class="required">*</span></label>
                    <input type="tel" wire:model="telephone" required class="form-input" />
                </div>
            </div>

            <!-- Colonne Droite: Arabe + Options -->
            <div class="form-column">
                <div class="form-group">
                    <label>الإسم العائلي <span class="required">*</span></label>
                    <input type="text" wire:model="nom_arabe" dir="rtl" required class="form-input" />
                </div>

                <div class="form-group">
                    <label> الإسم الشخصي<span class="required">*</span></label>
                    <input type="text" wire:model="prenom_arabe" dir="rtl" required class="form-input" />
                </div>

                <div class="form-group">
                    <label>Genre || الجنس <span class="required">*</span></label>
                    <select wire:model="genre" required class="form-input">
                        <option value="">Sélectionnez</option>
                        <option value="Homme">Masculin</option>
                        <option value="Femme">Féminin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Situation Familiale || الحالة العائلية <span class="required">*</span></label>
                    <select wire:model="situation_familiale" required class="form-input">
                        <option value="">Sélectionnez</option>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Marié(e)">Marié(e)</option>
                        <option value="Divorcé(e)">Divorcé(e)</option>
                        <option value="Veuf(ve)">Veuf(ve)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Situation Administrative || الحالة المهنية  <span class="required">*</span></label>
                    <select wire:model="situation_administrative" required class="form-input">
                        <option value="">Sélectionnez</option>
                        <option value="Fonctionnaire">Fonctionnaire</option>
                        <option value="Salarié">Salarié</option>
                        <option value="Sans emploi">Sans emploi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>ORCID || الرقم ORCID <span class="required">*</span></label>
                    <input type="text" wire:model="orcid" required class="form-input" />
                </div>
            </div>
        </div>

        <!-- Email: Pleine largeur -->
        <div class="form-full-width">
            <label>E-mail || البريد الالكتروني <span class="required">*</span></label>
            <input type="email" wire:model="email" required class="form-input" />
        </div>

        <!-- Bouton -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
</div>

<style>
.profile-container {
    background: transparent;
    padding: 0;
    border-radius: 0;
    max-width: 100%;
    width: 100%;
    margin: 0;
}

.profile-header {
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
}

.profile-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a202c;
    margin: 0;
}

.alert {
    padding: 0.75rem 1rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    font-size: 14px;
}

.alert-success {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.profile-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-columns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
}

.form-column {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
}

.form-group label {
    font-size: 13px;
    font-weight: 500;
    color: #4a5568;
}

.required {
    color: #dc2626;
}

.form-input {
    border: 1px solid #e0e6ed;
    border-radius: 6px;
    padding: 0.8rem 1rem;
    font-size: 15px;
    background: white;
    transition: all 0.2s ease;
    width: 100%;
}

.form-input:focus {
    outline: none;
    border-color: #0066cc;
    box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
}

.form-full-width {
    display: flex;
    flex-direction: column;
    gap: 0.4rem;
    margin-top: 0.5rem;
}

.form-full-width label {
    font-size: 13px;
    font-weight: 500;
    color: #4a5568;
}

.form-full-width .form-input {
    width: 100%;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e0e6ed;
}

.btn {
    padding: 0.6rem 1.5rem;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0052a3 0%, #003d7a 100%);
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 102, 204, 0.3);
}

@media (max-width: 768px) {
    .form-columns {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .profile-container {
        padding: 1rem;
    }
}
</style>
