<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('dashboard', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nom_fr' => 'required|string|max:20',
            'prenom' => 'required|string|max:20',
            'nom_ar' => 'required|string|max:20',
            'prenom_ar' => 'required|string|max:255',
            'cin' => 'required|string|max:20',
            'cne' => 'required|string|max:20',
            'genre' => 'required|in:M,F',
            'date_naissance' => 'required|date',
            'situation_familiale' => 'required|in:Célibataire,Marié(e),Divorcé(e),Veuf(ve)',
            'situation_administrative' => 'required|in:Fonctionnaire,Salarié,Sans emploi',
            'telephone' => 'required|string|max:20',
            'orcid' => 'nullable|string|max:255',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès');
    }
}
