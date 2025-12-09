<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('communications', function (Blueprint $table) {
            // Remove conference-specific columns
            if (Schema::hasColumn('communications', 'nom_conference')) {
                $table->dropColumn('nom_conference');
            }
            if (Schema::hasColumn('communications', 'lieu')) {
                $table->dropColumn('lieu');
            }
            if (Schema::hasColumn('communications', 'date')) {
                $table->dropColumn('date');
            }
            if (Schema::hasColumn('communications', 'auteurs')) {
                $table->dropColumn('auteurs');
            }
            if (Schema::hasColumn('communications', 'fichier')) {
                $table->dropColumn('fichier');
            }

            // Add article-like columns
            if (!Schema::hasColumn('communications', 'annee')) {
                $table->year('annee')->nullable();
            }
            if (!Schema::hasColumn('communications', 'lien')) {
                $table->string('lien')->nullable();
            }
            if (!Schema::hasColumn('communications', 'doi')) {
                $table->string('doi')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('communications', function (Blueprint $table) {
            if (!Schema::hasColumn('communications', 'nom_conference')) {
                $table->string('nom_conference')->nullable();
            }
            if (!Schema::hasColumn('communications', 'lieu')) {
                $table->string('lieu')->nullable();
            }
            if (!Schema::hasColumn('communications', 'date')) {
                $table->date('date')->nullable();
            }
            if (!Schema::hasColumn('communications', 'auteurs')) {
                $table->text('auteurs')->nullable();
            }
            if (!Schema::hasColumn('communications', 'fichier')) {
                $table->string('fichier')->nullable();
            }

            if (Schema::hasColumn('communications', 'annee')) {
                $table->dropColumn('annee');
            }
            if (Schema::hasColumn('communications', 'lien')) {
                $table->dropColumn('lien');
            }
            if (Schema::hasColumn('communications', 'doi')) {
                $table->dropColumn('doi');
            }
        });
    }
};
