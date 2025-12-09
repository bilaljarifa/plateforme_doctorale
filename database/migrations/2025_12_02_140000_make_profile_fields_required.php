<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, update any NULL values to default values
        DB::statement("UPDATE doctorant_profiles SET cin = '' WHERE cin IS NULL");
        DB::statement("UPDATE doctorant_profiles SET cne = '' WHERE cne IS NULL");
        DB::statement("UPDATE doctorant_profiles SET nom_arabe = '' WHERE nom_arabe IS NULL");
        DB::statement("UPDATE doctorant_profiles SET prenom_arabe = '' WHERE prenom_arabe IS NULL");
        DB::statement("UPDATE doctorant_profiles SET genre = 'Homme' WHERE genre IS NULL");
        DB::statement("UPDATE doctorant_profiles SET date_naissance = '1990-01-01' WHERE date_naissance IS NULL");
        DB::statement("UPDATE doctorant_profiles SET situation_familiale = 'Célibataire' WHERE situation_familiale IS NULL");
        DB::statement("UPDATE doctorant_profiles SET situation_administrative = 'Sans emploi' WHERE situation_administrative IS NULL");
        DB::statement("UPDATE doctorant_profiles SET orcid = '' WHERE orcid IS NULL");
        DB::statement("UPDATE doctorant_profiles SET telephone = '' WHERE telephone IS NULL");
        
        DB::statement("UPDATE users SET prenom = '' WHERE prenom IS NULL");
        
        // Use raw SQL to modify columns to NOT NULL
        DB::statement("ALTER TABLE doctorant_profiles MODIFY cin VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY cne VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY nom_arabe VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY prenom_arabe VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY genre ENUM('Homme', 'Femme') NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY date_naissance DATE NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY situation_familiale ENUM('Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)') NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY situation_administrative ENUM('Fonctionnaire', 'Salarié', 'Sans emploi') NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY orcid VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY telephone VARCHAR(255) NOT NULL");
        
        DB::statement("ALTER TABLE users MODIFY prenom VARCHAR(255) NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE doctorant_profiles MODIFY cin VARCHAR(255) NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY cne VARCHAR(255) NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY nom_arabe VARCHAR(255) NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY prenom_arabe VARCHAR(255) NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY genre ENUM('Homme', 'Femme') NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY date_naissance DATE NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY situation_familiale ENUM('Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)') NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY situation_administrative ENUM('Fonctionnaire', 'Salarié', 'Sans emploi') NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY orcid VARCHAR(255) NULL");
        DB::statement("ALTER TABLE doctorant_profiles MODIFY telephone VARCHAR(255) NULL");
        
        DB::statement("ALTER TABLE users MODIFY prenom VARCHAR(255) NULL");
    }
};
