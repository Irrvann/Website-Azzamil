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
        Schema::create('ddst_test_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ddst_tests_id')->constrained('ddst_tests')->onDelete('cascade');
            $table->foreignId('ddst_items_id')->constrained('ddst_items');

            $table->enum('status', [
                'pass', // berhasil
                'fail', // gagal
                'refusal', // menolak mengerjakan
                'no_opportunity', // tidak ada kesempatan
            ])->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ddst_test_items');
    }
};
