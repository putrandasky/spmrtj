<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpPedestriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_pedestrians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('respondent_id');
            $table->integer('question_id');
            $table->integer('sp_pedestrian_choice_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sp_pedestrians');
    }
}
