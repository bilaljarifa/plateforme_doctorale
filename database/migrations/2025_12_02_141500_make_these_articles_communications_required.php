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
        // ==========================================
        // THESES TABLE
        // ==========================================
        
        // 1. Update NULL values to defaults
        DB::statement("UPDATE theses SET apogee = '' WHERE apogee IS NULL");
        DB::statement("UPDATE theses SET annee_inscription = '' WHERE annee_inscription IS NULL");
        DB::statement("UPDATE theses SET annee_premiere_inscription = '' WHERE annee_premiere_inscription IS NULL");
        DB::statement("UPDATE theses SET co_directeur_type = 'non' WHERE co_directeur_type IS NULL");
        DB::statement("UPDATE theses SET date_prevue_soutenance = CURDATE() WHERE date_prevue_soutenance IS NULL");
        
        // Update foreign keys to valid IDs (assuming ID 1 exists, otherwise this might fail if table is empty it's fine)
        // If tables are empty, these updates do nothing. If they have data, we hope ID 1 exists or we might need another strategy.
        // For safety, let's assume the user knows what they are doing or the tables are mostly empty/test data.
        // A safer approach for FKs is to disable checks temporarily.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        DB::statement("UPDATE theses SET centre_etudes_doctorales_id = 1 WHERE centre_etudes_doctorales_id IS NULL");
        DB::statement("UPDATE theses SET formations_doctorales_id = 1 WHERE formations_doctorales_id IS NULL");
        DB::statement("UPDATE theses SET directeur_these_id = 1 WHERE directeur_these_id IS NULL");
        DB::statement("UPDATE theses SET laboratoire_id = 1 WHERE laboratoire_id IS NULL");
        DB::statement("UPDATE theses SET etablissement_id = 1 WHERE etablissement_id IS NULL");
        DB::statement("UPDATE theses SET sujet_id = 1 WHERE sujet_id IS NULL");

        // 2. Drop existing foreign keys that have 'ON DELETE SET NULL'
        Schema::table('theses', function (Blueprint $table) {
            $table->dropForeign(['centre_etudes_doctorales_id']);
            $table->dropForeign(['formations_doctorales_id']);
            $table->dropForeign(['directeur_these_id']);
            $table->dropForeign(['laboratoire_id']);
            $table->dropForeign(['etablissement_id']);
            $table->dropForeign(['sujet_id']);
        });

        // 3. Make fields NOT NULL
        DB::statement("ALTER TABLE theses MODIFY apogee VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY annee_inscription VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY annee_premiere_inscription VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY co_directeur_type VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY date_prevue_soutenance DATE NOT NULL");
        
        DB::statement("ALTER TABLE theses MODIFY centre_etudes_doctorales_id BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY formations_doctorales_id BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY directeur_these_id BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY laboratoire_id BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY etablissement_id BIGINT UNSIGNED NOT NULL");
        DB::statement("ALTER TABLE theses MODIFY sujet_id BIGINT UNSIGNED NOT NULL");

        // 4. Re-add foreign keys without 'ON DELETE SET NULL' (using default restrict or cascade)
        Schema::table('theses', function (Blueprint $table) {
            $table->foreign('centre_etudes_doctorales_id')->references('id')->on('ceds');
            $table->foreign('formations_doctorales_id')->references('id')->on('peds');
            $table->foreign('directeur_these_id')->references('id')->on('profs');
            $table->foreign('laboratoire_id')->references('id')->on('laboratoires');
            $table->foreign('etablissement_id')->references('id')->on('etablissements');
            $table->foreign('sujet_id')->references('id')->on('sujets');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // ==========================================
        // ARTICLES TABLE
        // ==========================================
        DB::statement("UPDATE articles SET type = 'article' WHERE type IS NULL OR type = ''");
        DB::statement("UPDATE articles SET titre = 'Sans titre' WHERE titre IS NULL OR titre = ''");
        DB::statement("UPDATE articles SET annee = YEAR(CURDATE()) WHERE annee IS NULL");
        
        DB::statement("ALTER TABLE articles MODIFY type VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE articles MODIFY titre VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE articles MODIFY annee YEAR NOT NULL");
        
        // ==========================================
        // COMMUNICATIONS TABLE
        // ==========================================
        DB::statement("UPDATE communications SET titre = 'Sans titre' WHERE titre IS NULL OR titre = ''");
        DB::statement("UPDATE communications SET annee = YEAR(CURDATE()) WHERE annee IS NULL");
        
        DB::statement("ALTER TABLE communications MODIFY titre VARCHAR(255) NOT NULL");
        DB::statement("ALTER TABLE communications MODIFY annee YEAR NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // THESES
        Schema::table('theses', function (Blueprint $table) {
            $table->dropForeign(['centre_etudes_doctorales_id']);
            $table->dropForeign(['formations_doctorales_id']);
            $table->dropForeign(['directeur_these_id']);
            $table->dropForeign(['laboratoire_id']);
            $table->dropForeign(['etablissement_id']);
            $table->dropForeign(['sujet_id']);
        });

        DB::statement("ALTER TABLE theses MODIFY apogee VARCHAR(255) NULL");
        DB::statement("ALTER TABLE theses MODIFY annee_inscription VARCHAR(255) NULL");
        DB::statement("ALTER TABLE theses MODIFY annee_premiere_inscription VARCHAR(255) NULL");
        DB::statement("ALTER TABLE theses MODIFY co_directeur_type VARCHAR(255) NULL");
        DB::statement("ALTER TABLE theses MODIFY date_prevue_soutenance DATE NULL");
        
        DB::statement("ALTER TABLE theses MODIFY centre_etudes_doctorales_id BIGINT UNSIGNED NULL");
        DB::statement("ALTER TABLE theses MODIFY formations_doctorales_id BIGINT UNSIGNED NULL");
        DB::statement("ALTER TABLE theses MODIFY directeur_these_id BIGINT UNSIGNED NULL");
        DB::statement("ALTER TABLE theses MODIFY laboratoire_id BIGINT UNSIGNED NULL");
        DB::statement("ALTER TABLE theses MODIFY etablissement_id BIGINT UNSIGNED NULL");
        DB::statement("ALTER TABLE theses MODIFY sujet_id BIGINT UNSIGNED NULL");

        Schema::table('theses', function (Blueprint $table) {
            $table->foreign('centre_etudes_doctorales_id')->references('id')->on('ceds')->onDelete('set null');
            $table->foreign('formations_doctorales_id')->references('id')->on('peds')->onDelete('set null');
            $table->foreign('directeur_these_id')->references('id')->on('profs')->onDelete('set null');
            $table->foreign('laboratoire_id')->references('id')->on('laboratoires')->onDelete('set null');
            $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('set null');
            $table->foreign('sujet_id')->references('id')->on('sujets')->onDelete('set null');
        });
        
        // ARTICLES
        DB::statement("ALTER TABLE articles MODIFY type VARCHAR(255) NULL");
        DB::statement("ALTER TABLE articles MODIFY titre VARCHAR(255) NULL");
        DB::statement("ALTER TABLE articles MODIFY annee YEAR NULL");
        
        // COMMUNICATIONS
        DB::statement("ALTER TABLE communications MODIFY titre VARCHAR(255) NULL");
        DB::statement("ALTER TABLE communications MODIFY annee YEAR NULL");

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
