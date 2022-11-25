<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function statistics()
	{
		return $this->belongsTo(Country::class);
	}

	public static function getWorldwideStats($allStats)
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
