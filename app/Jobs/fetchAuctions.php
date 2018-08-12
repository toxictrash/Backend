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

class fetchAuctions implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	private $options = [];
	private $bigFile = null;

	public function __construct($options)
	{
		$this->options = $options;
	}

	public function handle() {
		$region = $this->options['region'];
		$server = $this->options['server'];
		$locale = $this->options['locale'];
		//
		try {
			$apiKey = env('BLIZZARD_KEY', 'NONE');
			$url = "https://{$region}.api.battle.net/wow/auction/data/{$server}?locale={$locale}&apikey=${apiKey}";
			//
			$jsonUrl = $this->getJsonURL($url);
			$promise = $this->getJsonData($jsonUrl);
			//
			$promise->then(function($response) {
				$json = json_decode($response->getBody()->getContents(), true);
				AuctionModel::truncate();
				foreach($items as $item) {
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

	private function getJsonURL($apiUrl) {
		try {
			$client = new Client();
			$response = $client->get($apiUrl);
			$json = json_decode($response->getBody()->getContents(), true);
			return $json['files'][0]['url'];
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}

	private function getJsonData($fileUrl) {
		$client = new Client();
			$promise = $client->getAsync($fileUrl);
			return $promise;
	}

	public function OLDhandle()
  {
		$region = $this->options['region'];
		$server = $this->options['server'];
		$locale = $this->options['locale'];
		//
		try {
			$apiKey = env('BLIZZARD_KEY', 'NONE');
			$url = "https://{$region}.api.battle.net/wow/auction/data/{$server}?locale={$locale}&apikey=${apiKey}";
			//
			$client = new Client();
			$response = $client->get($url);
			$json = json_decode($response->getBody()->getContents(), true);
			//
			$fileUrl = $json['files'][0]['url'];
			$response = $client->get($fileUrl);
			$json = json_decode($response->getBody()->getContents(), true);
			$items = collect($json['auctions']);//->forPage(1, 100);
			//
			AuctionModel::truncate();
			//
			foreach($items as $item) {
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
				$model = new AuctionModel($array);
				$model->save();
			}
		} catch(\Exception $e) {
			throw new \Exception($e->getMessage());
		}
	}
}