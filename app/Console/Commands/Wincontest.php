<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
      $dateFromDatabase = strtotime("2012-12-04 12:05:04");
      $dateTwelveHoursAgo = strtotime("-1 hours");

      if ($dateFromDatabase >= $dateTwelveHoursAgo) {
          // less than 12 hours ago
      }
      else {
          // more than 12 hours ago
      }
    }
}
