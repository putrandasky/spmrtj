<?php

use Illuminate\Database\Seeder;
use App\Coverage;

class CoverageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::get("database/data/geocode_area_5.json");
        $datas = json_decode($files);
        foreach ($datas as $data) {
            $coverage = new Coverage();
            $coverage->lat = (float)$data->lat;
             $coverage->lng = (float)$data->lng;
              $coverage->area_id = $data->area_id;
            $coverage->save();
        }
    }
}
