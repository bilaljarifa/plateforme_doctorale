<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboratoire;
use App\Models\Etablissement;

class LaboratoireSeeder extends Seeder
{
    public function run()
    {
        $etabs = Etablissement::all();
        if ($etabs->isEmpty()) {
            return;
        }

        $laboratories = [
            'Laboratoire de Mathématiques et Applications',
            'Laboratoire d\'Informatique et Systèmes',
            'Laboratoire de Physique de la Matière Condensée',
            'Laboratoire de Chimie Organique et Analytique',
            'Laboratoire de Biologie et Santé',
            'Laboratoire de Génie Électrique et Énergies Renouvelables',
            'Laboratoire d\'Économie et Gestion',
            'Laboratoire de Sciences de l\'Éducation',
            'Laboratoire de Recherche en Intelligence Artificielle',
            'Laboratoire de Biotechnologie et Valorisation des Ressources Naturelles',
            'Laboratoire d\'Analyse et de Modélisation des Systèmes',
            'Laboratoire de Linguistique et Didactique des Langues',
            'Laboratoire de Droit Public et Sciences Politiques',
            'Laboratoire de Génie Civil et Environnement',
            'Laboratoire de Psychologie et Sciences de la Cognition',
            'Laboratoire de Sociologie et Anthropologie',
            'Laboratoire de Chimie Physique et des Matériaux',
            'Laboratoire de Géologie et Ressources Minérales',
            'Laboratoire d\'Histoire et Civilisations',
            'Laboratoire de Robotique et Automatique',
        ];

        foreach ($laboratories as $index => $labName) {
            // Distribute across available establishments
            $etabIndex = $index % $etabs->count();
            Laboratoire::create([
                'intitule' => $labName,
                'etablissement_id' => $etabs[$etabIndex]->id,
            ]);
        }
    }
}
