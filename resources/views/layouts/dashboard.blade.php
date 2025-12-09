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
                --primary-blue: #050372;
                --secondary-blue: #040261;
                --light-blue: #e8eaff;
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
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #eef6ff 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Form controls: clear borders, white background, consistent padding */
        input[type="text"], input[type="email"], input[type="file"], input[type="number"], select, textarea {
            background-color: #ffffff;
            border: 1px solid var(--border-grey);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            color: var(--text-dark);
            font-family: inherit;
        }

        input[readonly], input[disabled], textarea[readonly], textarea[disabled] {
            background-color: #f3f4f6; /* light gray for locked fields */
            cursor: not-allowed;
            opacity: 0.95;
        }

        /* ===== HEADER (Dark Professional Navbar) ===== */
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: #1e5fa8;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.2rem;
        }

        .header-center-fr {
            font-size: 0.95rem;
            font-weight: 600;
            color: white;
            letter-spacing: 0.3px;
        }

        .header-center-ar {
            font-size: 0.9rem;
            font-weight: 600;
            color: white;
            letter-spacing: 0.2px;
        }

        .header-logo-section {
            display: flex;
            align-items: center;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-weight: 700;
        }

        .header-logo i {
            font-size: 1.5rem;
            color: white;
        }

        .header-logo-text {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
            letter-spacing: 0.5px;
        }

        .ml-auto {
            margin-left: auto;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* User Info Section */
        .user-info-section {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            margin-right: 1rem;
        }

        .user-details {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }

        .user-name {
            color: white;
            font-size: 14px;
            font-weight: 600;
        }

        .user-email {
            color: rgba(255, 255, 255, 0.8);
            font-size: 11px;
        }



        /* User Display */
        .user-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 14px;
            font-weight: 500;
            padding: 0.6rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            margin-right: 1rem;
        }

        .user-display i {
            font-size: 18px;
        }

        .language-selector {
            position: relative;
        }

        .language-btn {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: white;
            padding: 0.65rem 1rem;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .language-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .language-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
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
            padding: 0.8rem 1rem;
            color: white;
            text-decoration: none;
            font-size: 13px;
            transition: background 0.2s;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .language-menu a:last-child {
            border-bottom: none;
        }

        .language-menu a:hover {
            background-color: rgba(255, 255, 255, 0.18);
        }

        /* ===== SIDEBAR (Modern Left Navigation) ===== */
        .app-sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #f8fafb;
            border-right: 1px solid #e5e7eb;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        /* Doctoral Cycle Section - Top of Sidebar */
        .sidebar-university-section {
            padding: 1.5rem 1rem;
            background: white;
            border-bottom: 2px solid #e5e7eb;
            text-align: center;
        }

        .sidebar-university-branding .university-name-fr {
            font-size: 1rem;
            font-weight: 700;
            color: #050372;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .sidebar-university-branding .university-name-ar {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6b7280;
        }

        /* PhD-MS Logo Section - Simple Minimal (removed) */
        .sidebar-logo-section {
            display: none;
        }

        .phd-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.25rem;
        }

        .phd-logo i {
            /* make the sidebar icon smaller to reduce visual weight */
            font-size: 1.0rem;
            color: var(--primary-blue);
        }

        .phd-text {
            /* slightly smaller label for compact sidebar */
            font-size: 0.65rem;
            font-weight: 600;
            color: #9ca3af;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Sidebar Header Simple (No Dropdown) */
        .sidebar-header-simple {
            padding: 0.75rem 0.75rem;
            border-bottom: 1px solid #e0e6ed;
            background: white;
            text-align: center;
        }

        .sidebar-header-text {
            font-size: 10px;
            font-weight: 600;
            color: #9ca3af;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* ===== SIDEBAR MENU ===== */

        .sidebar-menu {
            list-style: none;
            padding: 1rem 1rem;
            margin: 0;
            flex: 1;
            overflow-y: auto;
            background: transparent;
        }

        .sidebar-menu li { margin: 0; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.75rem 1rem;
            color: #374151;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border-radius: 8px;
            margin: 0.25rem 0;
            background: white;
            border: 1px solid transparent;
        }

        .sidebar-menu a:hover {
            background: #e8eaff;
            color: #050372;
            border-color: #d0d3ff;
            transform: translateX(3px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .sidebar-menu a.active {
            background: #050372;
            color: white;
            font-weight: 600;
            border-color: #050372;
            box-shadow: 0 2px 6px rgba(5,3,114,0.3);
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
            color: inherit;
        }

        /* ===== SIDEBAR BOTTOM BAR (Logout Button) ===== */
        .sidebar-bottom-bar {
            padding: 1rem;
            border-top: 2px solid #e5e7eb;
            background: white;
            margin-top: auto;
        }

        /* User Info at Bottom */
        .sidebar-user-info {
            padding: 1rem 1.25rem;
            border-top: 1px solid #e6eef6;
            background: #f8f9fa;
            margin-top: auto;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.25rem;
        }
        /* ===== SIDEBAR BOTTOM BAR (Logout) ===== */
        .sidebar-bottom-bar {
            padding: 1rem;
            border-top: 2px solid #e5e7eb;
            margin-top: auto;
            background: #f8fafb;
        }

        /* User Email Display */
        .user-email-display {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: white;
            border-radius: 6px;
            margin-bottom: 0.75rem;
            border: 1px solid #e5e7eb;
        }

        .user-email-display i {
            font-size: 1.1rem;
            color: #050372;
        }

        .user-email-display span {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Compact Logout Button */
        .sidebar-logout-btn-compact {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.5rem 0.75rem;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 6px;
            color: #dc2626;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.8rem;
        }

        .sidebar-logout-btn-compact:hover {
            background: #fecaca;
            border-color: #fca5a5;
            color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(220, 38, 38, 0.15);
        }

        .sidebar-logout-btn-compact i {
            font-size: 0.95rem;
        }

        /* Old logout button (keep for backward compatibility) */
        .sidebar-logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.7rem 1rem;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #dc2626;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }

        .sidebar-logout-btn:hover {
            background: #fecaca;
            border-color: #fca5a5;
            color: #b91c1c;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.2);
        }

        .sidebar-logout-btn i {
            font-size: 15px;
        }

        /* ===== MAIN CONTENT ===== */
        .app-main {
            margin-left: 260px;
            padding: 0.5rem 1rem;
            min-height: calc(100vh - 70px - 60px);
            background: #f8f9fa;
            transition: margin-left .18s ease;
        }

        .page-header {
            margin-bottom: 1.25rem; /* Reduced from 2.5rem */
        }

        .page-header h1 {
            font-size: 26px; /* Slightly smaller */
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.35rem; /* Reduced from 0.5rem */
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
            max-width: 100%; /* Ensure full width usage */
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            padding: 1rem 1.25rem; /* Reduced from 1.5rem */
            border-bottom: 1px solid var(--border-grey);
        }

        .card-body {
            padding: 1.25rem; /* Reduced from 1.5rem */
        }

        /* ===== FORMS ===== */
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 14px;
            margin-bottom: 0.35rem; /* Reduced from 0.5rem */
        }

        .form-control, .form-select {
            border: 1px solid var(--border-grey);
            border-radius: 6px;
            padding: 0.5rem 0.75rem; /* Reduced for tighter spacing */
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--light-blue);
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }

        /* Tighter row/column spacing for forms */
        .row {
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }

        .row > * {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 0.85rem !important; /* Reduced from default 1rem */
        }

        /* ===== BUTTONS (Unified design for the whole app) ===== */
        .btn, button, input[type="submit"], input[type="button"], .btn-primary, .btn-secondary, .btn-add-article, .btn-add-communication {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.18s ease;
            cursor: pointer;
            border: none;
            text-decoration: none;
        }

        /* Primary button (default action) */
        .btn-primary {
            background-color: #050372;
            color: white;
            box-shadow: 0 2px 8px rgba(5, 3, 114, 0.2);
        }

        .btn-primary:hover {
            background-color: #040261;
            box-shadow: 0 6px 18px rgba(5, 3, 114, 0.3);
            transform: translateY(-1px);
        }

        /* Secondary button (neutral action) */
        .btn-secondary {
            background-color: white;
            border: 1px solid var(--border-grey);
            color: var(--text-dark);
            box-shadow: none;
        }

        .btn-secondary:hover {
            background-color: #f8f9fa;
        }

        /* Small helper: make sure specialized add-* buttons follow same sizing when present */
        .btn-add-article, .btn-add-communication {
            padding: 0.45rem 0.9rem;
            font-size: 0.92rem;
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
                padding: 0.75rem;
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
                padding: 0.5rem;
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

        /* PowerGrid Utility Buttons (Export, Filters, Column Toggle, etc.) - Change from gray to blue */
        .btn-secondary.btn-sm {
            background: #050372 !important;
            color: white !important;
            border: none !important;
            box-shadow: 0 2px 8px rgba(5, 3, 114, 0.25);
            padding: 0.35rem 0.6rem !important;
            border-radius: 6px !important;
            font-size: 0.85rem !important;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .btn-secondary.btn-sm:hover {
            box-shadow: 0 4px 12px rgba(5, 3, 114, 0.35) !important;
            transform: translateY(-1px);
            background: #040261 !important;
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
    <!-- Include Navbar Component -->
    @include('components.navbar')

    <!-- SIDEBAR -->
    <aside class="app-sidebar">
        <!-- Doctoral Cycle Info (Top) -->
        <div class="sidebar-university-section">
            <div class="sidebar-university-branding">
                <div class="university-name-fr">{{ __('messages.doctoral_cycle') }}</div>
            </div>
        </div>



        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                    <i class="bi bi-person-circle"></i>
                    <span>{{ __('messages.profile') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('these') }}" class="@if(request()->routeIs('these')) active @endif">
                    <i class="bi bi-briefcase"></i>
                    <span>{{ __('messages.my_thesis') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('articles.index') }}" class="@if(request()->routeIs('articles.index')) active @endif">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>{{ __('messages.my_articles') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('communications.index') }}" class="@if(request()->routeIs('communications.index')) active @endif">
                    <i class="bi bi-megaphone"></i>
                    <span>{{ __('messages.my_communications') }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reinscription.index') }}" class="@if(request()->routeIs('reinscription.*')) active @endif">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>{{ __('messages.reinscription') }}</span>
                </a>
            </li>
        </ul>

        <!-- Bottom Bar: User Email & Logout -->
        <div class="sidebar-bottom-bar">
            <div class="user-email-display">
                <i class="bi bi-person-circle"></i>
                <span>{{ auth()->user()->email }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="w-100">
                @csrf
                <button type="submit" class="sidebar-logout-btn-compact">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>{{ __('messages.logout') }}</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="app-main">
        @yield('content')
    </main>

    <!-- FOOTER removed per request -->

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- PowerGrid Scripts -->
    @powerGridScripts

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
