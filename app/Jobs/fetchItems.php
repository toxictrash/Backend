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
use App\Models\Auctioneer\ItemModel;
use Illuminate\Support\Facades\Cache;

class fetchItems implements ShouldQueue {
	private $options = [];

	public function __construct($options)	{
		$this->options = $options;
	}

	public function handle() {
		$region = $this->options['region'];
		$itemId = $this->options['itemId'];
		$locale = $this->options['locale'];
		$apiKey = env('BLIZZARD_KEY', 'NONE');
		//
		$url = "https://{$region}.api.battle.net/wow/item/{$itemId}?locale={$locale}&apikey=${apiKey}";
		//
		$client = new Client();
		$response = $client->get($url);
		$json = json_decode($response->getBody()->getContents(), true);
		//
		$array = [
			'item_id'			=> $json['id'],
			'title'				=> $json['name'],
			'slug'				=> str_slug($json['name']),
			'description'	=> $json['description'],
			'icon'				=> $json['icon'],
			'quality'			=> $json['quality']
		];
		//
		ItemModel::updateOrCreate(
			['item_id' => $json['id']],
			$array
		);
	}
}