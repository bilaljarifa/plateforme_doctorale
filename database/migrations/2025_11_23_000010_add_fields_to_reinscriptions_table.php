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
        Schema::table('reinscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('reinscriptions', 'annee_inscription')) {
                $table->string('annee_inscription')->nullable()->after('annee_academique');
            }
            if (!Schema::hasColumn('reinscriptions', 'rapport_path')) {
                $table->string('rapport_path')->nullable()->after('rapport_activite');
            }
            if (!Schema::hasColumn('reinscriptions', 'directeur_valide')) {
                $table->boolean('directeur_valide')->default(false)->after('rapport_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reinscriptions', function (Blueprint $table) {
            if (Schema::hasColumn('reinscriptions', 'directeur_valide')) {
                $table->dropColumn('directeur_valide');
            }
            if (Schema::hasColumn('reinscriptions', 'rapport_path')) {
                $table->dropColumn('rapport_path');
            }
            if (Schema::hasColumn('reinscriptions', 'annee_inscription')) {
                $table->dropColumn('annee_inscription');
            }
        });
    }
};
