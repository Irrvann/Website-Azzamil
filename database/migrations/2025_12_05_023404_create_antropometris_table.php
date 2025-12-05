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
        Schema::create('antropometris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anaks_id')->constrained('anaks');

            $table->date('tanggal_ukur');
            $table->decimal('tinggi_badan', 5, 2)->nullable();   
            $table->decimal('berat_badan', 5, 2)->nullable();    
            $table->decimal('lingkar_kepala', 5, 2)->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antropometris');
    }
};
