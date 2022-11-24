<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Statistics;
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
		$countries = Country::factory(100)->create();
		foreach ($countries as $country)
		{
			Statistics::factory()->create(['country_id' => $country->id]);
		}
	}
}
