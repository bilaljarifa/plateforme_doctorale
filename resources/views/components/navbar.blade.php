<!-- Clean Professional Navbar -->
<nav class="phd-main-navbar fixed-top">
    <div class="container-fluid px-4">
        <div class="navbar-layout">
            <!-- Left: PhD-MS Logo -->
            <div class="navbar-left">
                <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="brand-link">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span class="brand-text">PhD-MS</span>
                </a>
            </div>

            <!-- Center: Doctoral Cycle Info -->
            <div class="navbar-center">
                <div class="cycle-name">{{ __('messages.doctoral_cycle') }}</div>
            </div>

            <!-- Right: Ministry Logo & Language -->
            <div class="navbar-right">
                <img src="{{ asset('images/ministry-logo-new.png') }}" alt="Ministry Logo" class="ministry-logo">
                
                <div class="language-dropdown" id="languageDropdown">
                    <button class="language-btn" type="button" id="languageBtn" onclick="toggleLanguageMenu(event)">
                        <i class="bi bi-globe"></i>
                        {{ app()->getLocale() === 'fr' ? 'FR' : (app()->getLocale() === 'ar' ? 'AR' : 'EN') }}
                        <i class="bi bi-chevron-down" style="font-size: 0.7rem; margin-left: 0.2rem;"></i>
                    </button>
                    <div id="languageMenu" class="language-menu">
                        <a class="language-item" href="{{ route('language.switch', 'fr') }}">🇫🇷 Français</a>
                        <a class="language-item" href="{{ route('language.switch', 'ar') }}">🇲🇦 العربية</a>
                        <a class="language-item" href="{{ route('language.switch', 'en') }}">🇬🇧 English</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
/* Clean Professional Navbar */
.phd-main-navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: #050372;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    z-index: 1030;
    padding: 0.75rem 0;
}

.navbar-layout {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

/* Left: Brand */
.navbar-left {
    flex: 0 0 auto;
}

.brand-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    color: white;
}

.brand-link i {
    font-size: 1.5rem;
}

.brand-text {
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

/* Center: Doctoral Cycle */
.navbar-center {
    flex: 1;
    text-align: center;
}

.cycle-name {
    color: white;
    font-size: 1.05rem;
    font-weight: 700;
    line-height: 1.3;
    letter-spacing: 0.5px;
}

.cycle-name-ar {
    color: rgba(255,255,255,0.95);
    font-size: 0.95rem;
    font-weight: 600;
    margin-top: 0.1rem;
}

/* Right: Logo & Language */
.navbar-right {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.ministry-logo {
    height: 45px;
    width: auto;
}

/* Language Button */
.language-dropdown {
    position: relative;
}

.language-btn {
    display: flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.4rem 0.75rem;
    background: white;
    color: #050372;
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 6px;
    font-weight: 700;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.language-btn:hover {
    background: #f8f9ff;
    border-color: #050372;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(5, 3, 114, 0.2);
}

.language-btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(5, 3, 114, 0.15);
}

.language-btn i {
    font-size: 0.85rem;
    color: #050372;
}

.language-btn i.bi-chevron-down {
    font-size: 0.6rem;
    transition: transform 0.3s ease;
}

.language-dropdown.active .language-btn i.bi-chevron-down {
    transform: rotate(180deg);
}

/* Language Menu Dropdown */
.language-menu {
    position: absolute;
    right: 0;
    top: calc(100% + 0.5rem);
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    min-width: 150px;
    z-index: 9999;
    overflow: hidden;
    display: none;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.2s ease, transform 0.2s ease;
}

.language-menu.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.language-item {
    display: block;
    padding: 0.6rem 1rem;
    color: #111827 !important;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.2s;
    border-bottom: 1px solid #f3f4f6;
}

.language-item:last-child {
    border-bottom: none;
}

.language-item:hover {
    background: #eff6ff;
    color: #050372 !important;
    padding-left: 1.25rem;
}

/* Responsive */
@media (max-width: 992px) {
    .navbar-center {
        display: none;
    }
}

@media (max-width: 768px) {
    .brand-text {
        font-size: 1.2rem;
    }
    
    .ministry-logo {
        height: 35px;
    }
    
    .language-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
}

@media (max-width: 576px) {
    .phd-main-navbar {
        padding: 0.5rem 0;
    }
    
    .navbar-layout {
        gap: 1rem;
    }
    
    .brand-link i {
        font-size: 1.2rem;
    }
    
    .brand-text {
        font-size: 1rem;
    }
    
    .ministry-logo {
        height: 30px;
    }
    
    .language-btn {
        padding: 0.3rem 0.6rem;
        font-size: 0.75rem;
    }
    
    .navbar-right {
        gap: 1rem;
    }
}

/* Body padding */
body {
    padding-top: 80px !important;
}

@media (max-width: 768px) {
    body {
        padding-top: 70px !important;
    }
}
</style>

<script>
// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Language dropdown script loaded');
    
    // Verify elements exist
    const languageBtn = document.getElementById('languageBtn');
    const languageMenu = document.getElementById('languageMenu');
    const languageDropdown = document.getElementById('languageDropdown');
    
    console.log('Language button:', languageBtn);
    console.log('Language menu:', languageMenu);
    console.log('Language dropdown:', languageDropdown);
    
    if (!languageBtn || !languageMenu) {
        console.error('Language elements not found!');
        return;
    }
});

function toggleLanguageMenu(event) {
    event.stopPropagation();
    console.log('Toggle menu clicked');
    
    const menu = document.getElementById('languageMenu');
    if (menu) {
        menu.classList.toggle('show');
        console.log('Menu toggled. Has show class:', menu.classList.contains('show'));
    } else {
        console.error('Menu element not found!');
    }
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('languageDropdown');
    const menu = document.getElementById('languageMenu');
    
    if (dropdown && menu && !dropdown.contains(event.target)) {
        menu.classList.remove('show');
    }
});

// Close menu on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const menu = document.getElementById('languageMenu');
        if (menu) {
            menu.classList.remove('show');
        }
    }
});
</script>
