<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('apogee');
            $table->foreignId('centre_etudes_doctorales_id')->nullable()->constrained('ceds')->onDelete('set null');
            $table->foreignId('formations_doctorales_id')->nullable()->constrained('peds')->onDelete('set null');
            $table->foreignId('directeur_these_id')->nullable()->constrained('profs')->onDelete('set null');
            $table->foreignId('laboratoire_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('etablissement_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('sujet_id')->nullable()->constrained('sujets')->onDelete('set null');
            $table->string('co_directeur_type')->nullable();
            $table->string('co_directeur_nom_complet')->nullable();
            $table->string('co_directeur_nom')->nullable();
            $table->string('co_directeur_prenom')->nullable();
            $table->string('co_directeur_etablissement')->nullable();
            $table->string('annee_inscription')->nullable();
            $table->string('annee_premiere_inscription')->nullable();
            $table->date('date_prevue_soutenance')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('theses');
    }
};
