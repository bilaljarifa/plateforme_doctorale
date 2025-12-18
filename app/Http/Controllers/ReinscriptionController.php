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
        
        $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'these.coDirecteur', 'these.ced', 'these.ped', 'these.etablissement', 'doctorantProfile']);
        $articles = Article::where('user_id', auth()->id())->get();
        $communications = Communication::where('user_id', auth()->id())->get();
        
        // Check Profile Completeness
        $doctorantProfile = $user->doctorantProfile;
        $isProfileComplete = $doctorantProfile && 
            $doctorantProfile->nom_arabe && 
            $doctorantProfile->prenom_arabe && 
            $doctorantProfile->cin && 
            $doctorantProfile->cne && 
            $doctorantProfile->date_naissance && 
            $doctorantProfile->telephone && 
            $doctorantProfile->genre && 
            $doctorantProfile->situation_familiale && 
            $doctorantProfile->situation_administrative;

        // Check These Completeness
        $these = $user->these;
        $isTheseComplete = $these && 
            $these->apogee && 
            $these->centre_etudes_doctorales_id && 
            $these->formations_doctorales_id && 
            $these->sujet_id && 
            $these->annee_inscription && 
            $these->annee_premiere_inscription && 
            $these->etablissement_id && 
            $these->laboratoire_id && 
            $these->directeur_these_id && 
            $these->date_prevue_soutenance;

        return view('reinscription.index', compact('user', 'articles', 'communications', 'isProfileComplete', 'isTheseComplete'));
    }

    public function articleCount()
    {
        $count = Article::where('user_id', auth()->id())->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Enregistrer les données de réinscription directement et afficher le reçu
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'thesis_progress' => 'required|string|min:10|max:5000',
                'directeur_valide' => 'accepted',
                'derniere_publication' => 'nullable|string|max:255',
            ]);

            $annee = date('Y') . '-' . (date('Y') + 1);

            // Créer directement l'enregistrement de réinscription
            $reinscription = Reinscription::create([
                'user_id' => auth()->id(),
                'annee_academique' => $annee,
                'annee_inscription' => null,
                'rapport_path' => null,
                'thesis_progress' => $validated['thesis_progress'],
                'derniere_publication' => $validated['derniere_publication'] ?? null,
                'directeur_valide' => true,
            ]);

            // Charger les données pour affichage
            $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'these.coDirecteur', 'these.ced', 'these.ped', 'these.etablissement', 'doctorantProfile']);

            // Rediriger directement vers la page de reçu (PDF sera généré au téléchargement)
            return view('reinscription.receipt-success', [
                'user' => $user,
                'reinscription' => $reinscription,
                'annee_academique' => $reinscription->annee_academique,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue.')->withInput();
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
            $user = auth()->user()->load(['these.sujet', 'these.directeur', 'these.laboratoire', 'these.ced', 'these.ped', 'these.etablissement', 'doctorantProfile']);
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
