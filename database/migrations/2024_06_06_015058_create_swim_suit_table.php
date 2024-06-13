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
        Schema::create('swim_suit', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_number');
            $table->integer('total');
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
        Schema::dropIfExists('swim_suit');
    }
};
