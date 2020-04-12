<?php

use App\ParkRidePoint;
use Illuminate\Database\Seeder;

class ParkRidePointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::get("database/data/ParkRidePoint.json");
        $datas = json_decode($files);
        foreach ($datas as $data) {
            $parkRidePoint = new ParkRidePoint();
            $parkRidePoint->id = (float) $data->id;
            $parkRidePoint->lat = (float) $data->lat;
            $parkRidePoint->lng = (float) $data->lng;
            $parkRidePoint->description = $data->description;
            $parkRidePoint->save();
        }
    }
}
