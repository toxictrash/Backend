<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Youtube;
use App\Models\Overwatch\VodModel;

class YoutubeVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:fetch {videoID} {id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches Youtube Video Informations';

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
        $videoID = $this->argument('videoID');
        $tableID = $this->argument('id');
        $video = Youtube::getVideoInfo($videoID);
        //
        $duration = $video->contentDetails->duration;
        $duration = str_replace('PT', '', $duration);
        $array = [
            'youtube_id'        => $videoID,
            'youtube_thumbnail' => $video->snippet->thumbnails->high->url,
            'youtube_title'     => $video->snippet->title,
            'youtube_duration'  => $duration,
            'processed'         => '1',
            'active'            => '0'
        ];
        //
        VodModel::updateOrCreate([
            'id'    => $tableID
        ], $array);
    }
}
