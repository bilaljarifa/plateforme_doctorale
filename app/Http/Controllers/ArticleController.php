<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:article,conference,chapter,book',
            'titre' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'doi' => 'nullable|string|max:255',
            'lien' => 'nullable|url|max:255',
        ]);

        $article = new Article($validated);
        $article->user_id = auth()->id();
        $article->save();

        return redirect()->route('articles.index')
            ->with('success', 'Article créé avec succès');
    }

    public function edit(Article $article)
    {
        // Vérifier que l'article appartient à l'utilisateur connecté
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        // Vérifier que l'article appartient à l'utilisateur connecté
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => 'required|in:article,conference,chapter,book',
            'titre' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'doi' => 'nullable|string|max:255',
            'lien' => 'nullable|url|max:255',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Article modifié avec succès');
    }

    public function importOrcid(Request $request)
    {
        $validated = $request->validate([
            'orcid_id' => 'required|string|regex:/^\d{4}-\d{4}-\d{4}-\d{4}$/',
        ]);

        // TODO: Implement ORCID API integration
        // For now, just redirect back with a message
        return redirect()->route('articles.index')
            ->with('info', 'La fonctionnalité d\'importation ORCID sera bientôt disponible.');
    }

    public function destroy(Article $article)
    {
        // Vérifier que l'article appartient à l'utilisateur connecté
        if ($article->user_id !== auth()->id()) {
            abort(403);
        }

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article supprimé avec succès');
    }
}
