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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('sekolahs_id')->constrained('sekolahs');

            $table->string('nik', 20)->nullable();
            $table->string('nipa', 50)->nullable();
            $table->string('nama_guru');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->enum('jabatan', [
                'kepala_sekolah',
                'operator',
                'guru',
            ])->nullable();

            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_hp', 20)->nullable();

            $table->enum('pend_terakhir', [
                'smp',
                'smk',
                'sma',
                'd3',
                's1',
                's2',
                's3',
            ])->nullable();

            $table->string('jurusan')->nullable();

            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
