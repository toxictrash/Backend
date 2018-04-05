<?php
namespace App\Helpers\Overwatch;

use App\Models\Overwatch\PlayersModel;
use Carbon\Carbon;

class Players {
	private $playerData = [];

	public function __construct() {
		$model = PlayersModel::OnlyActive()->orderBy('id', 'ASC')->get();
		foreach ($model as $player) {
			$this->getPlayer($player->name, $player->hashtag, $player->id);
		}
	}

	public function getPlayers() {
		return $this->playerData;
	}

	public function updatePlayer($id) {
		$model = PlayersModel::OnlyActive()->where('id', $id)->first();
		$model->updated_at = Carbon::now();
		$model->save();
	}

	private function getPlayer($player, $hash, $id) {
		$array = [
			'id'			=> $id,
			'player'	=> $player,
			'hashtag'	=> $hash
		];
		$this->playerData[] = $array;
	}

}