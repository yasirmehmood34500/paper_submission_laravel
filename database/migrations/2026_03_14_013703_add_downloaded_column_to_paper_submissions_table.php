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
            $table->tinyInteger('downloaded')->nullable()->default(0)->after('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paper_submissions', function (Blueprint $table) {
            $table->dropColumn('downloaded');
        });
    }
};
