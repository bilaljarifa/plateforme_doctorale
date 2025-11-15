<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prof;
use App\Models\Laboratoire;

class ProfSeeder extends Seeder
{
    public function run()
    {
        $lab = Laboratoire::first();
        if (!$lab) {
            return;
        }

        Prof::create([
            'nom_fr' => 'El Amrani',
            'prenom' => 'Mohamed',
            'email' => 'm.elamrani@example.com',
            'laboratoire_id' => $lab->id,
        ]);

        Prof::create([
            'nom_fr' => 'Benjelloun',
            'prenom' => 'Amina',
            'email' => 'a.benjelloun@example.com',
            'laboratoire_id' => $lab->id,
        ]);
    }
}
