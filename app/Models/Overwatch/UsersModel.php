<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Overwatch\GuidesModel;
// use App\Models\Overwatch\NewsModel;
use App\Models\Overwatch\PlayersModel;
use App\Models\Overwatch\VodModel;

class UsersModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_users';
    protected $fillable = [
        'username',
        'slug',
        'email',
        'password',
        'player_role',
        'active',
        'last_login'
    ];
    protected $connection = 'overwatch';

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
    }

    // Guides
    public function guides() {
        return $this->hasMany(GuidesModel::class, 'user_id', 'id');
    }
    // News
    public function news() {
        // return $this->hasMany(UsersModel::class, 'user_id', 'id');
    }
    // Players Account
    public function players() {
        return $this->hasOne(PlayersModel::class, 'user_id', 'id');
    }
    // VODs
    public function vods() {
        return $this->hasMany(VodModel::class, 'user_id', 'id');
    }
}
