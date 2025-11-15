<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ArticleExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route pour changer la langue
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Routes pour les articles
Route::middleware(['auth'])->group(function () {
    Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/export/pdf', [ArticleExportController::class, 'pdf'])->name('articles.export.pdf');
    Route::get('/articles/{article}/edit', [App\Http\Controllers\ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [App\Http\Controllers\ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');
});

// Route pour la page thèse
Route::get('/these', function () {
    return view('these');
})->middleware(['auth'])->name('these');

// Page d'accueil - redirection automatique vers login si non authentifié
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Routes d'authentification (accessibles uniquement aux utilisateurs non authentifiés)
Route::middleware('guest:web')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('google.login');
});

// Callback Google - doit être SANS le middleware guest pour permettre la redirection après Auth
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Routes protégées (accessibles uniquement aux utilisateurs authentifiés)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Route de déconnexion - rediriger vers la page de login (protégée pour les utilisateurs authentifiés)
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('success', 'Déconnexion réussie');
})->name('logout')->middleware('auth');

