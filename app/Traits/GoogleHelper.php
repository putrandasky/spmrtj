<?php
namespace App\Traits;

use App;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

trait GoogleHelper
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $apiKey;
    private $base_uri = ['base_uri' => 'https://maps.googleapis.com/maps/api/'];
    private $lrtVelocity = 40;

    public function distanceInGoogle($lat1, $lng1, $lat2, $lng2)
    {
        $this->apiKey = \Config::get('app.gmapsApiKey');

        $origins = $lat1 . "," . $lng1;
        $destination = $lat2 . "," . $lng2;
        $client = new Client($this->base_uri);

        $request = $client->request('GET', "distancematrix/json?avoid=tolls&departure_time=1595289600&traffic_model=pessimistic&origins={$origins}&destinations={$destination}&language=id&key={$this->apiKey}");
        $response = json_decode($request->getBody()->getContents(), true);
        return $response;

    }

    public function shortestStation($lat, $lng)
    {
        $stations = App\Station::all();
        for ($i = 0; $i < count($stations); $i++) {
            if ($stations[$i]['object'] !== 'station') {
                continue;
            }
            $data[$i]['id'] = $stations[$i]['id'];
            $data[$i]['name'] = $stations[$i]['name'];
            $data[$i]['lng'] = $stations[$i]['lng'];
            $data[$i]['lat'] = $stations[$i]['lat'];
            $data[$i]['distance'] = $this->distance($lat, $lng, $stations[$i]['lat'], $stations[$i]['lng'], "K");
            // $data[$i]['distance'] = $this->distanceInGoogle($lat,$lng,   $stations[$i]['lat'],$stations[$i]['lng']);
        }
        $collection = collect($data);
        $data = $collection->where('distance', $collection->min('distance'))->first();
        return $data;
    }
    public function shortestParkRidePoint($lat, $lng)
    {
        $park_ride_point = App\ParkRidePoint::all();
        for ($i = 0; $i < count($park_ride_point); $i++) {
            $data[$i]['id'] = $park_ride_point[$i]['id'];
            $data[$i]['description'] = $park_ride_point[$i]['description'];
            $data[$i]['lng'] = $park_ride_point[$i]['lng'];
            $data[$i]['lat'] = $park_ride_point[$i]['lat'];
            $data[$i]['distance'] = $this->distance($lat, $lng, $park_ride_point[$i]['lat'], $park_ride_point[$i]['lng'], "K");
            // $data[$i]['distance'] = $this->distanceInGoogle($lat,$lng,   $stations[$i]['lat'],$stations[$i]['lng']);
        }
        $collection = collect($data);
        $data = $collection->where('distance', $collection->min('distance'))->first();
        return $data;
    }
    public function shortestFeeder($lat, $lng)
    {
        $stations = App\StationFeeder::all();
        for ($i = 0; $i < count($stations); $i++) {
            if ($stations[$i]['object'] !== 'feeder') {
                continue;
            }
            $data[$i]['id'] = $stations[$i]['id'];
            $data[$i]['name'] = $stations[$i]['name'];
            $data[$i]['lng'] = $stations[$i]['lng'];
            $data[$i]['lat'] = $stations[$i]['lat'];
            $data[$i]['distance'] = $this->distance($lat, $lng, $stations[$i]['lat'], $stations[$i]['lng'], "K");
            // $data[$i]['distance'] = $this->distanceInGoogle($lat,$lng,   $stations[$i]['lat'],$stations[$i]['lng']);
        }
        $collection = collect($data);
        $data = $collection->where('distance', $collection->min('distance'))->first();
        return $data;
    }
    public function getGeometry($place)
    {
        $this->apiKey = \Config::get('app.gmapsApiKey');
        $client = new Client($this->base_uri);
        $request = $client->request('GET', "place/findplacefromtext/json?&input={$place}&inputtype=textquery&fields=formatted_address,geometry&key={$this->apiKey}");
        $response = json_decode($request->getBody()->getContents(), true);
        return $response['candidates'][0]['geometry']['location'];
    }
    public function getGeocode($place_id)
    {
        $this->apiKey = \Config::get('app.gmapsApiKey');
        $client = new Client($this->base_uri);
        $request = $client->request('GET', "geocode/json?place_id={$place_id}&key={$this->apiKey}");
        $response = json_decode($request->getBody()->getContents(), true);
        return $response['results'][0]['geometry']['location'];
        // return $response['results'][0]['geometry']['location'];
    }

}
