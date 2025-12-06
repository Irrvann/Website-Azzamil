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
        Schema::table('gurus', function (Blueprint $table) {
            //
            $table->dropForeign(['sekolahs_id']);

            // BUAT LAGI dengan ON DELETE CASCADE
            $table->foreign('sekolahs_id')
                ->references('id')
                ->on('sekolahs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            //
            $table->dropForeign(['sekolahs_id']);

            $table->foreign('sekolahs_id')
                ->references('id')
                ->on('sekolahs');
        });
    }
};
