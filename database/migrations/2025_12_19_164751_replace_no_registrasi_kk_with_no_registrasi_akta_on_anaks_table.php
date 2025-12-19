<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::table('anaks', function (Blueprint $table) {

            // Hapus kolom lama
            if (Schema::hasColumn('anaks', 'no_registrasi_kk')) {
                $table->dropColumn('no_registrasi_kk');
            }

            // Tambah kolom baru
            $table->string('no_registrasi_akta', 50)
                ->nullable()
                ->after('nik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('anaks', function (Blueprint $table) {

            // Hapus kolom baru
            if (Schema::hasColumn('anaks', 'no_registrasi_akta')) {
                $table->dropColumn('no_registrasi_akta');
            }

            // Kembalikan kolom lama
            $table->string('no_registrasi_kk', 50)
                ->nullable()
                ->after('nik');
        });
    }
};
