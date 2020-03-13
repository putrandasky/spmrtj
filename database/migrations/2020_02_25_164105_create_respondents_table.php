<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respondents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gender_id');
            $table->integer('age_id');
            $table->integer('education_id');
            $table->integer('job_id');
            $table->integer('income_id');
            $table->integer('expense_id');
            $table->integer('travel_expense_id');
            $table->integer('travel_guarantor_id');
            $table->integer('license_id');
            $table->integer('vehicle_id');
            $table->integer('travel_purpose_id');
            $table->integer('travel_mode_id');
            $table->integer('parking_guarantor_id');
            $table->integer('travel_frequence');
            $table->string('origin');
            $table->decimal('origin_lat');
            $table->decimal('origin_long');
            $table->string('destination');
            $table->decimal('destination_lat');
            $table->decimal('destination_long');
            $table->time('time_depart');
            $table->time('time_arrive');
            $table->integer('reason_using_transportation_id');
            $table->integer('is_using_mrt');
            $table->string('reason_is_using_mrt');
            $table->integer('mrt_improvement_id');
            $table->double('mrt_cost');
            $table->integer('work_place_parking_system_id');
            $table->integer('willingness_public_transport_trip_id');
            $table->integer('step_id');
            $table->integer('transportation_type');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('token');
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
        Schema::dropIfExists('respondents');
    }
}
