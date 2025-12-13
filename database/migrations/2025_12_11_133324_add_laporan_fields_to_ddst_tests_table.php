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
        Schema::table('ddst_tests', function (Blueprint $table) {
            //
            $table->string('semester', 20)->nullable()->after('usia_bulan');
            $table->string('tahun_ajaran', 20)->nullable()->after('semester');

            $table->text('interpretasi_ddst')->nullable()->after('tahun_ajaran');
            $table->text('tugas_belum_tercapai')->nullable()->after('interpretasi_ddst');
            $table->text('tugas_perlu_ditingkatkan')->nullable()->after('tugas_belum_tercapai');
            $table->text('saran_rujukan')->nullable()->after('tugas_perlu_ditingkatkan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ddst_tests', function (Blueprint $table) {
            //
            $table->dropColumn([
                'semester',
                'tahun_ajaran',
                'interpretasi_ddst',
                'tugas_belum_tercapai',
                'tugas_perlu_ditingkatkan',
                'saran_rujukan',
            ]);
        });
    }
};
