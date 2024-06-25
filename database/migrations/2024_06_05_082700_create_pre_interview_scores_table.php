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
        Schema::create('pre_interview_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_number');
            $table->integer('composure');
            $table->integer('poise_grace_projection');
            $table->decimal('total', 8, 2); // Adjust precision and scale as per your requirement
            $table->integer('rank');
            $table->string('judge_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_interview_scores');
    }
};
