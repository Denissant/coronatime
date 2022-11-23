<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Country;
use DB;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$fetchedCountries = $this->fetchCountries();

		$global_country = Country::create([
			'name'    => ['en' => 'Worldwide', 'ka' => 'მსოფლიოში'],
			'code'    => 'GLOBAL',
		]);
		$global_country->save();

		echo "Adding Country rows... \n";
		DB::beginTransaction();
		foreach ($fetchedCountries as $countryData)
		{
			$country = Country::create([
				'name' => $countryData['name'],
				'code' => $countryData['code'],
			]);
			$country->save();
		}
		DB::commit();
		echo "Finished adding Country rows! \n";

		echo "Adding Statistics to each Country... \n";
		Country::updateAllStatistics(false);
		echo "Finished adding Statistics! \n";
	}

	protected function fetchCountries()
	{
		$client = new Client();
		$response = $client->request('GET', 'https://devtest.ge/countries');
		$result = $response->getBody();
		return json_decode($result, true);
	}
}
