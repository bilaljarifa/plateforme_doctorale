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
        Schema::table('reinscriptions', function (Blueprint $table) {
            // Make required fields NOT NULL
            $table->string('annee_inscription')->nullable(false)->change();
            $table->string('rapport_path')->nullable(false)->change();
            $table->text('thesis_progress')->nullable(false)->change();
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
            // Revert fields back to nullable
            $table->string('annee_inscription')->nullable()->change();
            $table->string('rapport_path')->nullable()->change();
            $table->text('thesis_progress')->nullable()->change();
        });
    }
};
