<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Overwatch\RankingModel;
use App\Models\Overwatch\PlayersModel;
use App\Models\Overwatch\TrendsModel;

class PlaytimeModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_players_playtime';
    protected $fillable = [
        'player_id',
        'character_name',
        'character_time',
        'character_role',
        'character_kills',
        'character_deaths',
        'character_healing_done',
        'character_damage_done',
        'character_games_played',
        'character_games_won',
        'character_games_lost',
        'character_games_draw',
        'character_winrate'
    ];
    // protected $connection = 'overwatch';

    public function player() {
        return $this->hasOne(PlayersModel::class, 'id', 'player_id');
    }

    public function trends() {
        return $this->hasMany(TrendsModel::class, 'player_id', 'id')->orderBy('id', 'DESC');
    }
}
