<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Statistics;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UpdateStatisticsCommandTest extends TestCase
{
	use RefreshDatabase;

	public function test_update_statistics_command_runs_without_errors_and_populates_the_database_correctly()
	{
		Http::fake([
			'devtest.ge/countries' => Http::response([
				[
					'code' => 'GE',
					'name' => [
						'en' => 'Georgia',
						'ka' => 'საქართველო',
					],
				],
			]),
			'devtest.ge/get-country-statistics' => Http::response([
				'confirmed' => 123,
				'recovered' => 123,
				'deaths'    => 123,
			]),
		]);

		$this->artisan('db:update-stats')->assertExitCode(0);

		$this->assertTrue(Country::count() === Statistics::count() && Country::count() === 1);

		$countryCode = 'GE';
		$countryInDatabase = Country::firstWhere('code', 'GE');
		$countryStatsInDatabase = Statistics::firstWhere('country_id', $countryInDatabase->id);
		$fetchedCountryStats = Http::post('https://devtest.ge/get-country-statistics', [
			'code' => $countryCode,
		])->json();

		$this->assertEquals($fetchedCountryStats['confirmed'], $countryStatsInDatabase['confirmed']);
	}
}
