<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategoryModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_news_category';
    protected $fillable = ['title', 'slug', 'active'];
    // protected $connection = 'overwatch';

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
    }
}
