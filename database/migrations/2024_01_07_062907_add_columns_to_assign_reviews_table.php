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
        Schema::table('assign_reviews', function (Blueprint $table) {
            $table->string('file')->nullable()->after('paper_submission_id');
            $table->string('comment')->nullable()->after('paper_submission_id');
            $table->integer('review_type_id')->nullable()->default(0)->after('paper_submission_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_reviews', function (Blueprint $table) {
            $table->dropColumn('file');
            $table->dropColumn('comment');
            $table->dropColumn('review_type_id');
        });
    }
};
