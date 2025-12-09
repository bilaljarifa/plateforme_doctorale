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
        // Register enum type with Doctrine to avoid errors
        \DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::table('doctorant_profiles', function (Blueprint $table) {
            // Make required fields NOT NULL
            $table->string('cin')->nullable(false)->change();
            $table->string('cne')->nullable(false)->change();
            $table->string('nom_arabe')->nullable(false)->change();
            $table->string('prenom_arabe')->nullable(false)->change();
            $table->string('genre')->nullable(false)->change();
            $table->date('date_naissance')->nullable(false)->change();
            $table->string('situation_familiale')->nullable(false)->change();
            $table->string('situation_administrative')->nullable(false)->change();
            $table->string('orcid')->nullable(false)->change();
            $table->string('telephone')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Register enum type with Doctrine to avoid errors
        \DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::table('doctorant_profiles', function (Blueprint $table) {
            // Revert fields back to nullable
            $table->string('cin')->nullable()->change();
            $table->string('cne')->nullable()->change();
            $table->string('nom_arabe')->nullable()->change();
            $table->string('prenom_arabe')->nullable()->change();
            $table->string('genre')->nullable()->change();
            $table->date('date_naissance')->nullable()->change();
            $table->string('situation_familiale')->nullable()->change();
            $table->string('situation_administrative')->nullable()->change();
            $table->string('orcid')->nullable()->change();
            $table->string('telephone')->nullable()->change();
        });
    }
};
