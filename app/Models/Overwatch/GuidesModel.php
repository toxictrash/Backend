<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Overwatch\UsersModel;

class GuidesModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_guides';
    protected $fillable = ['title', 'slug', 'text', 'thumbnail', 'characters', 'maps', 'active', 'user_id'];
    protected $connection = 'overwatch';

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
    }

    public function users() {
        return $this->hasOne(UsersModel::class, 'id', 'user_id');
    }
}
