<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('raports', function (Blueprint $table) {
            //
            $table->renameColumn('nilai_agama', 'nilai_agama_dan_budi_pekerti');
            $table->renameColumn('nilai_literasi_sains', 'nilai_dasar_literasi_steam');
            $table->renameColumn('nilai_p5', 'nilai_kokurikuler');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raports', function (Blueprint $table) {
            //
            $table->renameColumn('nilai_agama_dan_budi_pekerti', 'nilai_agama');
            $table->renameColumn('nilai_dasar_literasi_steam', 'nilai_literasi_sains');
            $table->renameColumn('nilai_kokurikuler', 'nilai_p5');
        });
    }
};
