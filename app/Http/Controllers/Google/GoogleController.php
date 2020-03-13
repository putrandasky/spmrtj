<?php

namespace App\Http\Controllers\Google;

use App;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    private $base_uri = ['base_uri' => 'https://maps.googleapis.com/maps/api/'];

    public function autocomplete($input)
    {
        $apiKey = \Config::get('app.gmapsApiKey');

        $client = new Client($this->base_uri);
        $request = $client->request('GET', "place/autocomplete/json?input={$input}&language=id&components=country:id&key={$apiKey}");
        $response = json_decode($request->getBody()->getContents(), true);
        return $response;
    }
    public function geocoding(Request $request)
    {
        $apiKey = \Config::get('app.gmapsApiKey');

        $keys = collect($request)->keys();
        // $keys = $collection->keys();
        $client = new Client($this->base_uri);
        $data = [];
        $request = $client->request('GET', "geocode/json?{$keys[0]}={$request->input($keys[0])}&language=id&key={$apiKey}");
        $response = json_decode($request->getBody()->getContents(), true);
        $data[0] = $response['results'][0];
        return $data;

    }
    public function area()
    {
        $data = App\Area::with('coverages')->get();
        return $data;
    }
}
