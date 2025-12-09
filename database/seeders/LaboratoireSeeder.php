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
