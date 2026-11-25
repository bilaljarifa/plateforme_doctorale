@extends('layouts.auth')

@section('title', 'Connexion · Plateforme Doctorale')

@section('content')
<div class="doctoral-login">
    <main class="login-panel" aria-labelledby="login-title">
        <div class="login-content">
            <img class="login-brand" src="{{ asset('images/ibn-tofail-logo-horizontal.png') }}"
                alt="جامعة ابن طفيل — Ibn Tofaïl University" width="686" height="278">

            <div class="login-welcome">
                <h1 id="login-title">Bienvenue sur la plateforme de suivi de candidature en <strong>cycle doctoral</strong> au titre de l’année universitaire <bdi>2025–2026</bdi>.</h1>
                <p lang="ar" dir="rtl">مرحبًا بكم في منصة تتبع الترشيح <strong>لسلك الدكتوراه</strong> برسم السنة الجامعية <bdi dir="ltr">2025–2026</bdi>.</p>
            </div>

            <div class="login-guidance">
                <p>La connexion via le compte Gmail personnel du <strong>candidat</strong> est obligatoire.</p>
                <p lang="ar" dir="rtl">تسجيل الدخول بالبريد الإلكتروني الشخصي <strong>للمترشح</strong> إلزامي.</p>
            </div>

            @if(session('error'))
                <div class="login-alert" role="alert">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="login-alert login-alert-success" role="status">{{ session('success') }}</div>
            @endif

            <a class="login-google" href="{{ route('google.login') }}">
                <svg aria-hidden="true" width="22" height="22" viewBox="0 0 48 48">
                    <path fill="#4285F4" d="M43.61 24.46c0-1.36-.12-2.67-.35-3.92H24v7.42h11a9.4 9.4 0 0 1-4.08 6.17v5.14h6.61c3.87-3.57 6.08-8.83 6.08-14.81Z"/>
                    <path fill="#34A853" d="M24 44c5.51 0 10.13-1.83 13.5-4.73l-6.61-5.14c-1.83 1.23-4.17 1.96-6.89 1.96-5.33 0-9.85-3.6-11.47-8.44H5.71v5.3A20 20 0 0 0 24 44Z"/>
                    <path fill="#FBBC05" d="M12.53 27.65a12.04 12.04 0 0 1 0-7.3v-5.3H5.71a20 20 0 0 0 0 17.9l6.82-5.3Z"/>
                    <path fill="#EA4335" d="M24 11.91c3 0 5.69 1.03 7.81 3.05l5.85-5.85C34.13 5.82 29.51 4 24 4A20 20 0 0 0 5.71 15.05l6.82 5.3C14.15 15.51 18.67 11.91 24 11.91Z"/>
                </svg>
                <span>Connexion avec Google</span>
            </a>

            <footer class="login-footer">
                <span>Besoin d’aide&nbsp;?</span>
                <a href="mailto:support@uit.ac.ma">support@uit.ac.ma</a>
                <span lang="ar" dir="rtl">للمساعدة راسلونا عبر البريد الإلكتروني</span>
            </footer>
        </div>
    </main>

    <aside class="login-visual" aria-label="Année universitaire">
        <img class="login-emblem" src="{{ asset('images/ibn-tofail-emblem.png') }}"
            alt="" width="600" height="1371">
        <div class="login-academic-year">
            <span lang="ar" dir="rtl">الموسم الجامعي</span>
            <span>2025 / 2026</span>
        </div>
        <p class="login-visual-title" lang="en">Innovate,<br>Inspire,<br>Excel.</p>
    </aside>
</div>
@endsection
