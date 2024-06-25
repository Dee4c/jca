<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalist_candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_number');
            $table->string('candidate_name');
            $table->integer('overall_rank');
            $table->timestamps();

            // Drop the existing foreign key constraint (if exists)
            $table->dropForeign(['candidate_id']);

            // Add new foreign key constraint to candidate_number in top_candidates table
            $table->foreign('candidate_number')->references('candidate_number')->on('top_candidates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
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
