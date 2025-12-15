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
        Schema::table('ddst_tests', function (Blueprint $table) {
            // tambah field baru
            $table->text('profile_dan_karakter')
                ->nullable()
                ->after('interpretasi_ddst');

            // hapus field lama
            $table->dropColumn([
                'tugas_belum_tercapai',
                'tugas_perlu_ditingkatkan',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('ddst_tests', function (Blueprint $table) {
            // kembalikan field lama
            $table->text('tugas_belum_tercapai')->nullable();
            $table->text('tugas_perlu_ditingkatkan')->nullable();

            // hapus field baru
            $table->dropColumn('profile_dan_karakter');
        });
    }
};
