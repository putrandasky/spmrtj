<?php

namespace App\Http\Controllers\Respondent;

use App;
use App\Http\Controllers\Controller;

class SandboxController extends Controller
{
    public function index()
    {
        // $data['sp_count'] = App\SurveyPreference::where('description', '!=', 'Park Ride Common')->withCount('survey_preference_respondents')->get();
        // $data['sp_count_1'] = App\SurveyPreferenceRespondent::where('survey_preference_id',7)->get();

        // $data['sp_count_3'] = App\Respondent::whereHas('survey_preference_respondents', function ($query) {
        //             $query->where('survey_preference_id',7);
        //       })
        //       ->whereHas('travel_details', function ($query) {
        //                   $query->where('transportation_mode_id',3);
        //             })
        //       ->count();
        // $data['sp_count_4'] = App\Respondent::whereHas('survey_preference_respondents', function ($query) {
        //             $query->where('survey_preference_id',7);
        //       })
        //       ->whereHas('travel_details', function ($query) {
        //                   $query->where('transportation_mode_id',4);
        //             })
        //       ->count();
        // $data['sp_count_5'] = App\Respondent::whereHas('survey_preference_respondents', function ($query) {
        //             $query->where('survey_preference_id',7);
        //       })
        //       ->whereHas('travel_details', function ($query) {
        //                   $query->where('transportation_mode_id',5);
        //             })
        //       ->count();
        // $data['sp_count_6'] = App\Respondent::whereHas('survey_preference_respondents', function ($query) {
        //             $query->where('survey_preference_id',7);
        //       })
        //       ->whereHas('travel_details', function ($query) {
        //                   $query->where('transportation_mode_id',6);
        //             })
        //       ->count();

        // $data = App\SpParkRidePrimaryCar::whereHas('respondent', function ($query) {
        //             $query->where('step_id','>',3);
        //       })->
        //       whereDoesntHave('respondent.travel_details', function ($query) {
        //         $query->where('transportation_mode_id',17);
        //   })
        //       ->with([
        //           'cost_preference',
        //     'respondent' => function ($query) {
        //         $query->select('id','travel_model');
        //     },
        //     'respondent.travel_details' => function ($query) {
        //         $query->select('id','respondent_id','transportation_mode_id');

        //     },
        // ])
        // // ->where('cost_preference_id',28)
        // ->where('respond',1)
        // ->select('id', 'respondent_id','cost_preference_id')->count();
        $data = App\Respondent::join('sp_cycles','respondents.id','=','sp_cycles.respondent_id')
        ->where([
            'question_id' => 1,
            'sp_cycle_choice_id' => 1,
        ])->count();
        // $data = App\SpCycle::where([
        // 'question_id' => 1,
        // 'sp_cycle_choice_id' => 1
        // ])->
        // join('respondents','sp_cycles.respondent_id','=','respondents.id')
        // ->count();
        // $data = App\SpCycle::where([
        // 'question_id' => 1,
        // 'sp_cycle_choice_id' => 1
        // ])->
        // with('respondent')
        // ->get();

        return $data;
    }
}
