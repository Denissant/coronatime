<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
	use HasFactory;

	use HasTranslations;

	protected $guarded = [];

	public array $translatable = ['name'];

	public function statistics()
	{
		return $this->hasOne(Statistics::class, 'country_id');
	}

	public function scopeFilter(Builder $query, $searchQuery)
	{
		$locale = app()->getLocale();

		if ($searchQuery)
		{
			$query->where(
				function ($query) use ($searchQuery, $locale) {
					if ($locale === 'en')
					{
						$query->where('name', 'like', '%' . $searchQuery . '%');
					}
					else
					{
						$query->where("name->$locale", 'like', '%' . $searchQuery . '%');
					}
				}
			);
		}
	}
}
