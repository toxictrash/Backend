<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostsModel extends Model
{
    use SoftDeletes;

    protected $table = 'blog_posts';
    protected $fillable = ['category_id', 'title', 'slug', 'text', 'active'];
    protected $connection = 'blog';

    public function scopeOnlyActive($query) {
        return $query->where('active', '1');
    }
}
