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
		$countries = Country::filter(request('search'))
			->join('statistics', 'statistics.country_id', '=', 'countries.id')
			->orderBy(request('sort', 'countries.name'), request('sort_direction', 'ASC'))
			->get();

		return view(
			'dashboard.countries',
			['worldwideStats' => Statistics::getWorldwideStats(), 'countries' => $countries]
		);
	}
}
