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
        //
        Schema::table('ddst_test_items', function (Blueprint $table) {
            $table->enum('status', ['tercapai', 'belum_tercapai'])
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('ddst_test_items', function (Blueprint $table) {
            $table->enum('status', ['pass', 'fail', 'refusal', 'no_oppurtunity'])
                ->change();
        });
    }
};
