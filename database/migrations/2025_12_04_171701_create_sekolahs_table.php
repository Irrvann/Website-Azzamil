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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daerahs_id')->constrained('daerahs');

            $table->string('nama_sekolah');
            $table->enum('jenis_sekolah', [
                'baby',
                'toddler',
                'pra_kb',
                'kb_kecil',
                'kb_besar',
                'tk'
            ]);
            $table->string('kelas'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
