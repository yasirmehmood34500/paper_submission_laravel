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
        Schema::create('paper_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->default(0);
            $table->string('paper_no',30)->nullable()->default('');
            $table->string('prefix',50)->nullable()->default('');
            $table->string('title',300)->nullable()->default('');
            $table->string('sub_title',300)->nullable()->default('');
            $table->text('abstract')->nullable();
            $table->string('keywords',500)->nullable()->default('');
            $table->tinyInteger('in_draft')->nullable()->default(1);
            $table->date('start_date')->nullable()->default(date('Y-m-d H:i'));
            $table->date('send_date')->nullable()->default(date('Y-m-d H:i'));
            $table->string('status',30)->nullable()->default("Pending");
            $table->tinyInteger('active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paper_submissions');
    }
};
