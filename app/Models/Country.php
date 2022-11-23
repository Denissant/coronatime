<?php

namespace App\Models;

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
}
