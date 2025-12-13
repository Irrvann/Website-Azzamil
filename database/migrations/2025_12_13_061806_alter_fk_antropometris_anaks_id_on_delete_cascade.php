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
        Schema::table('antropometris', function (Blueprint $table) {
            //
            // drop FK lama
            $table->dropForeign(['anaks_id']);

            // buat FK baru pakai cascade
            $table->foreign('anaks_id')
                ->references('id')->on('anaks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antropometris', function (Blueprint $table) {
            //
            $table->dropForeign(['anaks_id']);

            // balikin default (restrict/no action)
            $table->foreign('anaks_id')
                ->references('id')->on('anaks');
        });
    }
};
