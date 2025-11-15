<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed minimal examples for theses selects (order matters for foreign keys)
        $this->call([
            \Database\Seeders\PedSeeder::class,
            \Database\Seeders\CedSeeder::class,
            \Database\Seeders\EtablissementSeeder::class,
            \Database\Seeders\LaboratoireSeeder::class,
            \Database\Seeders\ProfSeeder::class,
        ]);
    }
}
