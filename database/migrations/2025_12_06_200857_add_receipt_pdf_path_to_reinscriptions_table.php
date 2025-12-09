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
            $table->string('receipt_pdf_path')->nullable()->after('directeur_valide');
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
            $table->dropColumn('receipt_pdf_path');
        });
    }
};
