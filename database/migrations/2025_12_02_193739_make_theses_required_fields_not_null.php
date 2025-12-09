<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theses', function (Blueprint $table) {
            // Make required foreign keys NOT NULL
            $table->foreignId('centre_etudes_doctorales_id')->nullable(false)->change();
            $table->foreignId('formations_doctorales_id')->nullable(false)->change();
            $table->foreignId('directeur_these_id')->nullable(false)->change();
            $table->foreignId('laboratoire_id')->nullable(false)->change();
            $table->foreignId('etablissement_id')->nullable(false)->change();
            $table->foreignId('sujet_id')->nullable(false)->change();
            
            // Make required string/date fields NOT NULL
            $table->string('annee_inscription')->nullable(false)->change();
            $table->string('annee_premiere_inscription')->nullable(false)->change();
            $table->date('date_prevue_soutenance')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('theses', function (Blueprint $table) {
            // Revert fields back to nullable
            $table->foreignId('centre_etudes_doctorales_id')->nullable()->change();
            $table->foreignId('formations_doctorales_id')->nullable()->change();
            $table->foreignId('directeur_these_id')->nullable()->change();
            $table->foreignId('laboratoire_id')->nullable()->change();
            $table->foreignId('etablissement_id')->nullable()->change();
            $table->foreignId('sujet_id')->nullable()->change();
            $table->string('annee_inscription')->nullable()->change();
            $table->string('annee_premiere_inscription')->nullable()->change();
            $table->date('date_prevue_soutenance')->nullable()->change();
        });
    }
};
