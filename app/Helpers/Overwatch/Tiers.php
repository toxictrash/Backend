<?php
namespace App\Helpers\Overwatch;

class Tiers {
	private $tierList = [];

	public function __construct() {
		$this->setLeagues();
	}

	public function getTier($points) {
		$collection = collect($this->tierList);
		$filtered = $collection->where('points', '<=', $points)->sortByDesc('points')->first();
		return $filtered;
	}

	private function setLeagues() {
		$this->tierList[] = [
			'title'		=> 'Unranked',
			'img'			=> '',
			'points'	=> 0,
			'rankup'	=> 1,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Bronze',
			'img'			=> '/assets/ranks/bronze.png',
			'points'	=> 1,
			'rankup'	=> 1500,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Silver',
			'img'			=> '/assets/ranks/silver.png',
			'points'	=> 1500,
			'rankup'	=> 2000,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Gold',
			'img'			=> '/assets/ranks/gold.png',
			'points'	=> 2000,
			'rankup'	=> 2500,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Platinum',
			'img'			=> '/assets/ranks/platinum.png',
			'points'	=> 2500,
			'rankup'	=> 3000,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Diamond',
			'img'			=> '/assets/ranks/diamond.png',
			'points'	=> 3000,
			'rankup'	=> 3500,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Master',
			'img'			=> '/assets/ranks/master.png',
			'points'	=> 3500,
			'rankup'	=> 4000,
		];
		//
		$this->tierList[] = [
			'title'		=> 'Grandmaster',
			'img'			=> '/assets/ranks/grand-master.png',
			'points'	=> 4000,
			'rankup'	=> 0,
		];
		//

	}
}