<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prof;
use App\Models\Laboratoire;

class ProfSeeder extends Seeder
{
    public function run()
    {
        $labs = Laboratoire::all();
        if ($labs->isEmpty()) {
            return;
        }

        // Distribute professors across laboratories
        $professors = [
            ['nom_fr' => 'El Amrani', 'prenom' => 'Mohamed', 'email' => 'm.elamrani@uit.ac.ma'],
            ['nom_fr' => 'Benjelloun', 'prenom' => 'Amina', 'email' => 'a.benjelloun@uit.ac.ma'],
            ['nom_fr' => 'Alaoui', 'prenom' => 'Hassan', 'email' => 'h.alaoui@uit.ac.ma'],
            ['nom_fr' => 'Tahiri', 'prenom' => 'Fatima', 'email' => 'f.tahiri@uit.ac.ma'],
            ['nom_fr' => 'Bennis', 'prenom' => 'Omar', 'email' => 'o.bennis@uit.ac.ma'],
            ['nom_fr' => 'Lahlou', 'prenom' => 'Samira', 'email' => 's.lahlou@uit.ac.ma'],
            ['nom_fr' => 'Kabbaj', 'prenom' => 'Youssef', 'email' => 'y.kabbaj@uit.ac.ma'],
            ['nom_fr' => 'Naciri', 'prenom' => 'Rajae', 'email' => 'r.naciri@uit.ac.ma'],
            ['nom_fr' => 'Berrada', 'prenom' => 'Karim', 'email' => 'k.berrada@uit.ac.ma'],
            ['nom_fr' => 'Tazi', 'prenom' => 'Nadia', 'email' => 'n.tazi@uit.ac.ma'],
            ['nom_fr' => 'Ziani', 'prenom' => 'Ahmed', 'email' => 'a.ziani@uit.ac.ma'],
            ['nom_fr' => 'Filali', 'prenom' => 'Zineb', 'email' => 'z.filali@uit.ac.ma'],
            ['nom_fr' => 'Oukessou', 'prenom' => 'Said', 'email' => 's.oukessou@uit.ac.ma'],
            ['nom_fr' => 'Chakir', 'prenom' => 'Meriem', 'email' => 'm.chakir@uit.ac.ma'],
            ['nom_fr' => 'Hamidi', 'prenom' => 'Rachid', 'email' => 'r.hamidi@uit.ac.ma'],
        ];

        foreach ($professors as $index => $prof) {
            // Distribute across available laboratories
            $labIndex = $index % $labs->count();
            Prof::create(array_merge($prof, [
                'laboratoire_id' => $labs[$labIndex]->id,
            ]));
        }
    }
}
