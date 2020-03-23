<?php
namespace App\Traits;

use App;
use Carbon;
use Taniko\Dijkstra\Graph;

trait RouteHelper
{
    private $base_uri = ['base_uri' => 'https://maps.googleapis.com/maps/api/'];
    private $lrtVelocity = 40;// km/jam

    public function line()
    {

        $station = App\Station::get();

        return $station;
    }
    public function stationName($id)
    {

        $station = App\Station::find($id)->name;

        return $station;
    }
    public function path($place_origin, $place_destination)
    {

        $geometry_origin = $this->getGeocode($place_origin);
        $geometry_destination = $this->getGeocode($place_destination);
        $station_origin = $this->shortestStation($geometry_origin['lat'], $geometry_origin['lng']);
        $station_destination = $this->shortestStation($geometry_destination['lat'], $geometry_destination['lng']);
        $Long = (float) $station_origin['lng'];
        $Lat = (float) $station_origin['lat'];
        $station_corridor = $station_origin['corridor'];
        $station_id = $station_origin['id'];

        $Long_destination = (float) $station_destination['lng'];
        $Lat_destination = (float) $station_destination['lat'];
        $station_destination_corridor = $station_destination['corridor'];
        $station_destination_id = $station_destination['id'];
        if ($station_id == $station_destination_id) {
            return null;
        }
        $i = 0;
        $originDistanceGoogle = $this->distanceInGoogle($geometry_origin['lat'], $geometry_origin['lng'], $station_origin['lat'], $station_origin['lng']);
        $destinationDistanceGoogle = $this->distanceInGoogle($geometry_destination['lat'], $geometry_destination['lng'], $station_destination['lat'], $station_destination['lng']);
        $googleData = $this->distanceInGoogle($geometry_origin['lat'], $geometry_origin['lng'], $geometry_destination['lat'], $geometry_destination['lng']);

        $data['google']['distance'] = $googleData['rows'][0]['elements'][0]['distance']['text'];
        $data['google']['distance_value'] = $googleData['rows'][0]['elements'][0]['distance']['value'];
        $data['google']['duration'] = $googleData['rows'][0]['elements'][0]['duration']['text'];
        $data['google']['duration_seconds'] = $googleData['rows'][0]['elements'][0]['duration']['value'];

        $data['origin']['id'] = "Origin";
        $data['origin']['position']['lat'] = (float) $geometry_origin['lat'];
        $data['origin']['position']['lng'] = (float) $geometry_origin['lng'];
        $data['origin']['title'] = "Posisi Anda";

        $data['origin_station']['id'] = $station_origin['id'];
        $data['origin_station']['title'] = $station_origin['name'];
        $data['origin_station']['position']['lat'] = (float) $station_origin['lat'];
        $data['origin_station']['position']['lng'] = (float) $station_origin['lng'];
        $data['origin_station']['distance'] = $originDistanceGoogle['rows'][0]['elements'][0]['distance']['text'];
        $data['origin_station']['distance_value'] = $originDistanceGoogle['rows'][0]['elements'][0]['distance']['value'];
        $data['origin_station']['duration'] = $originDistanceGoogle['rows'][0]['elements'][0]['duration']['text'];
        $data['origin_station']['duration_seconds'] = $originDistanceGoogle['rows'][0]['elements'][0]['duration']['value'];

        $data['destination']['id'] = "Destination";
        $data['destination']['position']['lat'] = (float) $geometry_destination['lat'];
        $data['destination']['position']['lng'] = (float) $geometry_destination['lng'];
        $data['destination']['title'] = "Tujuan Anda";

        $data['destination_station']['id'] = $station_destination['id'];
        $data['destination_station']['title'] = $station_destination['name'];
        $data['destination_station']['position']['lat'] = (float) $station_destination['lat'];
        $data['destination_station']['position']['lng'] = (float) $station_destination['lng'];
        $data['destination_station']['distance'] = $destinationDistanceGoogle['rows'][0]['elements'][0]['distance']['text'];
        $data['destination_station']['distance_value'] = $destinationDistanceGoogle['rows'][0]['elements'][0]['distance']['value'];
        $data['destination_station']['duration'] = $destinationDistanceGoogle['rows'][0]['elements'][0]['duration']['text'];
        $data['destination_station']['duration_seconds'] = $destinationDistanceGoogle['rows'][0]['elements'][0]['duration']['value'];

        $path = $this->dijkstra($station_origin['name'], $station_destination['name']);
        $lines = $this->line();
        // return $stations;
        $distance = round($path['distance'], 2);
        $data['lrt']['distance'] = $distance . " km";
        $data['lrt']['distance_only'] = $distance;

        // foreach ($path['route'] as $name) {
        //     $data['lrt']['path'][$i] = $lines->where('name', $name)->first();
        //     $i++;
        // }
        // $a = 0;
        // foreach ($data['lrt']['path'] as $path) {
        //     if ($path->object !== "Station") {
        //         continue;
        //     }
        //     $data['lrt']['stations'][$a]['id'] = $path->id;
        //     $data['lrt']['stations'][$a]['name'] = $path->name;
        //     $a++;
        // }
        // for ($a = 0; $a < count($data['lrt']['path']); $a++) {
        //     if ($data['lrt']['path'][$a]['object'] !== "Station") {
        //         continue;
        //     }
        //     $data['lrt']['stations'][]['name'] = $data['lrt']['path'][$a]['name'];
        // }
        foreach ($path['route'] as $name) {
            $line = $lines->where('name', $name)->first();
            $data['lrt']['path'][$i]['id'] = $line->id;
            $data['lrt']['path'][$i]['lat'] = (float) $line->lat;
            $data['lrt']['path'][$i]['lng'] = (float) $line->lng;
            $data['lrt']['path'][$i]['name'] = $line->name;
            $data['lrt']['path'][$i]['object'] = $line->object;
            $data['lrt']['path'][$i]['corridor'] = $line->corridor;
            $i++;
        }
        $b = 0;
        for ($a = 0; $a < count($data['lrt']['path']); $a++) {
            if ($data['lrt']['path'][$a]['object'] !== "Station") {
                continue;
            }
            $data['lrt']['stations'][$b]['name'] = $data['lrt']['path'][$a]['name'];
            $data['lrt']['stations'][$b]['id'] = $data['lrt']['path'][$a]['id'];
            $b++;
        }

        $duration = round(3600 * ($distance / $this->lrtVelocity));
        $data['lrt']['duration_in_seconds'] = $duration;
        $data['lrt']['duration'] = Carbon\CarbonInterval::seconds($duration)->cascade()->locale('id')->forHumans();
        $duration_with_lrt = $originDistanceGoogle['rows'][0]['elements'][0]['duration']['value'] + $destinationDistanceGoogle['rows'][0]
            ['elements'][0]['duration']['value'] + $duration;
        $duration_difference = Carbon\CarbonInterval::seconds(abs($duration_with_lrt - $googleData['rows'][0]['elements'][0]['duration']['value']))->cascade()->locale('id')->forHumans();

        $data['summary']['duration_with_lrt'] = Carbon\CarbonInterval::seconds($duration_with_lrt)->cascade()->locale('id')->forHumans();
        $data['summary']['duration_with_lrt_seconds'] = $duration_with_lrt;
        $data['summary']['the_better'] =
        $duration_with_lrt > $googleData['rows'][0]['elements'][0]['duration']['value'] ?
        "Moda transportasi biasa anda lebih cepat {$duration_difference}" :
        "LRT lebih cepat {$duration_difference}";

        return $data;
    }
    public function dijkstra($origin, $destination,$class)
    {
        if ($class == 'WayPoint') {
         $nodes = App\WayPoint::with('source', 'after')->get();
        }
        if ($class == 'WayPointFeeder') {
         $nodes = App\WayPointFeeder::with('source', 'after')->get();
        }


        $network = Graph::create();
        foreach ($nodes as $v) {
            $network->add($v->source->name, $v->after->name, $this->distance($v->source->lat, $v->source->lng, $v->after->lat, $v->after->lng, "K"));
        }

        $data['route'] = $network->search($origin, $destination);
        $data['distance'] = $network->cost($data['route']);
        return $data;

    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}
