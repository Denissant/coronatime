<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Statistics;

class DashboardController extends Controller
{
	public function home()
	{
		return view('dashboard.home', ['worldwideStats' => Statistics::getWorldwideStats()]);
	}

	public function countries()
	{
		return view(
			'dashboard.countries',
			['worldwideStats' => Statistics::getWorldwideStats(), 'countries' => Country::all()]
		);
	}
}
