<?php

namespace App\Console\Commands;

use App;
use Illuminate\Console\Command;

class ClearDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:alldatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear All Database Record';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        App\AreaOrigin::truncate();
        App\AreaDestination::truncate();
        App\MrtImprovement::truncate();
        App\ReasonUsingTransportation::truncate();
        App\Respondent::truncate();
        App\SpCarParking::truncate();
        App\SpMotorParking::truncate();
        App\SpCycle::truncate();
        App\SpFeederPark::truncate();
        App\SpFeederPremium::truncate();
        App\SpFeederReguler::truncate();
        App\SpPedestrian::truncate();
        App\SpParkRideCommon::truncate();
        App\SpParkRidePrimaryCar::truncate();
        App\SpParkRidePrimaryMotor::truncate();
        App\SpParkRideHypoCar::truncate();
        App\SpParkRideHypoMotor::truncate();
        App\SpPedestrianOther::truncate();
        App\SpCycleOther::truncate();
        App\TravelDetail::truncate();
        App\SurveyPreferenceRespondent::truncate();
        App\FeederRespondent::truncate();
        App\ParkRidePointRespondent::truncate();
        App\StationRespondent::truncate();

        echo 'All Record Database Has Been Deleted'."\n";

    }
}
