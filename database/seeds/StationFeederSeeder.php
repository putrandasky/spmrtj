<?php

use Illuminate\Database\Seeder;
use App\StationFeeder;
class StationFeederSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::get("database/data/point_feeder_2.json");
        $datas = json_decode($files);
        foreach ($datas as $data) {
            $stationFeeder = new StationFeeder();
            $stationFeeder->id = (float)$data->id;
            $stationFeeder->lat = (float)$data->lat;
             $stationFeeder->lng = (float)$data->lng;
              $stationFeeder->name = $data->name;
              $stationFeeder->object = $data->object;
            $stationFeeder->save();
        }
    }
}
