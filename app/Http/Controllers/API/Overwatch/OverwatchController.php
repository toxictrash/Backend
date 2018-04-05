<?php
namespace App\Http\Controllers\API\Overwatch;

use App\Http\Controllers\Controller as BaseController;
use GuzzleHttp\Client;

class OverwatchController extends BaseController {

		private $apiData = [];
		private $mode = '';

		public function __construct() {}

		public function setApiData($name, $hashtag, $mode = 'competitive') {
			$this->apiData = $this->fetchData($name, $hashtag);
			$this->mode = $mode;
		}

		public function getStats() {
			if (!empty($this->apiData) && !empty($this->apiData['stats'])) {
				return $this->apiData['stats'][$this->mode];
			} else {
				return null;
			}

		}

		public function getHeroes() {
			if (!empty($this->apiData) && !empty($this->apiData['heroes'])) {
				$array = [
					'playtime'	=> $this->apiData['heroes']['playtime'][$this->mode],
					'stats'			=> $this->apiData['heroes']['stats'][$this->mode]
				];
			} else {
				$array = null;
			}
			return $array;
		}

		public function getAchievements() {
			if (!empty($this->apiData) && !empty($this->apiData['achievements'])) {
				return $this->apiData['achievements'];
			} else {
				return [];
			}
		}

		private function fetchData($name, $hashtag, $endpoint = 'blob', $region = 'eu') {
			$url = "https://owapi.net/api/v3/u/{$name}-{$hashtag}/{$endpoint}";
			//
			try {
				$client = new Client();
				$response = $client->get($url);
				$json = json_decode($response->getBody()->getContents(), true);
				return $json[$region];
			} catch (\Exception $e) {
				return [
					'error' => true,
					'exception'	=> $e
				];
			}
		}

}