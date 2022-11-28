<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('components.dashboard.lang-switch', function ($view) {
			$locales = [
				'en' => 'English',
				'ka' => 'ქართული',
			];
			$view->with('current_locale', $locales[app()->getLocale()]);
		});
	}
}
