<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Helpers\Overwatch\Tiers;
use App\Helpers\Overwatch\Characters;

use App\Models\Overwatch\PlayersModel;
use App\Models\Overwatch\RankingModel;
use App\Models\Overwatch\PlaytimeModel;
use App\Models\Overwatch\TrendsModel;

use GuzzleHttp\Client;
use Carbon\Carbon;

class fetchProfile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $profile = [];
    private $savedRanking = false;
    private $savedPlaytime = false;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($profile)
    {
        $this->profile = $profile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->getApiData();
        $this->savePlayerOldRanking();
        $this->savePlayerRanking($data);
        $this->updatePlayerPlaytime($data);
        $this->updatePlayer();
    }


    private function getApiData() {
        $bnetAccount = $this->profile['user'] . "-" .  $this->profile['tag'];
        $url = "https://owapi.net/api/v3/u/" . urlencode($bnetAccount) . "/blob";
        $client = new Client();
        $response = $client->get($url);
        $json = json_decode($response->getBody()->getContents(), true);
        return $json['eu'];
    }

    private function savePlayerOldRanking() {
        $model = RankingModel::where('player_id', $this->profile['userId'])->first();
        if ($model) {
            $payload = [
                'player_id'             => $this->profile['userId'],
                'player_ranking'        => $model->player_ranking,
                'player_tier'           => $model->player_current_tier,
                'player_games_total'    => $model->player_games_total,
                'player_games_won'      => $model->player_games_won,
                'player_games_draw'     => $model->player_games_draw,
                'player_games_lose'     => $model->player_games_lose
            ];
            $trends = new TrendsModel($payload);
            $trends->save();
        }
    }

    private function updatePlayer() {
		if ($this->savedRanking && $this->savedPlaytime) {
            PlayersModel::where('id', $this->profile['userId'])->update([
                'updated_at' => Carbon::now()
            ]);
		}
	}

    private function savePlayerRanking($data) {
        $stats = $this->getStats($data);
        $array = [];
        //
        if (!empty($stats) && !empty($stats['overall_stats']) && !empty($stats['game_stats'])) {
            $overall = $stats['overall_stats'];
            $gamestats = $stats['game_stats'];
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
        }
        //
        try {
            RankingModel::updateOrCreate([ 'player_id' => $this->profile['userId'] ], $array);
            $status = true;
        } catch (\Exception $e) {
            $status = false;
        }
        $this->savedRanking = $status;
    }

    public function updatePlayerPlaytime($data) {
        $charactersHelper = new Characters();
		$playtimeArray = [];
        $heroes = $this->getHeroes($data);
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
                $array['player_id'] = $this->profile['userId'];
				$array['character_name'] = $character;
				$array['character_time'] = $playtime;
                $array['character_role'] = (isset($charactersArray['role'])) ? $charactersArray['role'] : 'missing';
                if ($playtime > 0) {
					$playtimeArray[] = $array;
				}
            }
            $playtime = collect($playtimeArray)->sortByDesc('character_time')->slice(0, 3)->all();
        } else {
            $playtime = [];
        }
        //
        try {
            PlaytimeModel::where('player_id', $this->profile['userId'])->delete();
            foreach($playtime as $playArray) {
                $model = new PlaytimeModel($playArray);
                $model->save();
            }
            $status = true;
        } catch (\Exception $e) {
            $status = false;
        }
        $this->savedPlaytime = $status;
    }

    private function getStats($data) {
        if (!empty($data) && !empty($data['stats'])) {
            return $data['stats']['competitive'];
        } else {
            return null;
        }
    }

    private function getHeroes($data) {
        if (!empty($data['heroes'])) {
            $array = [
                'playtime'	=> $data['heroes']['playtime']['competitive'],
                'stats'		=> $data['heroes']['stats']['competitive']
            ];
        } else {
            $array = null;
        }
        return $array;
    }

    private function checkPoints($points) {
        $tier = new Tiers();
		$league = $tier->getTier($points);
		return strtolower($league['title']);
    }
}
