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
            // kolom relasi ke antropometris
            $table->unsignedBigInteger('antropometris_id')
                ->nullable()
                ->after('anaks_id');

            $table->foreign('antropometris_id')
                ->references('id')
                ->on('antropometris')
                ->onDelete('cascade'); // kalau antropometri dihapus, tes ini ikut hilang (boleh diganti set null kalau mau)

            // 1 tes DDST hanya boleh untuk 1 antropometri
            $table->unique('antropometris_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ddst_tests', function (Blueprint $table) {
            //
            $table->dropForeign(['antropometris_id']);
            $table->dropUnique(['antropometris_id']);
            $table->dropColumn('antropometris_id');
        });
    }
};
