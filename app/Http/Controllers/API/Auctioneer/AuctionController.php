<?php
namespace App\Http\Controllers\API\Auctioneer;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Auctioneer\AuctionModel;

class AuctionController extends BaseController {

	public function getAuctionData($page = 1) {
		$collection = AuctionModel::orderBy('id', 'ASC')->get();
		return collect($collection)->forPage($page, 100);
	}

}