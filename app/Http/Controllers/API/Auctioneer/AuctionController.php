<?php
namespace App\Http\Controllers\API\Auctioneer;

use GuzzleHttp\Client;

class AuctionController extends OverwatchController {

	public function getAuctionData($region, $server, $locale) {
		$apiKey = env('BLIZZARD_KEY', 'NONE');
		$url = "https://{$region}.api.battle.net/wow/auction/data/{$server}?locale={$locale}&apikey=${apiKey}";
		//
		$client = new Client();
		$response = $client->get($url);
		$json = json_decode($response->getBody()->getContents(), true);
		return $json;
	}

}