<?php

namespace App\Http\Controllers\Respondent;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function checkExist(Request $request)
    {

        if (!$request->token) {
            $token = Str::random(100);
            return response()->json(['token' => $token, 'status' => 'new'], 200);
        }
        $respondent = App\Respondent::where('token', $request->token)->with('step','area_origins','area_destinations','travel_details')->first();
        if ($respondent) {
            return response()->json([
                'respondent_id' => $respondent->id,
                'token' => $request->token,
                'area_origins' => $respondent->area_origins->pluck('area_id'),
                'area_destinations' => $respondent->area_destinations->pluck('area_id'),
                'transportation_modes' => $respondent->travel_details->pluck('transportation_mode_id'),
                'trip_combination' => $respondent->trip_combination,
                'step' => $respondent->step->description,
                'status' => 'exist'], 200);
        }
        $token = $request->token;
        return response()->json(['token' => $token, 'status' => 'new'], 200);

    }
}
