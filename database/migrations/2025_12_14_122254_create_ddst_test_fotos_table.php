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
        Schema::create('ddst_test_fotos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ddst_tests_id')
                ->constrained('ddst_tests')
                ->cascadeOnDelete();

            $table->string('foto'); // <-- sesuai permintaan
            $table->string('caption')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ddst_test_fotos');
    }
};
