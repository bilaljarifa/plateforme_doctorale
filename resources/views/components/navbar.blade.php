<!-- Professional Navigation Component -->
<nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-lg">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand text-white fw-bold" href="{{ route('dashboard') }}">
            <svg class="d-inline-block align-text-top me-2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="2" width="8" height="8" rx="2" fill="currentColor"/>
                <rect x="14" y="2" width="8" height="8" rx="2" fill="currentColor" opacity="0.7"/>
                <rect x="2" y="14" width="8" height="8" rx="2" fill="currentColor" opacity="0.7"/>
                <rect x="14" y="14" width="8" height="8" rx="2" fill="currentColor"/>
            </svg>
            UIT Portal
        </a>

        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <!-- Dashboard Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="bi bi-house-fill me-2"></i>Dashboard
                        </a>
                    </li>

                    <!-- Articles Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">
                            <i class="bi bi-file-earmark me-2"></i>Articles
                        </a>
                    </li>

                    <!-- Thèse Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('these') }}">
                            <i class="bi bi-book me-2"></i>Thèse
                        </a>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfile">
                            <li><a class="dropdown-item" href="{{ route('profile.update') }}">
                                <i class="bi bi-gear me-2"></i>Profil
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" style="border: none; background: none; cursor: pointer;">
                                        <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Login Button -->
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm ms-2 text-primary fw-bold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                        </a>
                    </li>
                @endauth

                <!-- Language Selector -->
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarLanguage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe me-1"></i>Langue
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarLanguage">
                        <li><a class="dropdown-item" href="{{ route('language.switch', 'fr') }}">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 900 600'%3E%3Crect fill='%23002395' width='900' height='600'/%3E%3Crect fill='%23FFF' x='300' width='300' height='600'/%3E%3Crect fill='%23ED2939' x='600' width='300' height='600'/%3E%3C/svg%3E" width="20" class="me-2" alt="FR"> Français
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('language.switch', 'ar') }}">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 900 600'%3E%3Crect fill='%23CE1126' width='300' height='600'/%3E%3Crect fill='%23FFF' x='300' width='300' height='600'/%3E%3Crect fill='%23007A5E' x='600' width='300' height='600'/%3E%3C/svg%3E" width="20" class="me-2" alt="AR"> العربية
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('language.switch', 'en') }}">
                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 60 30'%3E%3CclipPath id='s'%3E%3Cpath d='M0,0 v30 h60 v-30 z'/%3E%3C/clipPath%3E%3CclipPath id='t'%3E%3Cpath d='M30,15 h30 v15 z v-15 h-30 z h-30 v-15 z v15 h30 z'/%3E%3C/clipPath%3E%3Cpath d='M0,0 v30 h60 v-30 z' fill='%23012169'/%3E%3Cpath d='M0,0 L60,30 M60,0 L0,30' stroke='%23fff' stroke-width='6' clip-path='url(%23s)'/%3E%3Cpath d='M0,0 L60,30 M60,0 L0,30' stroke='%23c8102e' stroke-width='4' clip-path='url(%23t)'/%3E%3Cpath d='M30,0 v30 M0,15 h60' stroke='%23fff' stroke-width='10'/%3E%3Cpath d='M30,0 v30 M0,15 h60' stroke='%23c8102e' stroke-width='6'/%3E%3C/svg%3E" width="20" class="me-2" alt="EN"> English
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    padding: 1rem 0;
}

.navbar-brand {
    font-size: 1.4rem;
    font-weight: 700;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
}

.nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    transition: all 0.3s ease;
    margin: 0 0.5rem;
    border-bottom: 2px solid transparent;
    padding-bottom: 0.25rem !important;
}

.nav-link:hover {
    color: #fff !important;
    border-bottom-color: #fff;
}

.dropdown-menu {
    background-color: #f8f9fa;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 6px;
}

.dropdown-item {
    color: #333;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: #e9ecef;
    color: #0066cc;
}

.bg-primary {
    background: linear-gradient(90deg, #0066cc 0%, #0052a3 100%) !important;
}

.btn-light {
    background-color: #fff !important;
    border: none;
}

.btn-light:hover {
    background-color: #f0f0f0 !important;
}

@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.2rem;
    }

    .nav-link {
        margin: 0.5rem 0;
    }
}
</style>
