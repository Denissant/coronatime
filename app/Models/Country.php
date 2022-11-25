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
		if ($searchQuery)
		{
			$query->where(
				fn ($query) => $query->where('name', 'like', '%' . $searchQuery . '%')
			);
		}
	}
}
