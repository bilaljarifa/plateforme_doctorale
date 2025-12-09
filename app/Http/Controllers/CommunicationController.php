<?php

namespace App\Http\Controllers;

use App\Models\Communication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommunicationController extends Controller
{
    public function index()
    {
        return view('communications.index');
    }

    public function create()
    {
        return view('communications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'evenement' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'lien' => 'nullable|url|max:255',
            'doi' => 'nullable|string|max:255',
        ]);

        $communication = new Communication($validated);
        $communication->user_id = auth()->id();
        $communication->save();

        return redirect()->route('communications.index')
            ->with('success', 'Communication créée avec succès');
    }

    public function edit(Communication $communication)
    {
        if ($communication->user_id !== auth()->id()) {
            abort(403);
        }

        return view('communications.edit', compact('communication'));
    }

    public function update(Request $request, Communication $communication)
    {
        if ($communication->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'evenement' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'lien' => 'nullable|url|max:255',
            'doi' => 'nullable|string|max:255',
        ]);

        $communication->update($validated);

        return redirect()->route('communications.index')
            ->with('success', 'Communication modifiée avec succès');
    }

    public function destroy(Communication $communication)
    {
        if ($communication->user_id !== auth()->id()) {
            abort(403);
        }

        if ($communication->fichier) {
            Storage::disk('public')->delete($communication->fichier);
        }

        $communication->delete();

        return redirect()->route('communications.index')
            ->with('success', 'Communication supprimée avec succès');
    }
}
