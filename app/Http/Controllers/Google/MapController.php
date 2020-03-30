<?php

namespace App\Http\Controllers\Google;

use App;
use App\Http\Controllers\Controller;
use App\Traits\GoogleHelper;
use App\Traits\RouteHelper;
use Carbon;
use Illuminate\Http\Request;
use Taniko\Dijkstra\Graph;

class MapController extends Controller
{
    use GoogleHelper;
    // use RouteHelper;
    private $apiKey;
    private $base_uri = ['base_uri' => 'https://maps.googleapis.com/maps/api/'];
    private $mrtVelocity = 35;
    private $feederVelocity = 28;

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

    public function mapData()
    {

        $data['station'] = $this->station();
        $data['feeder'] = $this->feeder();
        $data['line_feeder'] = $this->waypointFeeder();
        $data['line_station'] = $this->waypoint();
        $data['area'] = $this->area();

        return $data;
    }
    public function area()
    {
        $data = App\Area::with('coverages')->get();
        return $data;
    }
    public function station()
    {

        $station = App\Station::where('object', 'station')->get();

        return $station;
    }
    public function feeder()
    {

        $feeder = App\StationFeeder::where('object', 'feeder')->get();

        return $feeder;
    }
    public function line()
    {

        $station = App\Station::get();

        return $station;
    }
    public function lineFeeder()
    {

        $station = App\StationFeeder::get();

        return $station;
    }
    public function waypoint()
    {

        $station = App\WayPoint::with('source', 'after')
            ->where('after_id', '<>', 0)
            ->where('source_id', '<>', 0)
            ->get();

        for ($i = 0; $i < count($station); $i++) {

            $data[$i]['id'] = $i + 1;
            $data[$i]['path'][0]['lat'] = (float) $station[$i]['source']['lat'];
            $data[$i]['path'][0]['lng'] = (float) $station[$i]['source']['lng'];
            $data[$i]['path'][1]['lat'] = (float) $station[$i]['after']['lat'];
            $data[$i]['path'][1]['lng'] = (float) $station[$i]['after']['lng'];
        }

        return $data;
    }
    public function waypointFeeder()
    {

        $station = App\WayPointFeeder::with('source', 'after')
            ->where('after_id', '<>', 0)
            ->where('source_id', '<>', 0)
            ->get();

        for ($i = 0; $i < count($station); $i++) {

            $data[$i]['id'] = $i + 1;
            $data[$i]['path'][0]['lat'] = (float) $station[$i]['source']['lat'];
            $data[$i]['path'][0]['lng'] = (float) $station[$i]['source']['lng'];
            $data[$i]['path'][1]['lat'] = (float) $station[$i]['after']['lat'];
            $data[$i]['path'][1]['lng'] = (float) $station[$i]['after']['lng'];
        }

        return $data;
    }

    public function routePathWithFeeder(Request $request)
    {
        $googleData = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $request->place_destination['lat'], $request->place_destination['lng']);
        $data['google'] = $this->googleDistanceDurationData($googleData);
        $station_origin = $this->shortestStation($request->place_origin['lat'], $request->place_origin['lng']);
        $station_destination = $this->shortestStation($request->place_destination['lat'], $request->place_destination['lng']);

        $data['origin'] = $this->position("Origin", "Posisi Anda", $request->place_origin['lat'], $request->place_origin['lng']);
        $data['destination'] = $this->position("Destination", "Tujuan Anda", $request->place_destination['lat'], $request->place_destination['lng']);
        $data['mrt']['path'] = array();
        $data['feeder']['path'] = array();


        if (collect($request->area_origin)->contains(5)) {
            //check if O in Feeder Area
            if (collect($request->area_destination)->contains(5)) {
                // Check if D in Feeder ARea
                $feeder_origin = $this->shortestFeeder($request->place_origin['lat'], $request->place_origin['lng']);
                $feeder_destination = $this->shortestFeeder($request->place_destination['lat'], $request->place_destination['lng']);
                $data['feeder'] = $this->routePath($feeder_origin['name'], $feeder_destination['name'], 'WayPointFeeder', $this->lineFeeder(), $this->feederVelocity);

                $originDistanceGoogle = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $feeder_origin['lat'], $feeder_origin['lng']);
                $destinationDistanceGoogle = $this->distanceInGoogle($request->place_destination['lat'], $request->place_destination['lng'], $feeder_destination['lat'], $feeder_destination['lng']);

                $data['origin_station'] = $this->nearestStationData('Origin_Station', $feeder_origin, $originDistanceGoogle);
                $data['destination_station'] = $this->nearestStationData('Destination_Station', $feeder_destination, $destinationDistanceGoogle);

                $duration_with_feeder = $data['origin_station']['duration_seconds'] + $data['destination_station']['duration_seconds'] + $data['feeder']['duration_seconds'];
                $duration_difference = Carbon\CarbonInterval::seconds(abs($duration_with_feeder - $data['google']['duration_seconds']))->cascade()->locale('id')->forHumans();


                $data['summary']['duration_with_feeder'] = Carbon\CarbonInterval::seconds($duration_with_feeder)->cascade()->locale('id')->forHumans();
                $data['summary']['duration_with_feeder_seconds'] = $duration_with_feeder;
                $data['summary']['the_better'] =
                $duration_with_feeder > $data['google']['duration_seconds'] ?
                "Moda transportasi biasa anda lebih cepat {$duration_difference}" :
                "Menggunakan Feeder lebih cepat {$duration_difference}";

                return $data;

            } else {
                //if D in Other Area
                if ($station_origin['id'] !== $station_destination['id']) {
                    //if path can be simmulated in MRT Line
                    $feeder_origin = $this->shortestFeeder($request->place_origin['lat'], $request->place_origin['lng']);
                    $feeder_destination = $this->shortestFeeder($station_origin['lat'], $station_origin['lng']);
                    $data['feeder'] = $this->routePath($feeder_origin['name'], $feeder_destination['name'], 'WayPointFeeder', $this->lineFeeder(), $this->feederVelocity);
                    $data['mrt'] = $this->routePath($station_origin['name'], $station_destination['name'], 'WayPoint', $this->line(), $this->mrtVelocity);
                    $b = 0;
                    for ($a = 0; $a < count($data['mrt']['path']); $a++) {
                        if ($data['mrt']['path'][$a]['object'] !== "station") {
                            continue;
                        }
                        $data['mrt']['stations'][$b]['name'] = $data['mrt']['path'][$a]['name'];
                        $data['mrt']['stations'][$b]['id'] = $data['mrt']['path'][$a]['id'];
                        $b++;
                    }
                    $originDistanceGoogle = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $feeder_origin['lat'], $feeder_origin['lng']);
                    $destinationDistanceGoogle = $this->distanceInGoogle($request->place_destination['lat'], $request->place_destination['lng'], $station_destination['lat'], $station_destination['lng']);

                    $data['origin_station'] = $this->nearestStationData('Origin_Station', $feeder_origin, $originDistanceGoogle);
                    $data['destination_station'] = $this->nearestStationData('Destination_Station', $station_destination, $destinationDistanceGoogle);

                    $duration_with_mrt_and_feeder = $data['origin_station']['duration_seconds'] + $data['destination_station']['duration_seconds'] + $data['feeder']['duration_seconds'] + $data['mrt']['duration_seconds'];
                    $duration_difference = Carbon\CarbonInterval::seconds(abs($duration_with_mrt_and_feeder - $data['google']['duration_seconds']))->cascade()->locale('id')->forHumans();
                    $data['summary']['duration_with_mrt_and_feeder'] = Carbon\CarbonInterval::seconds($duration_with_mrt_and_feeder)->cascade()->locale('id')->forHumans();
                    $data['summary']['duration_with_mrt_and_feeder_seconds'] = $duration_with_mrt_and_feeder;
                    $data['summary']['the_better'] =
                    $duration_with_mrt_and_feeder > $data['google']['duration_seconds'] ?
                    "Moda transportasi biasa anda lebih cepat {$duration_difference}" :
                    "Menggunakan Feeder dan MRT lebih cepat {$duration_difference}";

                    if ($data['google']['distance_value'] < $data['destination_station']['distance_value'] || $data['google']['distance_value'] < $data['origin_station']['distance_value']) {

                        unset($data['origin_station']);
                        unset($data['destination_station']);
                        unset($data['mrt']);
                        unset($data['feeder']);
                        $data['mrt']['path'] = array();
                        $data['feeder']['path'] = array();
                        $data['summary'];

                    }
                    return $data;
                } else {
                    //if path cannot be simmulated in MRT Line
                    return $data;
                }
            }

        } else {
            //if O in other Feeder Area
            if ($station_origin['id'] !== $station_destination['id']) {
                //if path can be simmulated in MRT Line
                $data['mrt'] = $this->routePath($station_origin['name'], $station_destination['name'], 'WayPoint', $this->line(), $this->mrtVelocity);
                $b = 0;
                for ($a = 0; $a < count($data['mrt']['path']); $a++) {
                    if ($data['mrt']['path'][$a]['object'] !== "station") {
                        continue;
                    }
                    $data['mrt']['stations'][$b]['name'] = $data['mrt']['path'][$a]['name'];
                    $data['mrt']['stations'][$b]['id'] = $data['mrt']['path'][$a]['id'];
                    $b++;
                }
                $originDistanceGoogle = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $station_origin['lat'], $station_origin['lng']);
                $destinationDistanceGoogle = $this->distanceInGoogle($request->place_destination['lat'], $request->place_destination['lng'], $station_destination['lat'], $station_destination['lng']);

                $data['origin_station'] = $this->nearestStationData('Origin_Station', $station_origin, $originDistanceGoogle);
                $data['destination_station'] = $this->nearestStationData('Destination_Station', $station_destination, $destinationDistanceGoogle);

                $duration_with_mrt = $data['origin_station']['duration_seconds'] + $data['destination_station']['duration_seconds'] + $data['mrt']['duration_seconds'];
                $duration_difference = Carbon\CarbonInterval::seconds(abs($duration_with_mrt - $data['google']['duration_seconds']))->cascade()->locale('id')->forHumans();


                $data['summary']['duration_with_mrt'] = Carbon\CarbonInterval::seconds($duration_with_mrt)->cascade()->locale('id')->forHumans();
                $data['summary']['duration_with_mrt_seconds'] = $duration_with_mrt;
                $data['summary']['the_better'] =
                $duration_with_mrt > $data['google']['duration_seconds'] ?
                "Moda transportasi biasa anda lebih cepat {$duration_difference}" :
                "Menggunakan MRT lebih cepat {$duration_difference}";

                if ($data['google']['distance_value'] < $data['destination_station']['distance_value'] || $data['google']['distance_value'] < $data['origin_station']['distance_value']) {

                    unset($data['origin_station']);
                    unset($data['destination_station']);
                    unset($data['mrt']);
                    unset($data['summary']);
                    $data['mrt']['path'] = array();

                }
                return $data;
            } else {
                //if path cannot be simmulated in MRT Line
                return $data;
            }
        }

        $station_origin = $this->shortestStation($request->place_origin['lat'], $request->place_origin['lng']);
        $station_destination = $this->shortestStation($request->place_destination['lat'], $request->place_destination['lng']);
        $feeder_origin = $this->shortestFeeder($request->place_origin['lat'], $request->place_origin['lng']);
        $feeder_destination = $this->shortestFeeder($station_origin['lat'], $station_origin['lng']);

        $data['feeder'] = $this->routePath($feeder_origin['name'], $feeder_destination['name'], 'WayPointFeeder', $this->lineFeeder(), $this->feederVelocity);

        $originDistanceGoogle = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $feeder_origin['lat'], $feeder_origin['lng']);
        $destinationDistanceGoogle = $this->distanceInGoogle($request->place_destination['lat'], $request->place_destination['lng'], $station_destination['lat'], $station_destination['lng']);
        $googleData = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $request->place_destination['lat'], $request->place_destination['lng']);

        $data['google'] = $this->googleDistanceDurationData($googleData);
        $data['origin'] = $this->position("Origin", "Posisi Anda", $request->place_origin['lat'], $request->place_origin['lng']);
        $data['destination'] = $this->position("Destination", "Tujuan Anda", $request->place_destination['lat'], $request->place_destination['lng']);
        $data['mrt']['path'] = array();
        if ($station_origin['id'] !== $station_destination['id']) {

            $data['origin_station'] = $this->nearestStationData('Origin_Station', $station_origin, $originDistanceGoogle);
            $data['destination_station'] = $this->nearestStationData('Destination_Station', $station_destination, $destinationDistanceGoogle);
            $data['mrt'] = $this->routePath($station_origin['name'], $station_destination['name'], 'WayPoint', $this->line(), $this->mrtVelocity);
            $b = 0;
            for ($a = 0; $a < count($data['mrt']['path']); $a++) {
                if ($data['mrt']['path'][$a]['object'] !== "station") {
                    continue;
                }
                $data['mrt']['stations'][$b]['name'] = $data['mrt']['path'][$a]['name'];
                $data['mrt']['stations'][$b]['id'] = $data['mrt']['path'][$a]['id'];
                $b++;
            }
            $duration_with_mrt = $data['origin_station']['duration_seconds'] + $data['destination_station']['duration_seconds'] + $data['mrt']['duration_seconds'];
            $duration_difference = Carbon\CarbonInterval::seconds(abs($duration_with_mrt - $data['google']['duration_seconds']))->cascade()->locale('id')->forHumans();

            $data['summary']['duration_with_mrt'] = Carbon\CarbonInterval::seconds($duration_with_mrt)->cascade()->locale('id')->forHumans();
            $data['summary']['duration_with_mrt_seconds'] = $duration_with_mrt;
            $data['summary']['the_better'] =
            $duration_with_mrt > $data['google']['duration_seconds'] ?
            "Moda transportasi biasa anda lebih cepat {$duration_difference}" :
            "mrt lebih cepat {$duration_difference}";

            if ($data['google']['distance_value'] < $data['destination_station']['distance_value'] || $data['google']['distance_value'] < $data['origin_station']['distance_value']) {


                unset($data['origin_station']);
                unset($data['destination_station']);
                unset($data['mrt']);
                unset($data['summary']);
                $data['mrt']['path'] = array();
            }
        }
        return $data;
    }

    public function routeData(Request $request)
    {
        // dd(collect($request->area_origin)->contains(4));
        // return

        $station_origin = $this->shortestStation($request->place_origin['lat'], $request->place_origin['lng']);
        $station_destination = $this->shortestStation($request->place_destination['lat'], $request->place_destination['lng']);

        // if (collect($request->area_origin)->contains(5)) {

        //     if (collect($request->area_destination)->contains(5)) {

        //         if ($station_origin['id'] !== $station_destination['id']) {

        //         } else {

        //         }

        //     } else {
        //         if ($station_origin['id'] !== $station_destination['id']) {

        //         } else {

        //         }
        //     }

        // }

        $i = 0;
        $originDistanceGoogle = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $station_origin['lat'], $station_origin['lng']);
        $destinationDistanceGoogle = $this->distanceInGoogle($request->place_destination['lat'], $request->place_destination['lng'], $station_destination['lat'], $station_destination['lng']);
        $googleData = $this->distanceInGoogle($request->place_origin['lat'], $request->place_origin['lng'], $request->place_destination['lat'], $request->place_destination['lng']);

        $data['google']['distance'] = $googleData['rows'][0]['elements'][0]['distance']['text'];
        $data['google']['distance_value'] = $googleData['rows'][0]['elements'][0]['distance']['value'];
        $data['google']['duration'] = $googleData['rows'][0]['elements'][0]['duration']['text'];
        $data['google']['duration_seconds'] = $googleData['rows'][0]['elements'][0]['duration']['value'];
        $data['origin'] = $this->position("Origin", "Posisi Anda", $request->place_origin['lat'], $request->place_origin['lng']);
        $data['destination'] = $this->position("Destination", "Tujuan Anda", $request->place_destination['lat'], $request->place_destination['lng']);
        $data['mrt']['path'] = array();
        if ($station_origin['id'] !== $station_destination['id']) {

            $data['origin_station'] = $this->nearestStationData('Origin_Station', $station_origin, $originDistanceGoogle);
            $data['destination_station'] = $this->nearestStationData('Destination_Station', $station_destination, $destinationDistanceGoogle);

            $path = $this->dijkstra($station_origin['name'], $station_destination['name']);

            $lines = $this->line();

            $distance = round($path['distance'], 2);
            $data['mrt']['distance'] = $distance . " km";

            foreach ($path['route'] as $name) {
                $line = $lines->where('name', $name)->first();
                $data['mrt']['path'][$i]['id'] = $line->id;
                $data['mrt']['path'][$i]['lat'] = (float) $line->lat;
                $data['mrt']['path'][$i]['lng'] = (float) $line->lng;
                $data['mrt']['path'][$i]['name'] = $line->name;
                $data['mrt']['path'][$i]['object'] = $line->object;
                $i++;
            }

            $b = 0;
            for ($a = 0; $a < count($data['mrt']['path']); $a++) {
                if ($data['mrt']['path'][$a]['object'] !== "station") {
                    continue;
                }
                $data['mrt']['stations'][$b]['name'] = $data['mrt']['path'][$a]['name'];
                $data['mrt']['stations'][$b]['id'] = $data['mrt']['path'][$a]['id'];
                $b++;
            }

            $duration = round(3600 * $distance / $this->mrtVelocity);
            $data['mrt']['duration'] = Carbon\CarbonInterval::seconds($duration)->cascade()->locale('id')->forHumans();
            $duration_with_mrt = $originDistanceGoogle['rows'][0]['elements'][0]['duration']['value'] + $destinationDistanceGoogle['rows'][0]
                ['elements'][0]['duration']['value'] + $duration;
            $duration_difference = Carbon\CarbonInterval::seconds(abs($duration_with_mrt - $googleData['rows'][0]['elements'][0]['duration']['value']))->cascade()->locale('id')->forHumans();

            $data['summary']['duration_with_mrt'] = Carbon\CarbonInterval::seconds($duration_with_mrt)->cascade()->locale('id')->forHumans();
            $data['summary']['duration_with_mrt_seconds'] = $duration_with_mrt;
            $data['summary']['the_better'] =
            $duration_with_mrt > $googleData['rows'][0]['elements'][0]['duration']['value'] ?
            "Moda transportasi biasa anda lebih cepat {$duration_difference}" :
            "mrt lebih cepat {$duration_difference}";

            if ($data['google']['distance_value'] < $data['destination_station']['distance_value'] || $data['google']['distance_value'] < $data['origin_station']['distance_value']) {

                // if ($duration_with_mrt > $googleData['rows'][0]['elements'][0]['duration']['value']) {
                //     if ((($path['distance'] * 1000) +
                //     $data['destination_station']['distance_value'] +
                //     $data['origin_station']['distance_value'])
                //     > $data['google']['distance_value']) {
                unset($data['origin_station']);
                unset($data['destination_station']);
                unset($data['mrt']);
                unset($data['summary']);
                $data['mrt']['path'] = array();
                // }
                // }
            }
        }
        return $data;

    }
    public function position($id, $title, $lat, $lng)
    {
        $data['id'] = $id;
        $data['position']['lat'] = (float) $lat;
        $data['position']['lng'] = (float) $lng;
        $data['title'] = $title;
        return $data;
    }
    public function routePath($origin_name, $destination_name, $class, $lines_data, $velocity)
    {
        $path = $this->dijkstra($origin_name, $destination_name, $class);
        $lines = $lines_data;
        $distance = round($path['distance'], 2);
        $data['distance_value'] = round($path['distance'] * 1000, 0);
        $data['distance'] = $distance . " km";
        $i = 0;
        foreach ($path['route'] as $name) {
            $line = $lines->where('name', $name)->first();
            $data['path'][$i]['id'] = $line->id;
            $data['path'][$i]['lat'] = (float) $line->lat;
            $data['path'][$i]['lng'] = (float) $line->lng;
            $data['path'][$i]['name'] = $line->name;
            $data['path'][$i]['object'] = $line->object;
            $i++;
        }

        $duration = round(3600 * $distance / $velocity);
        $data['duration'] = Carbon\CarbonInterval::seconds($duration)->cascade()->locale('id')->forHumans();
        $data['duration_seconds'] = $duration;
        return $data;
    }
    public function googleDistanceDurationData($googleData)
    {
        $data['distance'] = $googleData['rows'][0]['elements'][0]['distance']['text'];
        $data['distance_value'] = $googleData['rows'][0]['elements'][0]['distance']['value'];
        $data['duration'] = $googleData['rows'][0]['elements'][0]['duration_in_traffic']['text'];
        $data['duration_seconds'] = $googleData['rows'][0]['elements'][0]['duration_in_traffic']['value'];
        return $data;
    }
    public function nearestStationData($id, $stationData, $googledata)
    {
        $data['id'] = $id;
        $data['title'] = $stationData['name'];
        $data['position']['lat'] = (float) $stationData['lat'];
        $data['position']['lng'] = (float) $stationData['lng'];
        $data['distance'] = $googledata['rows'][0]['elements'][0]['distance']['text'];
        $data['distance_value'] = $googledata['rows'][0]['elements'][0]['distance']['value'];
        $data['duration'] = $googledata['rows'][0]['elements'][0]['duration_in_traffic']['text'];
        $data['duration_seconds'] = $googledata['rows'][0]['elements'][0]['duration_in_traffic']['value'];
        return $data;
    }
}
