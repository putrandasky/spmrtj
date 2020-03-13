<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('respondent_id');
            $table->integer('travel_mode_id');
            $table->integer('travel_duration');
            $table->integer('travel_cost');
            $table->integer('parking_cost');
            $table->integer('parking_type_id');
            $table->integer('waiting_duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travel_details');
    }
}
