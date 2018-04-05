<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrendsModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_players_trends';
    protected $fillable = [
			'player_id',
			'player_ranking',
			'player_tier',
			'player_games_total',
			'player_games_won',
			'player_games_draw',
			'player_games_lose',
		];
		protected $connection = 'overwatch';


}
