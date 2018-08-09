<?php
namespace App\Http\Controllers\API\Auctioneer;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Auctioneer\AuctionModel;

class AuctionController extends BaseController {

	public function getAuctionData() {
		return AuctionModel::orderBy('id', 'ASC')->paginate(100);
	}

}