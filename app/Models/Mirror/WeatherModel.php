<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;

class GuidesModel extends Model
{
	protected $table = 'mirror_weather';
	protected $fillable = ['city'];
	protected $connection = 'mirror';
}