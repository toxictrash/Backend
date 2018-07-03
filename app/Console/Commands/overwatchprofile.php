<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\fetchProfile;
use Carbon\Carbon;
use App\Models\Overwatch\PlayersModel;
use Illuminate\Foundation\Bus\DispatchesJobs;

class overwatchprofile extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'overwatch:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches the Overwatch Players';

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
        $model = PlayersModel::OnlyActive()->orderBy('id', 'ASC')->get();
        if (!$model->isEmpty()) {
            foreach($model as $player) {
                $user = $player->name;
                $tag = $player->hashtag;
                $userId = $player->id;
                //
                try {
                    $this->dispatch((new fetchProfile([
                        'user'      => $user,
                        'tag'       => $tag,
                        'userId'    => $userId
                    ]))->onQueue('overwatch_profiles'));
                    sleep(10);
                    $this->info('Fetching Data for ' . $user . ' finished.');
                    $player->updated_at = Carbon::now();
                    $player->save();
                } catch(\Exception $e) {
                    $this->info('Error while fetching Data for ' . $user . ' -> ' . $e->getMessage());
                    continue;
                }
            }
        }
    }
}
