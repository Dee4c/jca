<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('swim_suit_or', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_number');
            $table->integer('overall_rank')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('candidate_number')->references('id')->on('candidates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swim_suit_or');
    }
};
