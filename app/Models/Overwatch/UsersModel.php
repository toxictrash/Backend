<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
