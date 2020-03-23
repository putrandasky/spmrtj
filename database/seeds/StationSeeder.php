<?php

use Illuminate\Database\Seeder;
use App\Station;
class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::get("database/data/feeder.json");
        $datas = json_decode($files);
        foreach ($datas as $data) {
            $station = new Station();
            $station->lat = (float)$data->lat;
             $station->lng = (float)$data->lng;
              $station->name = $data->name;
              $station->object = $data->object;
            $station->save();
        }
    }
}
