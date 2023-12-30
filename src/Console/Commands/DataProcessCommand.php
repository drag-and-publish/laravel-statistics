<?php

namespace LaravelReady\Statistics\Console\Commands;

use Illuminate\Console\Command;
use LaravelReady\Statistics\Supports\Statistic;

class DataProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Statistic::processUaData();
        Statistic::processIpData();
    }
}
