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
        Schema::create('admin_decisions', function (Blueprint $table) {
            $table->id();
            $table->integer('paper_submission_id')->nullable();
            $table->integer('review_type_id')->nullable()->default(0);
            $table->string('comment', 1000)->nullable();
            $table->string('file', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_decisions');
    }
};
