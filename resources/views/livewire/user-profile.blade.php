<div class="portal-profile-content">
    <p class="portal-profile-required"><span class="profile-required" aria-hidden="true">*</span> {{ __('messages.required_fields') }}</p>

    @if(session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="save" class="portal-profile-form">
        <fieldset class="portal-profile-card">
            <legend>{{ __('messages.profile_details') }}</legend>
            <div class="portal-profile-fields">
                <div class="portal-field">
                    <label for="profile-last-name">{{ __('messages.name') }} <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-last-name" type="text" wire:model="nom_fr" autocomplete="family-name" required>
                </div>
                <div class="portal-field portal-field-ar">
                    <label for="profile-last-name-ar"><span lang="ar" dir="rtl">الاسم العائلي</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-last-name-ar" type="text" wire:model="nom_arabe" lang="ar" dir="rtl" required>
                </div>
                <div class="portal-field">
                    <label for="profile-first-name">{{ __('messages.first_name') }} <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-first-name" type="text" wire:model="prenom_fr" autocomplete="given-name" required>
                </div>
                <div class="portal-field portal-field-ar">
                    <label for="profile-first-name-ar"><span lang="ar" dir="rtl">الاسم الشخصي</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-first-name-ar" type="text" wire:model="prenom_arabe" lang="ar" dir="rtl" required>
                </div>
                <div class="portal-field">
                    <label for="profile-cin">CIN <span lang="ar" dir="rtl">رقم البطاقة الوطنية</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-cin" type="text" wire:model="cin" required>
                </div>
                <div class="portal-field">
                    <label for="profile-cne">CNE <span lang="ar" dir="rtl">الرقم الوطني للطالب</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-cne" type="text" wire:model="cne" required>
                </div>
                <div class="portal-field">
                    <label for="profile-gender">{{ __('messages.gender') }} <span lang="ar" dir="rtl">الجنس</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <select id="profile-gender" wire:model="genre" required>
                        <option value="">Sélectionnez</option>
                        <option value="Homme">{{ __('messages.male') }}</option>
                        <option value="Femme">{{ __('messages.female') }}</option>
                    </select>
                </div>
                <div class="portal-field">
                    <label for="profile-birth-date">{{ __('messages.birth_date') }} <span lang="ar" dir="rtl">تاريخ الميلاد</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-birth-date" type="date" wire:model="date_naissance" autocomplete="bday" required>
                </div>
                <div class="portal-field">
                    <label for="profile-family-status">{{ __('messages.marital_status') }} <span lang="ar" dir="rtl">الحالة العائلية</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <select id="profile-family-status" wire:model="situation_familiale" required>
                        <option value="">Sélectionnez</option>
                        <option value="Célibataire">Célibataire</option>
                        <option value="Marié(e)">Marié(e)</option>
                        <option value="Divorcé(e)">Divorcé(e)</option>
                        <option value="Veuf(ve)">Veuf(ve)</option>
                    </select>
                </div>
                <div class="portal-field">
                    <label for="profile-admin-status">{{ __('messages.admin_status') }} <span lang="ar" dir="rtl">الحالة المهنية</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <select id="profile-admin-status" wire:model="situation_administrative" required>
                        <option value="">Sélectionnez</option>
                        <option value="Fonctionnaire">Fonctionnaire</option>
                        <option value="Salarié">Salarié</option>
                        <option value="Sans emploi">Sans emploi</option>
                    </select>
                </div>
                <div class="portal-field">
                    <label for="profile-orcid">ORCID <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-orcid" type="text" wire:model="orcid" required>
                </div>
                <div class="portal-field">
                    <label for="profile-phone">{{ __('messages.phone') }} <span lang="ar" dir="rtl">رقم الهاتف</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-phone" type="tel" wire:model="telephone" autocomplete="tel" required>
                </div>
                <div class="portal-field">
                    <label for="profile-email">{{ __('messages.email') }} <span lang="ar" dir="rtl">البريد الإلكتروني</span> <span class="profile-required" aria-hidden="true">*</span></label>
                    <input id="profile-email" type="email" wire:model="email" autocomplete="email" required>
                </div>
            </div>
        </fieldset>

        <div class="portal-profile-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check2" aria-hidden="true"></i>
                {{ __('messages.save') }}
            </button>
        </div>
    </form>
</div>
