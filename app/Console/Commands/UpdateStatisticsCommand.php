<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;

class UpdateStatisticsCommand extends Command
{
	protected $signature = 'db:update-stats';

	protected $description = 'Update statistics for each country and update Worldwide statistics';

	public function handle()
	{
		$this->info(date('Y-m-d H:i:s') . " Updating Country Statistics... \n");
		Country::updateAllStatistics(true);
		$this->info(date('Y-m-d H:i:s') . " Finished updating Country Statistics! \n");
		return Command::SUCCESS;
	}
}
