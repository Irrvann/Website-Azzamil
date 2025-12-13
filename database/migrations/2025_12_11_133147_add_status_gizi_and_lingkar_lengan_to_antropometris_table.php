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
            $table->decimal('lingkar_lengan', 8, 2)
                ->nullable()
                ->after('lingkar_kepala');

            $table->enum('status_gizi', ['normal', 'gizi_kurang', 'gizi_berlebih'])
                ->nullable()
                ->after('lingkar_lengan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antropometris', function (Blueprint $table) {
            //
            $table->dropColumn(['lingkar_lengan', 'status_gizi']);
        });
    }
};
