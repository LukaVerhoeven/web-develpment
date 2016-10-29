<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Wedstrijddate;

class Wincontest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Wincontest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks for winner when contest ends';

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
      $wedstrijddate = new Wedstrijddate;
      $wedstrijddate->price     = "popo";
      $wedstrijddate->startdate = "2016-10-29";
      $wedstrijddate->enddate   = "2016-10-20";
      $wedstrijddate->save();

      $dateFromDatabase = strtotime("2016-10-29 18:40:04");
      $dateTwelveHoursAgo = strtotime("-1 hours");

      if ($dateFromDatabase >= $dateTwelveHoursAgo) {
          // less than 12 hours ago

          $this->line('Display this on the screen');
      }
      else {
          // more than 12 hours ago
      }
    }
}
