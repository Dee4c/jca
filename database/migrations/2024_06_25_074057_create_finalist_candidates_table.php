<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalistCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('finalist_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_number');
            $table->string('candidate_name');
            $table->integer('overall_rank');
            $table->timestamps();

            // Add foreign key constraint to candidate_number referencing candidates table
            $table->foreign('candidate_number')->references('id')->on('candidates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('finalist_candidates', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['candidate_number']);
        });

        Schema::dropIfExists('finalist_candidates');
    }
}
