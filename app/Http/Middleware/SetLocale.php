<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer la langue de la session ou utiliser le français par défaut
        $locale = session('locale', 'fr');

        // Définir la langue pour l'application
        app()->setLocale($locale);

        return $next($request);
    }
}
