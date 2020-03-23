<?php
use App\WaypointFeeder;
use Illuminate\Database\Seeder;

class WaypointFeederSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = File::get("database/data/waypoint_feeder_2.json");
        $datas = json_decode($files);
        foreach ($datas as $data) {
            $way_point = new WaypointFeeder();
            $way_point->source_id = (float) $data->source_id;
            $way_point->after_id = (float) $data->after_id;
            $way_point->save();
        }
    }
}
