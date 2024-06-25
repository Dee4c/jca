<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemiFinalistsTable extends Migration
{
    public function up()
    {
        Schema::create('semi_finalists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_number');
            $table->string('candidate_name');
            $table->integer('overall_rank');
            $table->timestamps();

            $table->foreign('candidate_number')->references('id')->on('candidates');
        });
    }

    public function down()
    {
        Schema::dropIfExists('semi_finalists');
    }
}
