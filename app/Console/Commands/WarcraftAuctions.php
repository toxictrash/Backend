<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\fetchAuctions;
use Illuminate\Foundation\Bus\DispatchesJobs;

class WarcraftAuctions extends Command
{
	use DispatchesJobs;
	protected $signature = 'warcraft:auction:fetch {region} {server}';
	protected $description = 'Fetches the Auctionhouse';

	public function __construct() {
			parent::__construct();
	}

	public function handle() {
		$region = $this->argument('region');
		$server = $this->argument('server');
		$locale = 'en_GB';

		$this->dispatch((new fetchAuctions([
			'region'      => $region,
			'server'       => $server,
			'locale'    => $locale
	]))->onQueue('warcraft_auctions'));
	}
}