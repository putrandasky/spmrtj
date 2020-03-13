<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpParkRidePrimaryCommonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sp_park_ride_primary_commons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('respondent_id');
            $table->integer('question_id');
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
        Schema::dropIfExists('sp_park_ride_primary_commons');
    }
}
