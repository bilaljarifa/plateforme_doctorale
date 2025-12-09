<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        // Vérifier si la langue est supportée
        if (!in_array($locale, ['en', 'fr', 'ar'])) {
            abort(400);
        }

        // Stocker la langue choisie dans la session
        session(['locale' => $locale]);

        // Définir la langue pour l'application
        app()->setLocale($locale);

        // Rediriger vers la page précédente
        return redirect()->back();
    }
}
