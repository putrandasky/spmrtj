<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\BaseExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\SosioConcern;
use App\Exports\TripConcern;
use App\Exports\SpConcern;
use App\Exports\AdditionalConcern;
use App\Exports\PersonalConcern;
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
      $filename = "Survei Preference MRTJ Exported - {$dateTime}.xlsx";
      if ($this->sheet == 'SosioConcern') {
        Excel::store(new SosioConcern(), $filename);
      }
      if ($this->sheet == 'TripConcern') {
        Excel::store(new TripConcern(), $filename);
      }
      if ($this->sheet == 'PersonalConcern') {
        Excel::store(new PersonalConcern(), $filename);
      }
      if ($this->sheet == 'SpConcern_1') {
        Excel::store(new SpConcern(1), $filename);
      }
      if ($this->sheet == 'SpConcern_2') {
        Excel::store(new SpConcern(2), $filename);
      }
      if ($this->sheet == 'SpConcern_3') {
        Excel::store(new SpConcern(3), $filename);
      }
      if ($this->sheet == 'SpConcern_4') {
        Excel::store(new SpConcern(4), $filename);
      }
      if ($this->sheet == 'SpConcern_5') {
        Excel::store(new SpConcern(5), $filename);
      }
      if ($this->sheet == 'SpConcern_7') {
        Excel::store(new SpConcern(7), $filename);
      }
      if ($this->sheet == 'SpConcern_9') {
        Excel::store(new SpConcern(9), $filename);
      }
      if ($this->sheet == 'SpConcern_10') {
        Excel::store(new SpConcern(10), $filename);
      }
      if ($this->sheet == 'SpConcern_11') {
        Excel::store(new SpConcern(11), $filename);
      }
      if ($this->sheet == 'SpConcern_12') {
        Excel::store(new SpConcern(12), $filename);
      }
    }
}
