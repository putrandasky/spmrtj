<?php

use App\WayPoint;
use Illuminate\Database\Seeder;

class WayPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::get("database/data/waypoints.json");
        $datas = json_decode($files);
        foreach ($datas as $data) {
            $way_point = new WayPoint();
            $way_point->source_id = (float) $data->source_id;
            $way_point->after_id = (float) $data->after_id;
            $way_point->save();
        }
    }
}
