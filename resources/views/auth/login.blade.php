@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col md:flex-row animate-fade-in font-sans">

    <style>
        @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
        @keyframes slide-up { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes pulse-soft { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.03); } }
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        .animate-fade-in { animation: fade-in 0.8s ease-out; }
        .animate-slide-up { animation: slide-up 0.7s ease-out; }
        .animate-pulse-soft { animation: pulse-soft 3s infinite; }
        .gradient-animate { background-size: 200% 200%; animation: gradient 15s ease infinite; }
    </style>

    <!-- LEFT COLUMN -->
    <div class="md:w-1/2 w-full bg-white flex flex-col justify-center p-10 sm:p-16 space-y-8 animate-slide-up">

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                <p class="text-red-700 text-sm">{{ session('error') }}</p>
            </div>
        @endif

        <!-- University Logo -->
        <div class="text-center">
            <h1 class="text-5xl font-bold text-blue-900 mb-2 animate-pulse-soft">UIT</h1>
            <p class="text-gray-700 text-lg">Université Ibn Tofail</p>
            <p class="text-gray-700 text-lg" dir="rtl">جامعة ابن طفيل</p>
        </div>

        <!-- Title -->
        <div class="text-center max-w-lg mx-auto">
            <h2 class="text-3xl font-bold text-blue-800 mb-2">
                Cycle Doctoral 2025-2026
            </h2>
            <h3 class="text-2xl font-bold text-blue-700 mb-6" dir="rtl">
                دكتوراه 2025-2026
            </h3>

            <!-- Welcome Message -->
            <div class="mb-6">
                <p class="text-gray-700 text-sm leading-relaxed mb-2">
                    Bienvenue sur la plateforme de suivi de candidature en 
                    <span class="text-blue-600 font-medium">cycle doctoral</span> au titre de l'année universitaire 2025-2026
                </p>
                <p class="text-gray-700 text-sm leading-relaxed" dir="rtl">
                    مرحبا بكم في منصة تتبع الترشيح 
                    <span class="text-blue-600 font-medium">لسلك الدكتوراه</span> 
                    برسم السنة الجامعية 2026-2025
                </p>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 text-left">
                <p class="text-gray-700 text-sm mb-1">
                    La connexion via gmail personnel du <span class="text-blue-600 font-medium">candidat</span> est obligatoire.
                </p>
                <p class="text-gray-700 text-sm" dir="rtl">
                    تسجيل الدخول إلى البريد الإلكتروني الشخصي لـ<span class="text-blue-600 font-medium">المترشح</span> يعد إلزامي.
                </p>
            </div>

            <!-- Google Login -->
            <div class="mb-6">
                <a href="{{ route('google.login') }}"
                   class="group inline-flex items-center justify-center gap-3 px-6 py-3 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 hover:shadow-md transition-all duration-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#4285F4"
                              d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z" />
                    </svg>
                    <span class="text-base font-medium text-gray-700">
                        Connexion avec Google
                    </span>
                </a>
            </div>

            <!-- Support -->
            <div>
                <p class="text-sm text-gray-600">
                    Besoin d'aide ?
                    <a href="mailto:support@uit.ac.ma" class="text-blue-600 hover:underline">
                        support@uit.ac.ma
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="md:w-1/2 hidden md:flex flex-col justify-center items-center text-white bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 gradient-animate relative overflow-hidden">

        <!-- Decorative Circles -->
        <div class="absolute top-10 left-10 w-24 h-24 bg-white opacity-10 rounded-full animate-pulse-soft"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-white opacity-10 rounded-full animate-pulse-soft"></div>

        <!-- Text Section -->
        <div class="z-10 text-center px-6">
            <h2 class="text-3xl font-bold mb-4" dir="rtl">الموسم الجامعي</h2>
            <p class="text-2xl font-light mb-10">2025 - 2026</p>

            <div class="space-y-4">
                <h3 class="text-5xl font-extrabold tracking-tight">Innovate,</h3>
                <h3 class="text-5xl font-extrabold tracking-tight">Inspire,</h3>
                <h3 class="text-5xl font-extrabold tracking-tight">Excel.</h3>
            </div>
        </div>
    </div>

</div>
@endsection
