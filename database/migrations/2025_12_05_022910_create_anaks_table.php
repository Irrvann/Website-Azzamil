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
        Schema::create('anaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sekolahs_id')->constrained('sekolahs');
            $table->foreignId('orang_tuas_id')->constrained('orang_tuas');

            $table->string('nik', 20)->nullable();
            $table->string('nisn', 20)->nullable();
            $table->string('nipd', 20);
            $table->string('no_kk', 20)->nullable();
            $table->string('no_registrasi_kk', 20)->nullable();

            $table->string('nama_anak');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);

            
            $table->date('tanggal_masuk');
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anaks');
    }
};
