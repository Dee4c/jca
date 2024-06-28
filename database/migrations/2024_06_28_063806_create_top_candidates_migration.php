<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopCandidatesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_number');
            $table->string('candidate_name');
            $table->integer('overall_rank');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('candidate_number')->references('id')->on('candidates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('top_candidates', function (Blueprint $table) {
            $table->dropForeign(['candidate_number']);
        });

        Schema::dropIfExists('top_candidates');
    }
}
