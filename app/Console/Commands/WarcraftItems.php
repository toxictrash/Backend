<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\fetchItems;
use Illuminate\Foundation\Bus\DispatchesJobs;

class WarcraftItems extends Command
{
	use DispatchesJobs;
	protected $signature = 'warcraft:items:fetch {region} {itemId} ';
	protected $description = 'Fetches the Item DB';

	public function __construct() {
			parent::__construct();
	}

	public function handle() {
		$region = $this->argument('region');
		$itemId = $this->argument('itemId');
		$locale = 'en_GB';
		$this->dispatch((new fetchItems([
			'region'      => $region,
			'itemId'       => $itemId,
			'locale'    => $locale
		])));
	}
}