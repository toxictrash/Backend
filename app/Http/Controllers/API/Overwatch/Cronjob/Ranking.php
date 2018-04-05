<?php
namespace App\Http\Controllers\API\Overwatch\Cronjob;

use App\Models\Overwatch\Ranking as Model;

class Ranking {

			public function __construct($playerId) {
				$this->update($playerId);
			}

			private function update($playerId) {

			}
}