<?php

namespace App\Models\Auctioneer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GuzzleHttp\Client;

class AuctionModel extends Model
{
    use SoftDeletes;
    protected $table = 'wow_auctions';
    protected $fillable = ['item_id', 'owner', 'ownerRealm', 'slug', 'bid', 'buyout', 'quantity', 'timeLeft'];

    public function items() {
        return  $this->hasOne('App\Models\Auctioneer\ItemModel', 'item_id', 'item_id');
    }
}
