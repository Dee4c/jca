<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('candidateNumber')->unique();
            $table->string('candidateName');
            $table->integer('age');
            $table->string('candidateAddress');
            $table->integer('waist'); // Add waist column
            $table->integer('hips'); // Add hips column
            $table->integer('chest'); // Add chest column
            $table->string('candidateImage')->nullable(); // Add candidateImage column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
