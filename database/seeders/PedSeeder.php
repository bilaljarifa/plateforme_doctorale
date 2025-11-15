<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ped;

class PedSeeder extends Seeder
{
    public function run()
    {
        Ped::create(['intitule' => 'Doctorat en Sciences']);
        Ped::create(['intitule' => 'Doctorat en Technologie']);
    }
}
