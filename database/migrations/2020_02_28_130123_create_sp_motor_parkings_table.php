<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpMotorParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_motor_parkings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('respondent_id');
            $table->integer('cost_preference_id');
            $table->integer('time_preference_id');
            $table->string('respond');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sp_motor_parkings');
    }
}
