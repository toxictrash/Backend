<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Overwatch\NewsCategoryModel;

class NewsModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_news';
    protected $fillable = ['category_id', 'title', 'slug', 'text', 'active'];
    protected $connection = 'overwatch';

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
		}

		public function category() {
			return $this->hasOne(NewsCategoryModel::class, 'id', 'category_id');
	}
}
