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
        Schema::table('paper_submissions', function (Blueprint $table) {
            $table->tinyInteger('revision')->nullable()->default(0)->after('active')->comment("0 for main, 1 for R1, 2 for R2 ...");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paper_submissions', function (Blueprint $table) {
            $table->dropColumn('revision');
        });
    }
};
