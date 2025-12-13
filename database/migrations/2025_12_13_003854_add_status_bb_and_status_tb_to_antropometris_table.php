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
            $table->enum('status_bb', ['normal', 'resiko'])
                ->nullable()
                ->after('berat_badan');

            $table->enum('status_tb', ['normal', 'pendek'])
                ->nullable()
                ->after('tinggi_badan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antropometris', function (Blueprint $table) {
            //
            $table->dropColumn(['status_bb', 'status_tb']);
        });
    }
};
