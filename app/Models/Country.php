<?php

namespace App\Models;

use DB;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
	use HasTranslations;

	protected $guarded = [];

	public array $translatable = ['name'];

	public function statistics()
	{
		return $this->hasOne(Statistics::class, 'country_id');
	}

	public static function updateAllStatistics($updateExisting)
	{
		$countries = Country::where('code', '!=', 'GLOBAL')->get();
		$summedData = [
			'confirmed'  => 0,
			'recovered'  => 0,
			'deaths'     => 0,
		];

		// Update Statistics for each country
		DB::beginTransaction();
		foreach ($countries as $country)
		{
			$statisticsData = $country->fetchStatistics();
			$summedData['confirmed'] += $statisticsData['confirmed'];
			$summedData['recovered'] += $statisticsData['recovered'];
			$summedData['deaths'] += $statisticsData['deaths'];
			$country->updateStatistics($statisticsData, $updateExisting);
		}
		DB::commit();

		// Update Global Statistics
		$globalCountryId = Country::where('code', 'GLOBAL')->first()->id;
		if ($updateExisting)
		{
			Statistics::where('country_id', $globalCountryId)->update($summedData);
		}
		else
		{
			$statistics = Statistics::create(array_merge($summedData, ['country_id' => $globalCountryId]));
			$statistics->save();
		}
	}

	public function updateStatistics($statisticsData, $updateExisting)
	{
		if ($updateExisting)
		{
			Statistics::where('country_id', $this->id)->update($statisticsData);
		}
		else
		{
			$statistics = Statistics::create(array_merge($statisticsData, ['country_id' => $this->id]));
			$statistics->save();
		}
	}

	protected function fetchStatistics()
	{
		$client = new Client();
		$response = $client->request(
			'POST',
			'https://devtest.ge/get-country-statistics',
			[RequestOptions::JSON => ['code' => $this->code]]
		);
		$result = $response->getBody();
		$result = json_decode($result, true);
		return array_diff_key($result, array_flip(['id', 'country', 'code', 'critical', 'created_at', 'updated_at']));
	}
}
