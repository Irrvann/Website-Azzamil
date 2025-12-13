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
        Schema::create('raports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anak_id')->constrained('anaks')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained('gurus');
            $table->foreignId('sekolah_id')->constrained('sekolahs');

            $table->enum('semester', ['1', '2']);
            $table->string('tahun_ajaran', 20);

            // Snapshot antropometri
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();

            // Bidang nilai
            $table->text('nilai_agama')->nullable();
            $table->text('nilai_jati_diri')->nullable();
            $table->text('nilai_literasi_sains')->nullable();
            $table->text('nilai_p5')->nullable();

            // Refleksi
            $table->text('refleksi_guru')->nullable();
            $table->text('refleksi_orang_tua')->nullable();

            // Kehadiran
            $table->integer('sakit')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('tanpa_keterangan')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raports');
    }
};
