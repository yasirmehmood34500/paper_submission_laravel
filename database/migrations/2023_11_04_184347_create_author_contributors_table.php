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
        Schema::create('author_contributors', function (Blueprint $table) {
            $table->id();
            $table->integer('author_contributor_rule_id')->nullable()->default(0);
            $table->integer('paper_submission_id')->nullable()->default(0);
            $table->string('name',100)->nullable()->default('');
            $table->string('email',200)->nullable()->default('');
            $table->string('oric_id',500)->nullable()->default('');
            $table->string('affiliation',500)->nullable()->default('');
            $table->string('bio_statement',500)->nullable()->default('');
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_contributors');
    }
};
