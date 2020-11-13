<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessExport;

class ExportController extends Controller
{
    public function export()
    {
        // return (new RespondentsExport)->download('respondents.xlsx');

        // setlocale(LC_TIME, 'id');
        // $dateTime = Carbon::now()->toDateTimeString();
        //   return Excel::download(new RespondentsExport, "State Preference Survey Exported - {$dateTime}.xlsx");

        // return Excel::download(new RespondentsCommentExport, "Respondent Comment.xlsx");
        // return Excel::download(new RespondentsCoordinateExport, "Respondent Coordinate.xlsx");
        // return Excel::download(new BaseExport(), "Survei Preference MRTJ Exported - {$dateTime}.xlsx");
        // $filename = "Survei Preference MRTJ Exported - {$dateTime}.xlsx";
        // Excel::store(new BaseExport(), $filename);

        // Mail::to('radityo.putra@gmail.com')->send(new SendExportData($filename));

        dispatch(new ProcessExport('ParkRidePoint'));
        // dispatch(new ProcessExport('SosioConcern'));
        // dispatch(new ProcessExport('TripConcern'));
        // dispatch(new ProcessExport('PersonalConcern'));
        // dispatch(new ProcessExport('AdditionalConcern'));
        // dispatch(new ProcessExport('SpConcern_1'));
        // dispatch(new ProcessExport('SpConcern_2'));
        // dispatch(new ProcessExport('SpConcern_3'));
        // dispatch(new ProcessExport('SpConcern_4'));
        // dispatch(new ProcessExport('SpConcern_5'));
        // dispatch(new ProcessExport('SpConcern_7'));
        // dispatch(new ProcessExport('SpConcern_9'));
        // dispatch(new ProcessExport('SpConcern_10'));
        // dispatch(new ProcessExport('SpConcern_11'));
        // dispatch(new ProcessExport('SpConcern_12'));
        // dispatch(new ProcessExport('simulationMrt'));
        // dispatch(new ProcessExport('simulationFeederAndMrt'));

    }
}
