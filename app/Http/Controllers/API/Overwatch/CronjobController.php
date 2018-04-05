<?php
namespace App\Http\Controllers\API\Overwatch;

use App\Helpers\Overwatch\Characters;
use App\Helpers\Overwatch\Players;
use App\Helpers\Overwatch\Tiers;

use App\Models\Overwatch\RankingModel;
use App\Models\Overwatch\PlaytimeModel;

class CronjobController extends OverwatchController {

	private $playerData = [];
	private $cronjobData = [];

	public function setPlayerData() {
		$players = new Players();
		$this->playerData = $players->getPlayers();
	}

	public function getCronjobData() {
		return $this->cronjobData;
	}

	public function updatePlayer($playerId) {
		$players = new Players();
		if (!empty($this->cronjobData[$playerId]['ranked']) && !empty($this->cronjobData[$playerId]['playtime'])) {
			$players->updatePlayer($playerId);
			RankingModel::updateOrCreate([ 'player_id' => $playerId ], $this->cronjobData[$playerId]['ranked']);
		}
	}

	public function fetchApiData() {
		foreach($this->playerData as $player) {
			$userId = $player['id'];
			$this->cronjobData[$userId]['userId'] = $userId;
			$this->setApiData($player['player'], $player['hashtag']);
			$this->updatePlayerRanking($userId);
			$this->updatePlayerPlaytime($userId);
			$this->updatePlayer($userId);
			sleep(10);
		}
		dd($this->cronjobData);
	}

	private function updatePlayerRanking($playerId) {
		$stats = $this->getStats();
		if (!empty($stats) && !empty($stats['overall_stats']) && !empty($stats['game_stats'])) {
			$overall = $stats['overall_stats'];
			$gamestats = $stats['game_stats'];
			//
			$array = [
				'player_id'							=> $playerId,
			];
			//
			if (!empty($overall['comprank'])) {
				$array['player_ranking'] = $overall['comprank'];
			}
			if (!empty($overall['level'])) {
				$array['player_level'] = $overall['level'];
			}
			if (!empty($overall['prestige'])) {
				$array['player_prestige'] = $overall['prestige'];
			}
			if (!empty($overall['tier'])) {
				$array['player_current_tier'] = $overall['tier'];
				$array['player_should_tier'] = $this->checkPoints($overall['comprank']);
			}
			if (!empty($overall['avatar'])) {
				$array['player_avatar'] = $overall['avatar'];
			}
			if (!empty($gamestats['medals'])) {
				$array['player_medals_total'] = intval($gamestats['medals']);
			}
			if (!empty($gamestats['medals_gold'])) {
				$array['player_medals_gold'] = intval($gamestats['medals_gold']);
			}
			if (!empty($gamestats['medals_silver'])) {
				$array['player_medals_silver'] = intval($gamestats['medals_silver']);
			}
			if (!empty($gamestats['medals_bronze'])) {
				$array['player_medals_bronze'] = intval($gamestats['medals_bronze']);
			}
			if (!empty($gamestats['games_played'])) {
				$array['player_games_total'] = intval($gamestats['games_played']);
			}
			if (!empty($gamestats['games_won'])) {
				$array['player_games_won'] = intval($gamestats['games_won']);
			}
			if (!empty($gamestats['games_lost'])) {
				$array['player_games_lose'] = intval($gamestats['games_lost']);
			} else {
				$wins = intval($gamestats['games_won']);
				$draws = intval($gamestats['games_tied']);
				$total = intval($gamestats['games_played']);
				$array['player_games_lose'] = $total - ($wins + $draws);
			}
			if (!empty($gamestats['games_tied'])) {
				$array['player_games_draw'] = intval($gamestats['games_tied']);
			}
			if (!empty($gamestats['healing_done'])) {
				$array['player_healing_done'] = intval($gamestats['healing_done']);
			}
			if (!empty($gamestats['all_damage_done'])) {
				$array['player_damage_done'] = intval($gamestats['all_damage_done']);
			}
			if (!empty($gamestats['deaths'])) {
				$array['player_deaths'] = intval($gamestats['deaths']);
			}
			if (!empty($gamestats['eliminations'])) {
				$array['player_kills'] = intval($gamestats['eliminations']);
			}
			if (!empty($gamestats['kpd'])) {
				$array['player_kpd'] = intval($gamestats['kpd']);
			}
		} else {
			$array = [];
		}
		$this->cronjobData[$playerId]['ranked'] = $array;
	}

	private function updatePlayerPlaytime($playerId) {
		$charactersHelper = new Characters();
		$playtimeArray = [];
		$heroes = $this->getHeroes();
		if (!empty($heroes)) {
			$heroStats = $heroes['stats'];
			foreach($heroes['playtime'] as $character => $playtime) {
				$charactersArray = $charactersHelper->getCharacter($character);
				$array = [
					'player_id'								=> 0,
					'character_name'					=> 'none',
					'character_time'					=> 0,
					'character_role'					=> 'none',
					'character_kills' 				=> 0,
					'character_deaths'				=> 0,
					'character_healing_done'	=> 0,
					'character_damage_done'		=> 0,
					'character_games_played'	=> 0,
					'character_games_won'			=> 0,
					'character_games_draw'		=> 0,
					'character_games_lost'		=> 0,
					'character_winrate'				=> 0
				];
				if (isset($heroStats[$character])) {
					$generalStats = $heroStats[$character]['general_stats'];
					$array['character_kills'] = (isset($generalStats['eliminations'])) ? intval($generalStats['eliminations']) : 0;
					$array['character_deaths'] = (isset($generalStats['deaths'])) ? intval($generalStats['deaths']) : 0;
					$array['character_healing_done'] = (isset($generalStats['healing_done'])) ? intval($generalStats['healing_done']) : 0;
					$array['character_damage_done'] = (isset($generalStats['all_damage_done'])) ? intval($generalStats['all_damage_done']) : 0;
					$array['character_games_played'] = (isset($generalStats['games_played'])) ? intval($generalStats['games_played']) : 0;
					$array['character_games_won'] = (isset($generalStats['games_won'])) ? intval($generalStats['games_won']) : 0;
					$array['character_games_draw'] = (isset($generalStats['games_tied'])) ? intval($generalStats['games_tied']) : 0;
					$array['character_games_lost'] = (isset($generalStats['games_lost'])) ? intval($generalStats['games_lost']) : 0;
					$array['character_winrate'] = (isset($generalStats['win_percentage'])) ? intval(($generalStats['win_percentage'] * 100)) : 0;
				}
				$array['player_id'] = $playerId;
				$array['character_name'] = $character;
				$array['character_time'] = $playtime;
				$array['character_role'] = (isset($charactersArray['role'])) ? $charactersArray['role'] : 'missing';
				$playtimeArray[] = $array;
			}
			$playtime = collect($playtimeArray)->sortByDesc('character_time')->slice(0, 3)->all();
		} else {
			$playtime = [];
		}
		$this->cronjobData[$playerId]['playtime'] = $playtime;
		//
		PlaytimeModel::where('player_id', $playerId)->delete();
		//
		foreach($playtime as $playArray) {
			$model = new PlaytimeModel($playArray);
			$model->save();
		}
	}

	private function checkPoints($points) {
		$tier = new Tiers();
		$league = $tier->getTier($points);
		return strtolower($league['title']);
	}
}