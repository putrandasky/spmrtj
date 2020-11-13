<?php

namespace App\Jobs;

use App\Exports\AdditionalConcern;
use App\Exports\ParkRidePointConcern;
use App\Exports\PersonalConcern;
use App\Exports\SimulationFeederAndMrtConcern;
use App\Exports\SimulationMrtConcern;
use App\Exports\SosioConcern;
use App\Exports\SpConcern;
use App\Exports\TripConcern;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ProcessExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $timeout = 3000;
    public $sheet;
    public function __construct($sheet)
    {
        $this->sheet = $sheet;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        setlocale(LC_TIME, 'id');
        $dateTime = Carbon::now()->toDateTimeString();
        // $filename = "Survei Preference MRTJ Exported - {$dateTime}.xlsx";
        if ($this->sheet == 'ParkRidePoint') {
            $filename = "Park Ride Point - Simulation MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new ParkRidePointConcern(), $filename);
        }
        if ($this->sheet == 'SosioConcern') {
            $filename = "Sosio - Simulation MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new SosioConcern(), $filename);
        }
        if ($this->sheet == 'TripConcern') {
            $filename = "Trip - Simulation MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new TripConcern(), $filename);
        }
        if ($this->sheet == 'AdditionalConcern') {
            $filename = "Additional - Simulation MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new AdditionalConcern(), $filename);
        }
        if ($this->sheet == 'PersonalConcern') {
            $filename = "Personal - Simulation MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new PersonalConcern(), $filename);
        }
        if ($this->sheet == 'simulationMrt') {
            $filename = "Simulation MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new SimulationMrtConcern(), $filename);
        }
        if ($this->sheet == 'simulationFeederAndMrt') {
            $filename = "Simulation Feeder And MRT - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new SimulationFeederAndMrtConcern(), $filename);
        }
        if ($this->sheet == 'SpConcern_1') {
            $filename = "Pedestrian - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(1), $filename);
        }
        if ($this->sheet == 'SpConcern_2') {
            $filename = "Cycle - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(2), $filename);
        }
        if ($this->sheet == 'SpConcern_3') {
            $filename = "Park Car - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(3), $filename);
        }
        if ($this->sheet == 'SpConcern_4') {
            $filename = "Park Motor - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(4), $filename);
        }
        if ($this->sheet == 'SpConcern_5') {
            $filename = "Feeder - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(5), $filename);
        }
        if ($this->sheet == 'SpConcern_7') {
            $filename = "Feeder Park - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(7), $filename);
        }
        if ($this->sheet == 'SpConcern_9') {
            $filename = "Park Ride Car - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(9), $filename);
        }
        if ($this->sheet == 'SpConcern_10') {
            $filename = "Park Ride Motor - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(10), $filename);
        }
        if ($this->sheet == 'SpConcern_11') {
            $filename = "Park Ride Car (Hypo) - Survei Preference MRTJ Exported - {$dateTime}.xlsx";

            Excel::store(new SpConcern(11), $filename);
        }
        if ($this->sheet == 'SpConcern_12') {
            $filename = "Park Ride Motor (Hypo) - Survei Preference MRTJ Exported - {$dateTime}.xlsx";
            Excel::store(new SpConcern(12), $filename);
        }
    }
}
