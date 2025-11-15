<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Prof;
use App\Models\Laboratoire;
use App\Models\Ped;
use App\Models\Ced;
use App\Models\Etablissement;
use App\Models\Sujet;
use App\Models\These;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TheseForm extends Component
{
    public $these = [
        'apogee' => '',
        'centre_etudes_doctorales' => '',
        'formations_doctorales' => '',
        'directeur_these' => '',
        'sujet_these' => '',
        'annee_inscription' => '',
        'annee_premiere_inscription' => '',
        'etablissement' => '',
        'laboratoire' => '',
        'co_directeur_type' => 'non',
        'co_directeur_nom_complet' => '',
        'co_directeur_nom' => '',
        'co_directeur_prenom' => '',
        'co_directeur_etablissement' => '',
        'date_prevue_soutenance' => '',
    ];

    public $profs = [];
    public $laboratoires = [];

    public function mount()
    {
        $this->profs = Prof::orderBy('nom_fr')->get();
        $this->laboratoires = Laboratoire::orderBy('intitule')->get();
    }

    public function save()
    {
        // Convert text inputs to related model ids when needed
        DB::beginTransaction();
        try {
            $user = auth()->user();

            // PED (formations_doctorales)
            $pedId = null;
            $pedInput = trim($this->these['formations_doctorales']);
            if ($pedInput !== '') {
                if (is_numeric($pedInput)) {
                    $pedId = (int) $pedInput;
                } else {
                    $ped = Ped::firstOrCreate(['intitule' => $pedInput]);
                    $pedId = $ped->id;
                }
            }

            // CED (centre_etudes_doctorales)
            $cedId = null;
            $cedInput = trim($this->these['centre_etudes_doctorales']);
            if ($cedInput !== '') {
                if (is_numeric($cedInput)) {
                    $cedId = (int) $cedInput;
                } else {
                    $ced = Ced::firstOrCreate(['intitule' => $cedInput], ['ped_id' => $pedId]);
                    $cedId = $ced->id;
                }
            }

            // Etablissement
            $etabId = null;
            $etabInput = trim($this->these['etablissement']);
            if ($etabInput !== '') {
                if (is_numeric($etabInput)) {
                    $etabId = (int) $etabInput;
                } else {
                    $etab = Etablissement::firstOrCreate([
                        'intitulefr' => $etabInput,
                    ], [
                        'intituleAR' => $etabInput,
                        'ced_id' => $cedId,
                    ]);
                    $etabId = $etab->id;
                }
            }

            // Laboratoire
            $labId = null;
            $labInput = trim($this->these['laboratoire']);
            if ($labInput !== '') {
                if (is_numeric($labInput)) {
                    $labId = (int) $labInput;
                } else {
                    $lab = Laboratoire::firstOrCreate([
                        'intitule' => $labInput,
                    ], [
                        'etablissement_id' => $etabId,
                    ]);
                    $labId = $lab->id;
                }
            }

            // Directeur (prof)
            $directeurId = null;
            $dirInput = trim($this->these['directeur_these']);
            if ($dirInput !== '') {
                if (is_numeric($dirInput)) {
                    $directeurId = (int) $dirInput;
                } else {
                    // store full name into nom_fr if no split available
                    $prof = Prof::firstOrCreate([
                        'nom_fr' => $dirInput,
                    ], [
                        'prenom' => '',
                        'email' => Str::slug($dirInput) . '@example.com',
                        'laboratoire_id' => $labId,
                    ]);
                    $directeurId = $prof->id;
                }
            }

            // Sujet (create if text)
            $sujetId = null;
            $sujetInput = trim($this->these['sujet_these']);
            if ($sujetInput !== '') {
                if (is_numeric($sujetInput)) {
                    $sujetId = (int) $sujetInput;
                } else {
                    $sujet = Sujet::firstOrCreate([
                        'intitule_sujet' => $sujetInput,
                    ], [
                        'prof_id' => $directeurId,
                    ]);
                    $sujetId = $sujet->id;
                }
            }

            These::create([
                'user_id' => $user ? $user->id : null,
                'apogee' => $this->these['apogee'],
                'centre_etudes_doctorales_id' => $cedId,
                'formations_doctorales_id' => $pedId,
                'directeur_these_id' => $directeurId,
                'sujet_id' => $sujetId,
                'annee_inscription' => $this->these['annee_inscription'],
                'annee_premiere_inscription' => $this->these['annee_premiere_inscription'],
                'etablissement_id' => $etabId,
                'laboratoire_id' => $labId,
                'co_directeur_type' => $this->these['co_directeur_type'],
                'co_directeur_nom_complet' => $this->these['co_directeur_nom_complet'],
                'co_directeur_nom' => $this->these['co_directeur_nom'],
                'co_directeur_prenom' => $this->these['co_directeur_prenom'],
                'co_directeur_etablissement' => $this->these['co_directeur_etablissement'],
                'date_prevue_soutenance' => $this->these['date_prevue_soutenance'],
            ]);

            DB::commit();
            session()->flash('success', 'Thèse enregistrée avec succès !');
            $this->dispatchBrowserEvent('theseSaved', ['message' => 'Thèse enregistrée avec succès !']);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de la sauvegarde : ' . $e->getMessage());
            $this->dispatchBrowserEvent('theseError', ['message' => 'Erreur lors de la sauvegarde : ' . $e->getMessage()]);
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.these-form');
    }
}
