<?php

namespace App\Models\Auctioneer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;

class ItemModel extends Model
{
    use SoftDeletes;
    protected $table = 'wow_items';
    protected $fillable = ['item_id', 'title', 'slug', 'description', 'icon', 'quality'];
}
