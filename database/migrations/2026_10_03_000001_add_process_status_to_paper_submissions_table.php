<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('paper_submissions', function (Blueprint $table) {
            $table->tinyInteger('process_status')->default(1)->after('status');
        });

        DB::table('paper_submissions')->whereNull('process_status')->orWhere('process_status', 0)->update([
            'process_status' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paper_submissions', function (Blueprint $table) {
            $table->dropColumn('process_status');
        });
    }
};
