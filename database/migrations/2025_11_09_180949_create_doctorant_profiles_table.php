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
        Schema::create('doctorant_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('cin')->nullable();
            $table->string('cne')->nullable();
            $table->string('nom_arabe')->nullable();
            $table->string('prenom_arabe')->nullable();
            $table->enum('genre', ['Homme', 'Femme'])->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('situation_familiale', ['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)'])->nullable();
            $table->enum('situation_administrative', ['Fonctionnaire', 'Salarié', 'Sans emploi'])->nullable();
            $table->string('orcid')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctorant_profiles');
    }
};
