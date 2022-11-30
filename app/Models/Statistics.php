<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
	use HasFactory;

	protected $guarded = [];

	public static function getWorldwideStats()
	{
		$worldwideStats = [
			'confirmed' => 0,
			'recovered' => 0,
			'deaths'    => 0,
		];

		foreach (Statistics::all() as $statistics)
		{
			$worldwideStats['confirmed'] += $statistics['confirmed'];
			$worldwideStats['recovered'] += $statistics['recovered'];
			$worldwideStats['deaths'] += $statistics['deaths'];
		}

		return $worldwideStats;
	}
}
