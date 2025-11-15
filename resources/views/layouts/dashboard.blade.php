<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PhD-MS') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Alpine -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root {
            --primary-blue: #0f6deed;
            --secondary-blue: #1e88e5;
            --light-blue: #e3f2fd;
            --light-grey: #f5f7fa;
            --border-grey: #e0e6ed;
            --text-dark: #1a202c;
            --text-light: #718096;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* ===== HEADER (Modern Top Bar) ===== */
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(248,249,251,0.98) 100%);
            box-shadow: var(--shadow-md);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-grey);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--text-dark);
            transition: transform 0.3s ease;
        }

        .header-logo:hover {
            transform: translateY(-2px);
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, rgba(0, 82, 204, 0.1) 0%, rgba(15, 109, 237, 0.08) 100%);
            border: 2px solid #0052cc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 14px;
            color: #0052cc;
            box-shadow: 0 2px 8px rgba(0, 82, 204, 0.15), inset 0 1px 2px rgba(0, 82, 204, 0.1);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .logo-icon:hover {
            transform: scale(1.08);
            background: linear-gradient(135deg, rgba(0, 82, 204, 0.15) 0%, rgba(15, 109, 237, 0.12) 100%);
            box-shadow: 0 4px 12px rgba(0, 82, 204, 0.25), inset 0 1px 2px rgba(0, 82, 204, 0.1);
        }

        .logo-text h1 {
            color: #000;
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        .logo-text p {
            font-size: 12px;
            color: var(--text-light);
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .language-selector {
            position: relative;
        }

        .language-btn {
            background: rgba(90, 142, 214, 0.08);
            border: 1px solid rgba(15, 109, 237, 0.2);
            color: var(--primary-blue);
            padding: 0.6rem 0.9rem;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .language-btn:hover {
            background: rgba(15, 109, 237, 0.15);
            border-color: rgba(15, 109, 237, 0.35);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(15, 109, 237, 0.15);
        }

        .language-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid var(--border-grey);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            min-width: 160px;
            margin-top: 0.8rem;
            display: none;
            z-index: 1001;
            overflow: hidden;
        }

        .language-menu.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .language-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 13px;
            transition: background 0.2s;
            border-bottom: 1px solid var(--border-grey);
        }

        .language-menu a:last-child {
            border-bottom: none;
        }

        .language-menu a:hover {
            background-color: var(--light-grey);
        }

        /* ===== SIDEBAR (Modern Left Navigation) ===== */
        .app-sidebar {
            position: fixed;
            left: 0;
            top: 70px;
            width: 250px;
            height: calc(100vh - 70px - 60px);
            background: linear-gradient(180deg, rgba(255,255,255,0.98) 0%, rgba(248,249,251,0.98) 100%);
            border-right: 1px solid var(--border-grey);
            overflow-y: auto;
            z-index: 999;
            padding-bottom: 120px;
            backdrop-filter: blur(10px);
        }

        .sidebar-logo {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--border-grey);
            text-align: center;
            background: linear-gradient(135deg, rgba(15, 109, 237, 0.05) 0%, rgba(30, 136, 229, 0.05) 100%);
        }

        .sidebar-logo-text h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary-blue);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            letter-spacing: 0.5px;
        }

        .sidebar-logo-text h2 i {
            font-size: 22px;
        }

        /* ===== SIDEBAR MENU ===== */
        .sidebar-menu {
            list-style: none;
            padding: 0.5rem 0;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            margin: 0.2rem 0;
        }

        .sidebar-menu a:hover {
            background: linear-gradient(90deg, rgba(15, 109, 237, 0.08) 0%, transparent 100%);
            border-left-color: var(--secondary-blue);
            color: var(--secondary-blue);
            padding-left: 1.7rem;
        }

        .sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(15, 109, 237, 0.12) 0%, transparent 100%);
            border-left-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        /* ===== SIDEBAR BOTTOM (Logout Button) ===== */
        .sidebar-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 1px solid var(--border-grey);
            background: white;
        }

        /* ===== SIDEBAR EMAIL ===== */
        .sidebar-email {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: #f5f5f5;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            color: #666;
            font-size: 12px;
            overflow: hidden;
            flex: 1;
        }

        /* ===== SIDEBAR BOTTOM BAR (Email + Logout) ===== */
        .sidebar-bottom-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem;
            border-top: 1px solid var(--border-grey);
            background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(245,247,250,0.6) 100%);
            backdrop-filter: blur(5px);
        }

        .sidebar-bottom-bar .sidebar-email {
            padding: 0.5rem 0.75rem;
            margin: 0;
            font-size: 11px;
            border-radius: 4px;
            flex: 1;
            min-width: 0;
        }

        .sidebar-bottom-bar .sidebar-email i {
            font-size: 12px;
        }

        .sidebar-bottom-bar .sidebar-logout-btn {
            width: auto;
            padding: 0.5rem 0.6rem;
            flex-shrink: 0;
            font-size: 12px;
            gap: 0.3rem;
        }

        .sidebar-logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, rgba(255, 107, 107, 0.12) 0%, rgba(255, 76, 76, 0.08) 100%);
            border: 1px solid rgba(255, 107, 107, 0.25);
            border-radius: 7px;
            color: #ff6b6b;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .sidebar-logout-btn:hover {
            background: linear-gradient(135deg, rgba(255, 107, 107, 0.2) 0%, rgba(255, 76, 76, 0.15) 100%);
            border-color: rgba(255, 107, 107, 0.4);
            color: #ff5252;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(255, 107, 107, 0.15);
        }

        .sidebar-bottom-bar .sidebar-logout-btn {
            width: auto;
            padding: 0.5rem 0.6rem;
            flex-shrink: 0;
            font-size: 12px;
            gap: 0.3rem;
        }

        .sidebar-logout-btn i {
            font-size: 16px;
        }

        /* ===== MAIN CONTENT ===== */
        .app-main {
            margin-left: 250px;
            margin-top: 70px;
            padding: 2rem;
            min-height: calc(100vh - 70px - 60px);
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
        }

        .page-header {
            margin-bottom: 2.5rem;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .page-header p {
            font-size: 14px;
            color: var(--text-light);
            margin: 0;
        }

        /* ===== CARDS ===== */
        .card {
            background: white;
            border: 1px solid var(--border-grey);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-grey);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* ===== FORMS ===== */
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid var(--border-grey);
            border-radius: 6px;
            padding: 0.625rem 0.875rem;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--light-blue);
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background-color: var(--light-blue);
            border: none;
            border-radius: 6px;
            padding: 0.625rem 1.5rem;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-blue);
            box-shadow: 0 4px 12px rgba(0, 52, 122, 0.2);
        }

        .btn-secondary {
            background-color: var(--light-grey);
            border: 1px solid var(--border-grey);
            color: var(--text-dark);
            border-radius: 6px;
            padding: 0.625rem 1.5rem;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
        }

        /* ===== FOOTER (Modern Professional) ===== */
        .app-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(245,247,250,0.98) 100%);
            border-top: 1px solid var(--border-grey);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            font-size: 12px;
            color: var(--text-light);
            box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.05);
        }

        .footer-left {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .footer-link {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .footer-link:hover {
            color: var(--secondary-blue);
            padding-bottom: 2px;
            border-bottom: 2px solid var(--secondary-blue);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .app-sidebar {
                width: 200px;
            }

            .app-main {
                margin-left: 200px;
                padding: 1.5rem;
            }

            .page-header h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .app-sidebar {
                transform: translateX(-100%);
                width: 200px;
                transition: transform 0.3s ease;
            }

            .app-sidebar.show {
                transform: translateX(0);
            }

            .app-main {
                margin-left: 0;
                padding: 1rem;
            }

            .app-header {
                padding: 0 1rem;
            }

            .header-logo {
                gap: 0.5rem;
            }

            .logo-text h1 {
                font-size: 16px;
            }

            .logo-text p {
                display: none;
            }
        }

        /* PowerGrid Styling */
        .power-grid-table {
            background-color: white !important;
            border: 1px solid var(--border-grey) !important;
            border-radius: 8px !important;
        }

        .power-grid-table thead {
            background-color: var(--light-grey) !important;
        }

        .power-grid-table thead th {
            color: var(--text-dark) !important;
            font-weight: 600 !important;
            border-bottom: 1px solid var(--border-grey) !important;
        }

        .power-grid-table tbody tr:hover {
            background-color: #f5f5f5 !important;
        }

        .power-grid-table td {
            border-bottom: 1px solid var(--border-grey) !important;
            color: var(--text-dark) !important;
        }

        /* Force pagination "per page" select text to black so numbers are visible */
        select[wire\:model\.lazy="setUp.footer.perPage"],
        select[wire\:model\.lazy="setUp.footer.perPage"] option {
            color: #000 !important;
        }
    </style>

    @powerGridStyles
</head>
<body>
    <!-- HEADER -->
    <header class="app-header">
        <div class="header-left">
            <a href="{{ route('dashboard') }}" class="header-logo">
                <div class="logo-icon">UIT</div>
                <div class="logo-text">
                    <h1>Université Ibn Tofail</h1>
                    <p>جامعة ابن طفيل</p>
                </div>
            </a>
        </div>

        <div class="header-right">
            <div class="language-selector">
                <button class="language-btn" onclick="toggleLanguageMenu()">
                    <i class="bi bi-globe"></i> {{ strtoupper(app()->getLocale()) }}
                </button>
                <div class="language-menu" id="languageMenu">
                    <a href="{{ route('language.switch', ['locale' => 'fr']) }}">🇫🇷 Français</a>
                    <a href="{{ route('language.switch', ['locale' => 'en']) }}">🇬🇧 English</a>
                    <a href="{{ route('language.switch', ['locale' => 'ar']) }}">🇲🇦 العربية</a>
                </div>
            </div>
        </div>
    </header>

    <!-- SIDEBAR -->
    <aside class="app-sidebar">
        <!-- Sidebar Logo Text -->
        <div class="sidebar-logo">
            <div class="sidebar-logo-text">
                <h2><i class="bi bi-mortarboard"></i> PHD-MS</h2>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                    <i class="bi bi-person-circle"></i>
                    <span>Profil</span>
                </a>
            </li>
            <li>
                <a href="{{ route('these') }}" class="@if(request()->routeIs('these')) active @endif">
                    <i class="bi bi-book"></i>
                    <span>Thèse</span>
                </a>
            </li>
            <li>
                <a href="{{ route('articles.index') }}" class="@if(request()->routeIs('articles.index')) active @endif">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Articles</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-chat-dots"></i>
                    <span>Communications</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-arrow-clockwise"></i>
                    <span>Réinscription</span>
                </a>
            </li>
        </ul>

        <!-- Bottom Bar: Gmail Email + Logout Button -->
        <div class="sidebar-bottom-bar">
            <div class="sidebar-email">
                <i class="bi bi-envelope"></i>
                <span class="email-text">{{ auth()->user()->email }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="flex: 0 0 auto;">
                @csrf
                <button type="submit" class="sidebar-logout-btn" title="Déconnexion">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="app-main">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="app-footer">
        <div class="footer-left">
            <span>&copy; 2025-2026 Université Ibn Tofail - PhD Management System</span>
        </div>
        <div class="footer-right">
            <a href="#" class="footer-link">Aide</a>
            <a href="#" class="footer-link">Conditions</a>
            <a href="#" class="footer-link">Confidentialité</a>
        </div>
    </footer>

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- PowerGrid Scripts -->
    @powerGridScripts

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleLanguageMenu() {
            const menu = document.getElementById('languageMenu');
            menu.classList.toggle('show');
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('languageMenu');
            const btn = event.target.closest('.language-selector');
            if (!btn && menu.classList.contains('show')) {
                menu.classList.remove('show');
            }
        });
    </script>
</body>
</html>
