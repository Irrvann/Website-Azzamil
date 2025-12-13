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
        Schema::create('raport_fotos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('raport_id')
                ->constrained('raports')
                ->onDelete('cascade');

            $table->enum('komponen', [
                'agama',
                'jati_diri',
                'literasi_sains',
                'p5'
            ]);

            $table->string('foto'); // path file

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport_fotos');
    }
};
