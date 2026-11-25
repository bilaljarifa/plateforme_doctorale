<script>
(() => {
    const form = document.getElementById('reinscriptionForm');
    const progress = form.elements.thesis_progress;
    const certification = form.elements.directeur_valide;
    const count = document.getElementById('registration-progress-count');
    const submit = document.getElementById('submitBtn');
    const ready = form.dataset.profileComplete === '1' && form.dataset.thesisComplete === '1';
    const formatter = new Intl.NumberFormat('fr-FR');

    function updateProgress() {
        const length = Array.from(progress.value.trim()).length;
        count.textContent = formatter.format(length) + ' / ' + formatter.format(progress.maxLength);
        submit.disabled = !ready || !certification.checked || length < progress.minLength || length > progress.maxLength;
    }

    progress.addEventListener('input', updateProgress);
    certification.addEventListener('change', updateProgress);
    updateProgress();
})();
</script>
