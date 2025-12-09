<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                session()->regenerate();
                // Redirection directe au dashboard après connexion
                return redirect()->route('dashboard');
            } else {
                // Split the Google display name into first and last name
                $nameParts = explode(' ', $user->name, 2);
                $prenom = $nameParts[0] ?? ''; // First name
                $nom = $nameParts[1] ?? $nameParts[0]; // Last name, or full name if no space
                
                $newUser = User::create([
                    'name' => $nom,
                    'prenom' => $prenom,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt(Str::random(16))
                ]);

                Auth::login($newUser);
                session()->regenerate();
                // Redirection directe au dashboard après connexion
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Une erreur est survenue lors de la connexion avec Google: ' . $e->getMessage());
        }
    }
}
