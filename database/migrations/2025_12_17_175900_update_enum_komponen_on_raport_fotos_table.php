<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        // 1) Tambahkan nilai baru ke ENUM (MASIH termasuk nilai lama)
        DB::statement("
            ALTER TABLE raport_fotos
            MODIFY komponen ENUM(
                'agama',
                'jati_diri',
                'literasi_sains',
                'p5',
                'dasar_literasi_steam',
                'kokurikuler'
            ) NOT NULL
        ");

        // 2) Update data lama -> nama baru
        DB::table('raport_fotos')
            ->where('komponen', 'literasi_sains')
            ->update(['komponen' => 'dasar_literasi_steam']);

        DB::table('raport_fotos')
            ->where('komponen', 'p5')
            ->update(['komponen' => 'kokurikuler']);

        // 3) Rapikan ENUM: buang nilai lama (opsional tapi bagus)
        DB::statement("
            ALTER TABLE raport_fotos
            MODIFY komponen ENUM(
                'agama',
                'jati_diri',
                'dasar_literasi_steam',
                'kokurikuler'
            ) NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::statement("
            ALTER TABLE raport_fotos
            MODIFY komponen ENUM(
                'agama',
                'jati_diri',
                'literasi_sains',
                'p5',
                'dasar_literasi_steam',
                'kokurikuler'
            ) NOT NULL
        ");

        // balikkan data
        DB::table('raport_fotos')
            ->where('komponen', 'dasar_literasi_steam')
            ->update(['komponen' => 'literasi_sains']);

        DB::table('raport_fotos')
            ->where('komponen', 'kokurikuler')
            ->update(['komponen' => 'p5']);

        // rapikan balik ke ENUM lama
        DB::statement("
            ALTER TABLE raport_fotos
            MODIFY komponen ENUM(
                'agama',
                'jati_diri',
                'literasi_sains',
                'p5'
            ) NOT NULL
        ");
    }
};
