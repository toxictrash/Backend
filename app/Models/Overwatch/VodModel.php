<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VodModel extends Model
{
    use SoftDeletes;

    protected $table = 'overwatch_vod';
    protected $fillable = [
			'youtube_id',
			'youtube_thumbnail',
			'youtube_title',
			'youtube_duration',
		];
		protected $connection = 'overwatch';


}
