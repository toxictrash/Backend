<?php
namespace App\Helpers\Overwatch;

class Characters {
		private $characterList = [];
		//
		public function __construct() {
			$this->setOffenseHeroes();
			$this->setDefenseHeroes();
			$this->setTankHeroes();
			$this->setSupportHeroes();
		}
		public function getCharacter($name) {
			$returnArray = [];
			$collection = collect($this->characterList);
			$filtered = $collection->where('name', $name)->first();
			if (!$filtered) {
				$slug = $collection->where('slug', $name)->first();
				if ($slug) {
					$returnArray = $slug;
				}
			} else {
				$returnArray = $filtered;
			}
			return $returnArray;
		}

		public function getRoles($role) {
			$collection = collect($this->characterList);
			$filtered = $collection->where('role', $role);
			if ($filtered->isEmpty()) {
				return [];
			}
			return $filtered->all();
		}

		private function setOffenseHeroes() {
			$this->characterList[] = [
				'name'	=> 'Sombra',
				'slug'	=> str_slug('Sombra'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'Soldier:76',
				'slug'	=> str_slug('Soldier:76'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'Tracer',
				'slug'	=> str_slug('Tracer'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'McCree',
				'slug'	=> str_slug('McCree'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'Genji',
				'slug'	=> str_slug('Genji'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'Pharah',
				'slug'	=> str_slug('Pharah'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'Reaper',
				'slug'	=> str_slug('Reaper'),
				'role'	=> 'Offense'
			];
			$this->characterList[] = [
				'name'	=> 'Doomfist',
				'slug'	=> str_slug('Doomfist'),
				'role'	=> 'Offense'
			];
		}
		private function setDefenseHeroes() {
			$this->characterList[] = [
				'name'	=> 'Mei',
				'slug'	=> str_slug('Mei'),
				'role'	=> 'Defense'
			];
			$this->characterList[] = [
				'name'	=> 'Widowmaker',
				'slug'	=> str_slug('Widowmaker'),
				'role'	=> 'Defense'
			];
			$this->characterList[] = [
				'name'	=> 'Hanzo',
				'slug'	=> str_slug('Hanzo'),
				'role'	=> 'Defense'
			];
			$this->characterList[] = [
				'name'	=> 'Junkrat',
				'slug'	=> str_slug('Junkrat'),
				'role'	=> 'Defense'
			];
			$this->characterList[] = [
				'name'	=> 'Bastion',
				'slug'	=> str_slug('Bastion'),
				'role'	=> 'Defense'
			];
			$this->characterList[] = [
				'name'	=> 'Torbjörn',
				'slug'	=> str_slug('Torbjörn'),
				'role'	=> 'Defense'
			];
		}
		private function setTankHeroes() {
			$this->characterList[] = [
				'name'	=> 'D.Va',
				'slug'	=> str_slug('D.Va'),
				'role'	=> 'Tank'
			];
			$this->characterList[] = [
				'name'	=> 'Zarya',
				'slug'	=> str_slug('Zarya'),
				'role'	=> 'Tank'
			];
			$this->characterList[] = [
				'name'	=> 'Reinhardt',
				'slug'	=> str_slug('Reinhardt'),
				'role'	=> 'Tank'
			];
			$this->characterList[] = [
				'name'	=> 'Winston',
				'slug'	=> str_slug('Winston'),
				'role'	=> 'Tank'
			];
			$this->characterList[] = [
				'name'	=> 'Roadhog',
				'slug'	=> str_slug('Roadhog'),
				'role'	=> 'Tank'
			];
			$this->characterList[] = [
				'name'	=> 'Orisa',
				'slug'	=> str_slug('Orisa'),
				'role'	=> 'Tank'
			];
		}
		private function setSupportHeroes() {
			$this->characterList[] = [
				'name'	=> 'Lucio',
				'slug'	=> str_slug('Lucio'),
				'role'	=> 'Support'
			];
			$this->characterList[] = [
				'name'	=> 'Ana',
				'slug'	=> str_slug('Ana'),
				'role'	=> 'Support'
			];
			$this->characterList[] = [
				'name'	=> 'Zenyatta',
				'slug'	=> str_slug('Zenyatta'),
				'role'	=> 'Support'
			];
			$this->characterList[] = [
				'name'	=> 'Mercy',
				'slug'	=> str_slug('Mercy'),
				'role'	=> 'Support'
			];
			$this->characterList[] = [
				'name'	=> 'Moira',
				'slug'	=> str_slug('Moira'),
				'role'	=> 'Support'
			];
			$this->characterList[] = [
				'name'	=> 'Brigitte',
				'slug'	=> str_slug('Brigitte'),
				'role'	=> 'Support'
			];
			$this->characterList[] = [
				'name'	=> 'Symmetra',
				'slug'	=> str_slug('Symmetra'),
				'role'	=> 'Support'
			];
		}
}
?>