<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemiFinalScoresTable extends Migration
{
    public function up()
    {
        Schema::create('semi_final_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('candidate_number');
            $table->integer('beauty_of_face');
            $table->integer('poise_grace_projection');
            $table->integer('composure');
            $table->decimal('total', 8, 2);
            $table->integer('rank');
            $table->string('judge_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('semi_final_scores');
    }
}
