<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        
        // Skip check if already on profile page or logout
        if ($request->is('profil') || $request->is('logout')) {
            return $next($request);
        }

        // Check if user has completed their profile
        if ($user) {
            $profileIncomplete = is_null($user->cin) || 
                               is_null($user->cne) || 
                               is_null($user->genre) ||
                               is_null($user->date_naissance) ||
                               is_null($user->situation_familiale) ||
                               is_null($user->situation_administrative) ||
                               is_null($user->telephone) ||
                               is_null($user->orcid);

            if ($profileIncomplete) {
                return redirect()->route('profil')->with('warning', 
                    'Veuillez compléter votre profil avant de continuer. / الرجاء إكمال ملفك الشخصي قبل المتابعة.');
            }
        }

        return $next($request);
    }
}
