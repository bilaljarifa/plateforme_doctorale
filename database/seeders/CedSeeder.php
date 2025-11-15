<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ced;
use App\Models\Ped;

class CedSeeder extends Seeder
{
    public function run()
    {
        $ped = Ped::first();
        if (!$ped) {
            return;
        }

        Ced::create([
            'intitule' => 'Centre d\'Etudes Doctorales de Kénitra',
            'ped_id' => $ped->id,
        ]);
    }
}
