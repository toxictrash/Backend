<?php
namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_players';
    protected $fillable = ['name', 'slug', 'hashtag', 'active'];

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
    }

    public function ranked() {
        return $this->hasOne(Ranking::class, 'player_id', 'id');
    }

    public function playtime() {
        return $this->hasMany(Playtime::class, 'player_id', 'id');
    }
}
