<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboratoire;
use App\Models\Etablissement;

class LaboratoireSeeder extends Seeder
{
    public function run()
    {
        $etab = Etablissement::first();
        if (!$etab) {
            return;
        }

        Laboratoire::create([
            'intitule' => 'Laboratoire de Mathématiques',
            'etablissement_id' => $etab->id,
        ]);

        Laboratoire::create([
            'intitule' => 'Laboratoire d\'Informatique',
            'etablissement_id' => $etab->id,
        ]);
    }
}
