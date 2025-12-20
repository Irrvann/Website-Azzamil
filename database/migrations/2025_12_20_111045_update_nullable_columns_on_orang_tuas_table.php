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
        //
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->string('nik_ayah')->nullable()->change();
            $table->string('nama_ayah')->nullable()->change();
            $table->string('nik_ibu')->nullable()->change();
            $table->string('nama_ibu')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('orang_tuas', function (Blueprint $table) {
            $table->string('nik_ayah')->nullable(false)->change();
            $table->string('nama_ayah')->nullable(false)->change();
            $table->string('nik_ibu')->nullable(false)->change();
            $table->string('nama_ibu')->nullable(false)->change();
        });
    }
};
