<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->nullable();
            $table->string('nom_fr')->nullable();
            $table->string('nom_ar')->nullable();
            $table->string('prenom_ar')->nullable();
            $table->string('cin')->nullable();
            $table->string('cne')->nullable();
            $table->enum('genre', ['M', 'F'])->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('situation_familiale', ['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)'])->nullable();
            $table->enum('situation_administrative', ['Fonctionnaire', 'Salarié', 'Sans emploi'])->nullable();
            $table->string('telephone')->nullable();
            $table->string('orcid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
