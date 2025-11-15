// Clavier arabe virtuel et gestionnaire de langue
const arabicInputs = document.querySelectorAll('[data-lang="ar"]');
const keyboardBtn = document.getElementById('keyboard-toggle');
let isArabicEnabled = false;

function toggleArabicKeyboard() {
    isArabicEnabled = !isArabicEnabled;
    arabicInputs.forEach(input => {
        if (isArabicEnabled) {
            input.style.backgroundColor = '#f0f9ff';
            input.style.direction = 'rtl';
            input.setAttribute('lang', 'ar');
            keyboardBtn.classList.add('text-blue-600');
        } else {
            input.style.backgroundColor = '';
            input.style.direction = 'ltr';
            input.removeAttribute('lang');
            keyboardBtn.classList.remove('text-blue-600');
        }
    });
}

// Activer automatiquement le mode arabe lors du focus sur les champs arabes
arabicInputs.forEach(input => {
    input.addEventListener('focus', () => {
        if (!isArabicEnabled) {
            toggleArabicKeyboard();
        }
    });
});
