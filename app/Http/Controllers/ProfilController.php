<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorantProfile;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->doctorantProfile ?? new DoctorantProfile();

        return view('profile.index', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Mettre à jour les informations de l'utilisateur
        $user->update($request->only(['nom', 'prenom', 'email']));

        // Mettre à jour ou créer le profil
        $user->doctorantProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'cin',
                'cne',
                'nom_arabe',
                'prenom_arabe',
                'genre',
                'date_naissance',
                'situation_familiale',
                'situation_administrative',
                'orcid',
                'telephone'
            ])
        );

        return back()->with('success', 'Profil mis à jour avec succès');
    }
}
