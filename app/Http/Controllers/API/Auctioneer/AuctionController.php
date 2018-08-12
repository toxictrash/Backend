<?php
namespace App\Http\Controllers\API\Auctioneer;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Auctioneer\AuctionModel;
use App\Models\Auctioneer\ItemModel;

class AuctionController extends BaseController {

	public function getAuctionData($server) {
		return AuctionModel::where('ownerRealm', $server)->with('items')->orderBy('id', 'ASC')->paginate(100);
	}

	public function getItemData($itemId) {
		return ItemModel::where('item_id', $itemId)->first();
	}

	public function setItemData() {
		$itemIds = [];
		$items = AuctionModel::orderBy('item_id', 'ASC')->get();
		foreach($items as $item) {
			$itemId = $item->item_id;
			$itemIds[] = $itemId;
		}
		//
		$unique = array_unique($itemIds);
		foreach($unique as $itemId) {
			\Artisan::call('warcraft:items:fetch', [
				'itemId' 	=> $itemId,
				'region'	=> 'eu'
			]);
		}
	}

}