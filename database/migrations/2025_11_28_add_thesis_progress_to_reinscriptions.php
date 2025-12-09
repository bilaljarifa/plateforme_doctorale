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
            if (!Schema::hasColumn('reinscriptions', 'thesis_progress')) {
                $table->text('thesis_progress')->nullable()->after('rapport_activite');
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
            if (Schema::hasColumn('reinscriptions', 'thesis_progress')) {
                $table->dropColumn('thesis_progress');
            }
        });
    }
};
