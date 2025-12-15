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
        Schema::table('ddst_tests', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('reviewers_id')->nullable()->after('id');

            $table->foreign('reviewers_id')
                ->references('id')
                ->on('reviewers')
                ->nullOnDelete(); // ON DELETE SET NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ddst_tests', function (Blueprint $table) {
            //
            $table->dropForeign(['reviewers_id']);
            $table->dropColumn('reviewers_id');
        });
    }
};
