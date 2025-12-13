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
        Schema::table('ddst_test_items', function (Blueprint $table) {
            //
             $table->unique(['ddst_tests_id', 'ddst_items_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ddst_test_items', function (Blueprint $table) {
            //
            $table->dropUnique(['ddst_test_items_ddst_tests_id_ddst_items_id_unique']);
        });
    }
};
