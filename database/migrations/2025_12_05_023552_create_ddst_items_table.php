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
        Schema::create('ddst_items', function (Blueprint $table) {
            $table->id();

            $table->enum('kategori_perkembangan', [
                'personal_sosial',
                'motorik_halus',
                'bahasa',
                'motorik_kasar',
            ]);

            $table->string('nama_item');
            $table->integer('min_bulan')->nullable();
            $table->integer('max_bulan')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ddst_items');
    }
};
