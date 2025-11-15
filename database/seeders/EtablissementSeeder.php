<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etablissement;

class EtablissementSeeder extends Seeder
{
    public function run()
    {
        Etablissement::create([
            'intitulefr' => 'Université Ibn Tofail',
            'intituleAR' => 'جامعة ابن طفيل',
            'ced_id' => 1,
        ]);

        Etablissement::create([
            'intitulefr' => 'Université Hassan II',
            'intituleAR' => 'جامعة الحسن الثاني',
            'ced_id' => 1,
        ]);
    }
}
