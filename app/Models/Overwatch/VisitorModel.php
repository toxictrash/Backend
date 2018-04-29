<?php

namespace App\Models\Overwatch;

use Illuminate\Database\Eloquent\Model;

class VisitorModel extends Model
{
    protected $table = 'overwatch_visitor';
    protected $fillable = ['ip', 'country', 'city', 'useragent', 'platform'];
    protected $connection = 'overwatch';
}
