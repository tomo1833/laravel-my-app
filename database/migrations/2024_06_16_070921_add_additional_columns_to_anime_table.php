<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->integer('genre')->nullable();
            $table->integer('season_1_opening')->nullable();
            $table->integer('season_1_ending')->nullable();
            $table->integer('season_2_opening')->nullable();
            $table->integer('season_2_ending')->nullable();
            $table->integer('broadcast_period')->nullable();
            $table->integer('production_company')->nullable();
            $table->string('title_kana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animes', function (Blueprint $table) {
            $table->dropColumn('genre');
            $table->dropColumn('season_1_opening');
            $table->dropColumn('season_1_ending');
            $table->dropColumn('season_2_opening');
            $table->dropColumn('season_2_ending');
            $table->dropColumn('broadcast_period');
            $table->dropColumn('production_company');
            $table->dropColumn('title_kana');
        });
    }
};
