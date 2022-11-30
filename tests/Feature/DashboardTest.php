<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Statistics;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
	use RefreshDatabase;

	public function test_home_dashboard_is_accessible()
	{
		$response = $this->get(route('dashboard.home'));
		$response->assertSuccessful();
		$response->assertSee(__('dashboard.worldwide'));
		$response->assertViewIs('dashboard.home');
	}

	public function test_countries_dashboard_is_inaccessible_to_guests()
	{
		$response = $this->get(route('dashboard.countries'));
		$response->assertRedirect(route('login'));
	}

	public function test_countries_dashboard_is_accessible_to_logged_in_users()
	{
		$user = $this->createUser();
		auth()->login($user);

		$response = $this->get(route('dashboard.countries'));
		$response->assertSee(__('dashboard.statistics_by_country'));
		$response->assertViewIs('dashboard.countries');
	}

	public function test_home_dashboard_displays_worldwide_statistics()
	{
		$this->artisan('db:seed');
		$worldwideStats = Statistics::getWorldwideStats();

		$response = $this->get(route('dashboard.home'));
		$response->assertSeeInOrder([
			number_format($worldwideStats['confirmed']),
			number_format($worldwideStats['recovered']),
			number_format($worldwideStats['deaths']),
		]);
	}

	public function test_countries_dashboard_displays_worldwide_statistics()
	{
		$this->artisan('db:seed');
		$worldwideStats = Statistics::getWorldwideStats();

		$user = $this->createUser();
		auth()->login($user);
		$response = $this->get(route('dashboard.countries'));

		$response->assertSee(__('dashboard.worldwide'));
		$response->assertSeeInOrder([
			number_format($worldwideStats['confirmed']),
			number_format($worldwideStats['deaths']),
			number_format($worldwideStats['recovered']),
		]);
	}

	public function test_countries_dashboard_displays_country_statistics_sorted_by_country_name()
	{
		$this->artisan('db:seed');
		$countries = Country::with('statistics')->get();
		$countries = $countries->sortBy('countries.name');

		$user = $this->createUser();
		auth()->login($user);
		$response = $this->get(route('dashboard.countries'));

		$response->assertSee(__('dashboard.worldwide'));
		$response->assertSeeInOrder([
			$countries[0]->name,
			number_format($countries[0]->statistics->confirmed),
			$countries[1]->name,
			number_format($countries[1]->statistics->confirmed),
			$countries[2]->name,
			number_format($countries[2]->statistics->confirmed),
		]);
	}

	public function test_countries_dashboard_limits_displayed_countries_with_search_query()
	{
		$this->artisan('db:seed');

		$firstCountry = Country::all()->take(1)[0];
		$searchQuery = mb_substr($firstCountry->name, 0, 2);

		$countries = Country::with('statistics')->filter($searchQuery)->get();
		$countries = $countries->sortBy('countries.name');

		$user = $this->createUser();
		auth()->login($user);
		$response = $this->get(route('dashboard.countries', [
			'search' => $searchQuery,
		]));

		$foundCountriesAndStatisticsInOrder = [];
		foreach ($countries as $country)
		{
			$foundCountriesAndStatisticsInOrder[] = '>' . e($country->name) . '</td>';
			$foundCountriesAndStatisticsInOrder[] = number_format($country->statistics->confirmed);
		}

		$response->assertSee(__('dashboard.worldwide'));
		$response->assertSeeInOrder($foundCountriesAndStatisticsInOrder, false);

		// Check that countries not matching the search are actually excluded
		$countryIDs = $countries->pluck('id')->toArray();
		$excludedCountries = Country::whereNotIn('id', $countryIDs)->get();
		$excludedCountryNames = $excludedCountries->map(function ($country) {
			return '>' . e($country->name) . '</td>';
		})->toArray();
		$response->assertDontSee($excludedCountryNames, false);
	}

	public function test_countries_dashboard_can_sort_search_results_by_deaths_in_descending_order()
	{
		$this->artisan('db:seed');

		$firstCountry = Country::all()->take(1)[0];
		$searchQuery = mb_substr($firstCountry->name, 0, 2);

		$countries = Country::with('statistics')->filter($searchQuery)->get();
		$countries = $countries->sortByDesc('statistics.deaths');

		$cn = [];
		foreach ($countries as $c)
		{
			$cn[] = $c->statistics->deaths;
		}

		$user = $this->createUser();
		auth()->login($user);
		$response = $this->get(route('dashboard.countries', [
			'search'         => $searchQuery,
			'sort'           => 'statistics.deaths',
			'sort_direction' => 'DESC',
		]));

		//        dd($response);

		$sortedAndFilteredCountriesAndStatistics = [];
		foreach ($countries as $country)
		{
			$sortedAndFilteredCountriesAndStatistics[] = '>' . e($country->name) . '</td>';
			$sortedAndFilteredCountriesAndStatistics[] = number_format($country->statistics->confirmed);
		}

		$response->assertSeeInOrder($sortedAndFilteredCountriesAndStatistics, false);

		// Check that countries not matching the search are actually excluded
		$countryIDs = $countries->pluck('id')->toArray();
		$excludedCountries = Country::whereNotIn('id', $countryIDs)->get();
		$excludedCountryNames = $excludedCountries->map(function ($country) {
			return '>' . e($country->name) . '</td>';
		})->toArray();
		$response->assertDontSee($excludedCountryNames, false);
	}

	public function test_countries_dashboard_can_be_sorted_by_recovered_statistics_in_both_directions()
	{
		$this->artisan('db:seed');

		// Ascending
		$countries = Country::with('statistics')->get();
		$countries = $countries->sortBy('statistics.recovered');

		$user = $this->createUser();
		auth()->login($user);
		$response = $this->get(route('dashboard.countries', [
			'sort'           => 'statistics.recovered',
			'sort_direction' => 'ASC',
		]));

		$sortedCountriesAndStatistics = [];
		foreach ($countries as $country)
		{
			$sortedCountriesAndStatistics[] = $country->name;
			$sortedCountriesAndStatistics[] = number_format($country->statistics->confirmed);
		}

		$response->assertSeeInOrder($sortedCountriesAndStatistics);

		// Descending
		$countries = $countries->sortByDesc('statistics.recovered');

		$response = $this->get(route('dashboard.countries', [
			'sort'           => 'statistics.recovered',
			'sort_direction' => 'DESC',
		]));

		$sortedCountriesAndStatistics = [];
		foreach ($countries as $country)
		{
			$sortedCountriesAndStatistics[] = $country->name;
			$sortedCountriesAndStatistics[] = number_format($country->statistics->confirmed);
		}

		$response->assertSeeInOrder($sortedCountriesAndStatistics);
	}

	private function createUser(): User
	{
		$user = User::create(
			[
				'username'          => 'myusername',
				'email'             => 'myemail',
				'password'          => 'mypassword',
			]
		);
		$user->forceFill(['email_verified_at' => now()]);
		$user->save();
		return $user;
	}
}
