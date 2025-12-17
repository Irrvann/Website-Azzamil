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
            $table->string('nik_ayah', 16)->after('nama_ayah');
            $table->string('nik_ibu', 16)->after('nama_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orang_tuas', function (Blueprint $table) {
            //
            $table->dropColumn(['nik_ayah', 'nik_ibu']);
        });
    }
};
