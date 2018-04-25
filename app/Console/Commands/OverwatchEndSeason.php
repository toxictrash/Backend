<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Overwatch\PlaytimeModel;
use App\Models\Overwatch\RankingModel;
use App\Models\Overwatch\TrendsModel;


class OverwatchEndSeason extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'overwatch:endseason';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncates the whole Database';

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
        $this->truncatePlaytime();
        $this->truncateRanking();
        $this->truncateTrends();
    }

    private function truncatePlaytime() {
        PlaytimeModel::all()->delete();
    }

    private function truncateRanking() {
        RankingModel::all()->delete();
    }

    private function truncateTrends() {
        TrendsModel::all()->delete();
    }

}
