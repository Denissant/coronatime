<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
	protected $guarded = [];

	public function statistics()
	{
		return $this->belongsTo(Country::class);
	}
}
