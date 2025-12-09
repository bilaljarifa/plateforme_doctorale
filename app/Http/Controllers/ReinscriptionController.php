<?php

namespace App\Http\Controllers;

use App\Models\Reinscription;
use App\Models\Article;
use App\Models\Communication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReinscriptionController extends Controller
{
    public function index()
    {
        // Nettoyer les données de session de réinscription périmées
        request()->session()->forget('reinscription_temp');
        
        $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'doctorantProfile']);
        return view('reinscription.index', compact('user'));
    }

    public function articleCount()
    {
        $count = Article::where('user_id', auth()->id())->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Enregistrer les données de réinscription et afficher l'écran de révision
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'annee_inscription' => 'required|in:2,3,4,5,6',
                'rapport_file' => 'required|file|mimes:pdf|max:5120',
                'thesis_progress' => 'required|string|min:10|max:5000',
                'directeur_valide' => 'accepted',
                'derniere_publication' => 'nullable|string|max:255',
            ]);

            $annee = date('Y') . '-' . (date('Y') + 1);

            $rapportPath = null;
            if ($request->hasFile('rapport_file')) {
                $file = $request->file('rapport_file');
                $rapportPath = $file->store('reinscriptions', 'public');
            }

            // Store temporarily in session to pass to review screen
            $request->session()->put([
                'reinscription_temp' => [
                    'annee_academique' => $annee,
                    'annee_inscription' => $validated['annee_inscription'],
                    'rapport_path' => $rapportPath,
                    'thesis_progress' => $validated['thesis_progress'],
                    'derniere_publication' => $validated['derniere_publication'] ?? null,
                ]
            ]);

            // Charger les données utilisateur pour l'écran de révision
            $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'doctorantProfile']);
            $articles = Article::where('user_id', auth()->id())->get();
            $communications = Communication::where('user_id', auth()->id())->get();

            return view('reinscription.review', [
                'user' => $user,
                'articles' => $articles,
                'communications' => $communications,
                'thesis_progress' => $validated['thesis_progress'],
                'annee_inscription' => $validated['annee_inscription'],
                'annee_academique' => $annee,
                'rapport_file' => $rapportPath,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue.')->withInput();
        }
    }

    /**
     * Confirmer la réinscription et générer automatiquement le reçu PDF
     * Cette méthode est appelée après que l'utilisateur a vérifié ses informations
     */
    public function confirm(Request $request)
    {
        try {
            // Récupérer les données temporaires stockées en session
            $tempData = $request->session()->get('reinscription_temp');

            // Vérifier si les données de session existent encore
            if (!$tempData) {
                return redirect()->route('reinscription.index')->with('error', 'Session expirée. Veuillez recommencer.');
            }

            // Créer l'enregistrement de réinscription dans la base de données
            $reinscription = Reinscription::create([
                'user_id' => auth()->id(),                                      // ID de l'utilisateur connecté
                'annee_academique' => $tempData['annee_academique'],            // Ex: 2025-2026
                'annee_inscription' => $tempData['annee_inscription'],          // Ex: 2, 3, 4, 5, 6
                'rapport_path' => $tempData['rapport_path'],                    // Chemin du rapport d'activité
                'thesis_progress' => $tempData['thesis_progress'],              // Description de l'avancement
                'derniere_publication' => $tempData['derniere_publication'] ?? null,  // Publication récente (optionnelle)
                'directeur_valide' => true,                                     // Validation automatique du directeur
            ]);

            // Charger toutes les données nécessaires pour le PDF
            // 1. Charger le profil de l'utilisateur avec ses relations (thèse, directeur, laboratoire, profil doctorant)
            $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'doctorantProfile']);
            
            // 2. Récupérer tous les articles de l'utilisateur
            $articles = Article::where('user_id', auth()->id())->get();
            
            // 3. Récupérer toutes les communications de l'utilisateur
            $communications = Communication::where('user_id', auth()->id())->get();

            // Générer le PDF et le sauvegarder automatiquement dans le stockage
            try {
                // Créer le PDF à partir de la vue 'reinscription.receipt' avec toutes les données
                $pdf = Pdf::loadView('reinscription.receipt', [
                    'user' => $user,                                            // Données utilisateur
                    'reinscription' => $reinscription,                          // Données réinscription
                    'articles' => $articles,                                    // Liste des articles
                    'communications' => $communications,                        // Liste des communications
                    'annee_academique' => $reinscription->annee_academique,    // Année académique
                ]);

                // Créer un nom de fichier unique pour le PDF
                // Format: recu_reinscription_{user_id}_{reinscription_id}.pdf
                $filename = 'recu_reinscription_' . auth()->id() . '_' . $reinscription->id . '.pdf';
                
                // Définir le chemin de stockage dans le dossier public
                $pdfPath = 'reinscriptions/receipts/' . $filename;
                
                // Sauvegarder le PDF dans storage/app/public/reinscriptions/receipts/
                Storage::disk('public')->put($pdfPath, $pdf->output());
                
                // Mettre à jour l'enregistrement de réinscription avec le chemin du PDF
                // Cela permet de télécharger le PDF directement sans le regénérer
                $reinscription->update(['receipt_pdf_path' => $pdfPath]);

            } catch (\Exception $pdfError) {
                // Si la génération du PDF échoue, continuer quand même (ne pas bloquer la réinscription)
                // L'utilisateur pourra régénérer le PDF plus tard via le bouton de téléchargement
            }

            // Nettoyer les données temporaires de la session
            $request->session()->forget('reinscription_temp');

            // Rediriger vers la page de succès avec option de téléchargement du PDF
            return view('reinscription.receipt-success', [
                'user' => $user,
                'reinscription' => $reinscription,
                'annee_academique' => $reinscription->annee_academique,
            ]);

        } catch (\Exception $e) {
            // En cas d'erreur générale, retourner à la page précédente avec un message d'erreur
            return back()->with('error', 'Erreur lors de la confirmation: ' . $e->getMessage());
        }
    }

    /**
     * Télécharger le reçu PDF de réinscription
     * Utilise le PDF sauvegardé si disponible, sinon le génère à la volée
     * 
     * @param int $reinscription_id - ID de la réinscription à télécharger
     */
    public function downloadReceipt($reinscription_id)
    {
        try {
            // Récupérer la réinscription de l'utilisateur connecté
            // firstOrFail() génère une exception 404 si non trouvée
            $reinscription = Reinscription::where('user_id', auth()->id())
                ->where('id', $reinscription_id)
                ->firstOrFail();

            // Créer le nom du fichier à télécharger
            $filename = 'recu_reinscription_' . auth()->id() . '_' . $reinscription->id . '.pdf';

            // Vérifier si le PDF a déjà été généré et sauvegardé lors de la confirmation
            if ($reinscription->receipt_pdf_path && Storage::disk('public')->exists($reinscription->receipt_pdf_path)) {
                // Si le PDF existe déjà, le télécharger directement depuis le stockage
                // C'est plus rapide que de régénérer le PDF à chaque fois
                return response()->download(
                    storage_path('app/public/' . $reinscription->receipt_pdf_path),
                    $filename
                );
            }

            // Si le PDF n'a pas été sauvegardé (anciennes réinscriptions ou erreur), le générer à la volée
            
            // Charger toutes les données nécessaires pour générer le PDF
            $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'doctorantProfile']);
            $articles = Article::where('user_id', auth()->id())->get();
            $communications = Communication::where('user_id', auth()->id())->get();

            try {
                // Générer le PDF avec toutes les informations
                $pdf = Pdf::loadView('reinscription.receipt', [
                    'user' => $user,
                    'reinscription' => $reinscription,
                    'articles' => $articles,
                    'communications' => $communications,
                    'annee_academique' => $reinscription->annee_academique,
                ]);

                // Télécharger le PDF généré
                return $pdf->download($filename);
            } catch (\Exception $pdfError) {
                // Si la génération du PDF échoue, afficher la vue HTML à la place
                // Permet au moins de voir les informations même sans PDF
                return view('reinscription.receipt', [
                    'user' => $user,
                    'reinscription' => $reinscription,
                    'articles' => $articles,
                    'communications' => $communications,
                    'annee_academique' => $reinscription->annee_academique,
                ]);
            }
        } catch (\Exception $e) {
            // Si une erreur se produit (réinscription non trouvée, etc.)
            return back()->with('error', 'Reçu non trouvé.');
        }
    }
}
