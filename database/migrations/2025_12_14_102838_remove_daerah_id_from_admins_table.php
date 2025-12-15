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
        Schema::table('admins', function (Blueprint $table) {
            //
              // hapus foreign key dulu
            $table->dropForeign(['daerahs_id']);

            // lalu hapus kolomnya
            $table->dropColumn('daerahs_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            //
             $table->foreignId('daerahs_id')
                  ->nullable()
                  ->constrained('daerahs')
                  ->nullOnDelete();
        });
    }
};
