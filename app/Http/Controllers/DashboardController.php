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
		$countries = Country::with('statistics')->filter(request('search'))->get();

		if (request('sort_direction') === 'DESC')
		{
			$countries = $countries->sortByDesc(request('sort', 'countries.name'));
		}
		else
		{
			$countries = $countries->sortBy(request('sort', 'countries.name'));
		}

		return view(
			'dashboard.countries',
			['worldwideStats' => Statistics::getWorldwideStats(), 'countries' => $countries]
		);
	}
}
