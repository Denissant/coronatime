<?php

namespace App\Http\Controllers;

use App\Models\Statistics;

class DashboardController extends Controller
{
	public function home()
	{
		$worldwideStats = $this->getWorldwideStats(Statistics::all());

		return view('dashboard.home', ['worldwideStats' => $worldwideStats]);
	}

	public function countries()
	{
	}

	protected function getWorldwideStats($allStats)
	{
		$worldwideStats = [
			'confirmed' => 0,
			'recovered' => 0,
			'deaths'    => 0,
		];

		foreach ($allStats as $statistics)
		{
			$worldwideStats['confirmed'] += $statistics['confirmed'];
			$worldwideStats['recovered'] += $statistics['recovered'];
			$worldwideStats['deaths'] += $statistics['deaths'];
		}

		return $worldwideStats;
	}
}
