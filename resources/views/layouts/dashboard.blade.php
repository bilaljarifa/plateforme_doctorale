<!DOCTYPE html>
@php
    $locale = app()->getLocale();
    $languages = ['fr' => 'Français', 'ar' => 'العربية', 'en' => 'English'];
    $user = auth()->user();
    $displayName = trim($user->prenom . ' ' . $user->name) ?: $user->email;
    $initials = mb_strtoupper(mb_substr((string) $user->prenom, 0, 1) . mb_substr($user->name ?: $user->email, 0, 1));
    $portalLinks = [
        ['dashboard', 'dashboard', 'person-circle', 'profile'],
        ['these', 'these', 'mortarboard-fill', 'my_thesis'],
        ['articles.index', 'articles.*', 'file-earmark-text-fill', 'my_articles'],
        ['communications.index', 'communications.*', 'megaphone-fill', 'my_communications'],
        ['reinscription.index', 'reinscription.*', 'people-fill', 'reinscription'],
    ];
@endphp
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#213770">

    <title>@yield('title', config('app.name'))</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Noto+Sans+Arabic:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    @livewireStyles
    @powerGridStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="doctoral-portal">
    <div class="portal-shell">
        <aside class="portal-sidebar">
            <a class="portal-product" href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill" aria-hidden="true"></i>
                <span>PhD-MS</span>
            </a>

            <nav class="portal-navigation" aria-label="{{ __('messages.doctoral_space') }}" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
                <p class="portal-nav-heading">{{ __('messages.doctoral_student') }}</p>
                <ul class="portal-nav-list">
                    @foreach ($portalLinks as [$route, $pattern, $icon, $label])
                        <li>
                            <a href="{{ route($route) }}" @if (request()->routeIs($pattern)) aria-current="page" @endif>
                                <i class="bi bi-{{ $icon }}" aria-hidden="true"></i>
                                <span>{{ __('messages.' . $label) }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <details class="portal-account" x-data @click.outside="$el.removeAttribute('open')" @keydown.escape="$el.removeAttribute('open'); $refs.account.focus()">
                <summary x-ref="account" aria-label="{{ __('messages.profile') }} · {{ $displayName }}">
                    <span class="portal-avatar" aria-hidden="true">{{ $initials }}</span>
                    <span class="portal-account-details">
                        <strong>{{ $displayName }}</strong>
                        <span>{{ $user->email }}</span>
                    </span>
                    <i class="bi bi-chevron-down portal-account-chevron" aria-hidden="true"></i>
                </summary>
                <div class="portal-account-menu">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="portal-logout">
                            <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>
            </details>
        </aside>

        <header class="portal-header">
            <div class="portal-masthead">
                <a class="portal-university" href="{{ route('dashboard') }}">
                    <img class="portal-university-logo" src="{{ asset('images/ibn-tofail-logo.png') }}" alt="" width="1241" height="1026">
                    <span>
                        <span lang="ar" dir="rtl">جامعة ابن طفيل</span>
                        <strong>Université Ibn Tofail</strong>
                    </span>
                </a>
                <img class="portal-ministry" src="{{ asset('images/ministry-logo-new.png') }}" alt="Ministère de l’Enseignement supérieur">
            </div>

            <div class="portal-toolbar">
                <details class="portal-language" x-data @click.outside="$el.removeAttribute('open')" @keydown.escape="$el.removeAttribute('open'); $refs.language.focus()">
                    <summary x-ref="language" aria-label="{{ __('messages.language') }}">
                        <i class="bi bi-globe2" aria-hidden="true"></i>
                        <span lang="{{ $locale }}">{{ $languages[$locale] ?? strtoupper($locale) }}</span>
                        <i class="bi bi-chevron-down" aria-hidden="true"></i>
                    </summary>
                    <div class="portal-language-menu">
                        @foreach ($languages as $language => $label)
                            <a href="{{ route('language.switch', $language) }}" lang="{{ $language }}" @if ($language === $locale) aria-current="true" @endif>{{ $label }}</a>
                        @endforeach
                    </div>
                </details>
            </div>
        </header>

        <main class="app-main">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    @powerGridScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
