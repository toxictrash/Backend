<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;
use Carbon\Carbon;
use App\Models\Auctioneer\AuctionModel;
use App\Helpers\Auctioneer\BigFile;
use Illuminate\Support\Facades\Cache;

class fetchAuctions implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $options = [];
	private $bigFile = null;

	public function __construct($options)
	{
		AuctionModel::truncate();
		$this->options = $options;
	}

	public function handle() {
		$region = $this->options['region'];
		$server = $this->options['server'];
		$locale = $this->options['locale'];
		$apiKey = env('BLIZZARD_KEY', 'NONE');
		$promises = [];
		//
		$url = "https://{$region}.api.battle.net/wow/auction/data/{$server}?locale={$locale}&apikey=${apiKey}";
		//
		$client = new Client();
		$response = $client->get($url);
		$json = json_decode($response->getBody()->getContents(), true);
		$jsonUrl = $json['files'][0]['url'];
		//
		$promise = $client->requestAsync('GET', $jsonUrl);
		$promise->then(function($response) {
			$auc = [];
			$data = json_decode($response->getBody()->getContents(), true);
			$auctions = $data['auctions'];
			foreach($auctions as $item) {
				$auc[] = [
					'item_id' 		=> $item['item'],
					'owner'				=> $item['owner'],
					'ownerRealm'	=> $item['ownerRealm'],
					'slug'				=> str_slug($item['auc'] . '-' . $item['owner'] . '-' . $item['ownerRealm']),
					'bid'					=> $item['bid'],
					'buyout'			=> $item['buyout'],
					'quantity'		=> $item['quantity'],
					'timeLeft'		=> $item['timeLeft']
				];
			}
			Cache::put('AuctionData', $auc, 5);
			return true;
		});
		$promise->wait();
		$items = Cache::get('AuctionData');
		/*foreach($items as $item) {
			$model = new AuctionModel($item);
			$model->save();
		}*/
		dd($items);
	}


	public function handleOLD() {
		$region = $this->options['region'];
		$server = $this->options['server'];
		$locale = $this->options['locale'];
		//
		try {
			$apiKey = env('BLIZZARD_KEY', 'NONE');
			$url = "https://{$region}.api.battle.net/wow/auction/data/{$server}?locale={$locale}&apikey=${apiKey}";
			$client = new Client();
			//
			$jsonUrl = $this->getJsonURL($client, $url);
			//
			$promise = $client->getAsync($jsonUrl);
			$promise->then(function($response) {
				$json = json_decode($response->getBody()->getContents(), true);
				foreach($json as $item) {
					$array = [
						'item_id' 		=> $item['item'],
						'owner'				=> $item['owner'],
						'ownerRealm'	=> $item['ownerRealm'],
						'slug'				=> str_slug($item['auc'] . '-' . $item['owner'] . '-' . $item['ownerRealm']),
						'bid'					=> $item['bid'],
						'buyout'			=> $item['buyout'],
						'quantity'		=> $item['quantity'],
						'timeLeft'		=> $item['timeLeft']
					];
					//
					dd($array);
					$model = new AuctionModel($array);
					$model->save();
				}
			});
			$promise->wait();
			//
		} catch(\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	private function getJsonURL($client, $apiUrl) {
		try {
			$response = $client->get($apiUrl);
			$json = json_decode($response->getBody()->getContents(), true);
			return $json['files'][0]['url'];
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}