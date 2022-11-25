<?php

namespace App\Http\Controllers;

use App\Models\Statistics;

class DashboardController extends Controller
{
	public function home()
	{
		$worldwideStats = Statistics::getWorldwideStats(Statistics::all());

		return view('dashboard.home', ['worldwideStats' => $worldwideStats]);
	}

	public function countries()
	{
	}
}
