<script>
(function(){
    // Elements
    const fileInput = document.getElementById('rapport_file');
    const dropZone = document.getElementById('dropZone');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const checkbox = document.getElementById('directeur_valide');
    const selectYear = document.getElementById('annee_inscription');
    const thesisProgress = document.getElementById('thesis_progress');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('reinscriptionForm');
    const derogationAlert = document.getElementById('derogationAlert');


    // Drag and Drop Handlers
    if(dropZone){
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-blue-400', 'bg-blue-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-blue-400', 'bg-blue-50');
            }, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if(fileInput && files.length > 0){
            fileInput.files = files;
            updateState();
        }
    }

    // File selection update
    function updateState(){
        const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
        const isChecked = checkbox ? checkbox.checked : false;
        const yearSelected = selectYear && selectYear.value !== '';
        const hasThesisProgress = thesisProgress && thesisProgress.value.trim().length > 0;

        console.log('=== Form State Check ===');
        console.log('Has File:', hasFile);
        console.log('Checkbox Checked:', isChecked);
        console.log('Year Selected:', yearSelected, '- Value:', selectYear ? selectYear.value : 'N/A');
        console.log('Has Thesis Progress:', hasThesisProgress, '- Length:', thesisProgress ? thesisProgress.value.trim().length : 0);

        // Update file preview
        if(hasFile){
            const file = fileInput.files[0];
            fileName.textContent = 'Fichier sélectionné: ' + file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
            filePreview.classList.remove('hidden');
        } else {
            if(filePreview) filePreview.classList.add('hidden');
        }

        // Check derogation
        if(yearSelected && (selectYear.value === '4' || selectYear.value === '5' || selectYear.value === '6')){
            if(derogationAlert) derogationAlert.classList.remove('hidden');
        } else {
            if(derogationAlert) derogationAlert.classList.add('hidden');
        }

        // Read completeness status
        const completenessDiv = document.getElementById('completeness-status');
        const isProfileComplete = completenessDiv && completenessDiv.dataset.profile === '1';
        const isTheseComplete = completenessDiv && completenessDiv.dataset.these === '1';

        // Enable/disable submit - Only require thesis progress, checkbox, and completeness
        // File and year are optional since those fields were removed
        if(isChecked && hasThesisProgress && isProfileComplete && isTheseComplete){
            if(submitBtn) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                console.log('✅ Button ENABLED - All required conditions met!');
            }
        } else {
            if(submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                console.log('❌ Button DISABLED - Missing:',
                    !isChecked ? 'Checkbox' : '',
                    !hasThesisProgress ? 'Thesis Progress' : '',
                    !isProfileComplete ? 'Profile Incomplete' : '',
                    !isTheseComplete ? 'Thesis Incomplete' : ''
                );
            }
        }
        console.log('========================');
    }

    // Event listeners
    if(fileInput) fileInput.addEventListener('change', updateState);
    if(checkbox) checkbox.addEventListener('change', updateState);
    if(selectYear) selectYear.addEventListener('change', updateState);
    if(thesisProgress) thesisProgress.addEventListener('input', updateState);

    // Form submission handler with validation feedback
    if(form){
        form.addEventListener('submit', function(e) {
            console.log('Form submitted');

            // Check form validity
            if (!form.checkValidity()) {
                console.log('Form validation failed');
                e.preventDefault();
                alert('Veuillez remplir tous les champs obligatoires');
                return false;
            }
        });
    }

    // Initial check
    updateState();
    console.log('Reinscription form initialized');
})();
</script>
