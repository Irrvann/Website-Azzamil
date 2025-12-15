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
        // 0) Perluas enum: gabungkan enum lama + enum baru
        DB::statement("
        ALTER TABLE sekolahs
        MODIFY COLUMN jenis_sekolah
        ENUM('baby','toddler','pra_kb','kb_kecil','kb_besar','tk','tpa','kb','tpa_kb_tk')
        NOT NULL
    ");

        // 1) Mapping lama -> baru (sekarang aman karena enum sudah memuat tpa/kb)
        DB::table('sekolahs')->whereIn('jenis_sekolah', ['baby', 'toddler'])->update([
            'jenis_sekolah' => 'tpa'
        ]);

        DB::table('sekolahs')->whereIn('jenis_sekolah', ['pra_kb', 'kb_kecil', 'kb_besar'])->update([
            'jenis_sekolah' => 'kb'
        ]);

        // 2) Kunci enum final (hanya nilai baru)
        DB::statement("
        ALTER TABLE sekolahs
        MODIFY COLUMN jenis_sekolah
        ENUM('tpa','kb','tk','tpa_kb_tk')
        NOT NULL
    ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // Perluas dulu supaya bisa menampung nilai lama
        DB::statement("
        ALTER TABLE sekolahs
        MODIFY COLUMN jenis_sekolah
        ENUM('baby','toddler','pra_kb','kb_kecil','kb_besar','tk','tpa','kb','tpa_kb_tk')
        NOT NULL
    ");

        // mapping balik (pilih yang kamu anggap paling pas)
        DB::table('sekolahs')->where('jenis_sekolah', 'tpa')->update(['jenis_sekolah' => 'toddler']);
        DB::table('sekolahs')->where('jenis_sekolah', 'kb')->update(['jenis_sekolah' => 'kb_kecil']);
        DB::table('sekolahs')->where('jenis_sekolah', 'tpa_kb_tk')->update(['jenis_sekolah' => 'kb_besar']);

        // kunci ke enum lama
        DB::statement("
        ALTER TABLE sekolahs
        MODIFY COLUMN jenis_sekolah
        ENUM('baby','toddler','pra_kb','kb_kecil','kb_besar','tk')
        NOT NULL
    ");
    }
};
