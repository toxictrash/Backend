<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Overwatch\PlaytimeModel;
use App\Models\Overwatch\PlayersModel;
use App\Models\Overwatch\TrendsModel;

class RankingModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_players_ranking';
		protected $fillable = [
			'player_id',
			'player_ranking',
			'player_prestige',
			'player_level',
			'player_current_tier',
			'player_should_tier',
			'player_avatar',
			'player_medals_total',
			'player_medals_gold',
			'player_medals_silver',
			'player_medals_bronze',
			'player_games_total',
			'player_games_won',
			'player_games_draw',
			'player_games_lose',
			'player_healing_done',
			'player_damage_done',
			'player_kills',
			'player_deaths',
			'player_kpd',
		];
		// protected $connection = 'overwatch';

    public function player() {
		return $this->hasOne(PlayersModel::class, 'id', 'player_id');
	}

	public function playtime() {
		return $this->hasMany(PlaytimeModel::class, 'player_id', 'player_id');
	}

	public function trends() {
		return $this->hasMany(TrendsModel::class, 'player_id', 'id')->orderBy('id', 'DESC');
}
}
