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
        Schema::table('anaks', function (Blueprint $table) {
            // drop FK lama
            $table->dropForeign('anaks_orang_tuas_id_foreign');

            // buat FK baru dengan cascade
            $table->foreign('orang_tuas_id')
                ->references('id')
                ->on('orang_tuas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('anaks', function (Blueprint $table) {
            $table->dropForeign('anaks_orang_tuas_id_foreign');

            // balik ke aturan tanpa cascade (default restrict)
            $table->foreign('orang_tuas_id')
                ->references('id')
                ->on('orang_tuas');
        });
    }
};
