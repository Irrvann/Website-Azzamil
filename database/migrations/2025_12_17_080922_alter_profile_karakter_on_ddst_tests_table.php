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
        //
        Schema::table('ddst_tests', function (Blueprint $table) {
            // rename kolom lama
            $table->renameColumn(
                'profile_dan_karakter',
                'profile_dan_karakter_yang_dikenali_guru'
            );

            // tambah kolom baru
            $table->text('profile_dan_karakter_yang_dikenali_ortu')
                  ->nullable()
                  ->after('profile_dan_karakter_yang_dikenali_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('ddst_tests', function (Blueprint $table) {
            // hapus kolom baru
            $table->dropColumn('profile_dan_karakter_yang_dikenali_ortu');

            // kembalikan nama kolom lama
            $table->renameColumn(
                'profile_dan_karakter_yang_dikenali_guru',
                'profile_dan_karakter'
            );
        });
    }
};
