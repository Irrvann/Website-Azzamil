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
        Schema::table('orang_tuas', function (Blueprint $table) {
            //
            $table->unique('nik_ayah', 'orang_tuas_nik_ayah_unique');
            $table->unique('nik_ibu', 'orang_tuas_nik_ibu_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            //
            $table->dropUnique('orang_tuas_nik_ayah_unique');
            $table->dropUnique('orang_tuas_nik_ibu_unique');
        });
    }
};
