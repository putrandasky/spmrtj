<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStationFeedersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_feeders', function (Blueprint $table) {
            $table->increments('id');
            $table->double('lat', 10, 6);
            $table->double('lng', 10, 6);
            $table->string('name');
            $table->string('object');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_feeders');
    }
}
