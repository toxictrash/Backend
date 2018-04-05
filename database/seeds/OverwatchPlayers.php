<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OverwatchPlayers extends Seeder
{
    private $playerData = [];

    public function run()
    {
        $this->setPlayers();
        DB::table('overwatch_players')->insert($this->playerData);
    }

    private function setPlayers() {
        $this->addPlayer('ToxicToast', '1192', 1);
		$this->addPlayer('BeLoor', '2339', 2);
		$this->addPlayer('DragonMG', '2607', 3);
		$this->addPlayer('HanterGER', '2134', 4);
		$this->addPlayer('Noobster', '21680', 5);
        $this->addPlayer('Sensimillia', '21307', 6);
        $this->addPlayer('nerdxchan', '2356', 7);
        $this->addPlayer('Anti', '2142', 8);
    }

    private function addPlayer($player, $hash, $id) {
		$array = [
			'id'		=> $id,
            'name'	    => $player,
            'slug'	    => str_slug($player),
            'hashtag'	=> $hash,
            'created_at'=> Carbon::now(),
            'active'    => '1'
		];
		$this->playerData[] = $array;
	}
}
