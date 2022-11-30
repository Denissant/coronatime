<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
	use RefreshDatabase;

	public function test_default_locale_is_english()
	{
		$this->assertTrue($this->app->currentLocale() === 'en');

		$response = $this->get(route('dashboard.home'));
		$response->assertSee('Worldwide');
		$response->assertDontSee('მსოფლიოში');
	}

	public function test_locale_can_be_changed()
	{
		$this->assertTrue($this->app->currentLocale() === 'en');

		$this->get(route('language', 'ka'));
		$this->assertTrue($this->app->currentLocale() === 'ka');

		$response = $this->get(route('dashboard.home'));
		$response->assertSee('მსოფლიოში');
		$response->assertDontSee('Worldwide');

		$this->get(route('language', 'en'));
		$this->assertTrue($this->app->currentLocale() === 'en');

		$response = $this->get(route('dashboard.home'));
		$response->assertSee('Worldwide');
		$response->assertDontSee('მსოფლიოში');
	}
}
