<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Overwatch\RankingModel;
use App\Models\Overwatch\PlaytimeModel;

class PlayersModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_players';
    protected $fillable = ['name', 'slug', 'hashtag', 'active'];

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
    }

    public function ranked() {
        return $this->hasOne(RankingModel::class, 'player_id', 'id');
    }

    public function playtime() {
        return $this->hasMany(PlaytimeModel::class, 'player_id', 'id');
    }
}
