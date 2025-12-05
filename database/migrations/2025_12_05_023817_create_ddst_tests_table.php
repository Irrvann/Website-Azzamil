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
        Schema::create('ddst_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anaks_id')->constrained('anaks');
            $table->foreignId('gurus_id')->constrained('gurus');

            $table->date('tanggal_test');
            $table->integer('usia_bulan')->nullable();

            $table->enum('hasil_akhir', [
                'normal',
                'meragukan',
                'abnormal',
                'tidak_dapat_dites',
            ])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ddst_tests');
    }
};
