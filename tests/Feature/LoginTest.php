<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
	use RefreshDatabase;

	public function test_login_page_is_accessible()
	{
		$response = $this->get(route('login'));
		$response->assertSuccessful();
		$response->assertSee(__('auth.login_welcome'));
		$response->assertViewIs('auth.login');
	}

	public function test_can_login_with_valid_username_and_password()
	{
		$user = $this->createUser('myusername', 'mail@mail.com', 'mypassword', true);
		$response = $this->post(route('login'), [
			'username' => 'myusername',
			'password' => 'mypassword',
		]);

		$response->assertRedirect();
		$this->assertAuthenticatedAs($user);
	}

	public function test_can_login_with_valid_email_and_password()
	{
		$user = $this->createUser('myusername', 'mail@mail.com', 'mypassword', true);
		$response = $this->post(route('login'), [
			'username' => 'mail@mail.com',
			'password' => 'mypassword',
		]);

		$response->assertRedirect();
		$this->assertAuthenticatedAs($user);
	}

	public function test_need_to_verify_email_to_login()
	{
		$this->createUser('myusername', 'mail@mail.com', 'mypassword');
		$response = $this->post(route('login'), [
			'username' => 'myusername',
			'password' => 'mypassword',
		]);

		$response->assertSessionHasErrors(['username' => __('validation.verify')]);
		$this->assertGuest();
	}

	public function test_can_not_login_with_invalid_credentials()
	{
		$this->createUser('myusername', 'mail@mail.com', 'mypassword');
		$response = $this->post(route('login'), [
			'username' => 'WRONG_USERNAME',
			'password' => 'mypassword',
		]);

		$response->assertSessionHasErrors(['password' => __('validation.invalid_credentials')]);
		$this->assertGuest();

		$response = $this->post(route('login'), [
			'username' => 'myusername',
			'password' => 'WRONG_PASSWORD',
		]);

		$response->assertSessionHasErrors(['password' => __('validation.invalid_credentials')]);
		$this->assertGuest();
	}

	public function test_can_log_out()
	{
		$user = $this->createUser('myusername', 'mail@mail.com', 'mypassword', true);
		$this->post(route('login'), [
			'username' => 'myusername',
			'password' => 'mypassword',
		]);

		$this->assertAuthenticatedAs($user);
		$response = $this->post(route('logout'));
		$response->assertRedirect();
		$this->assertGuest();
	}

	public function test_can_remember_device_if_remember_me_is_checked()
	{
		$user = $this->createUser('myusername', 'mail@mail.com', 'mypassword', true);
		$this->post(route('login'), [
			'username'    => 'myusername',
			'password'    => 'mypassword',
			'remember-me' => 'on',
		]);

		$this->assertAuthenticatedAs($user);
		$user->refresh();
		$this->assertNotNull($user->remember_token);
	}

	public function test_device_is_not_remembered_when_remember_me_is_unchecked()
	{
		$user = $this->createUser('myusername', 'mail@mail.com', 'mypassword', true);
		$this->post(route('login'), [
			'username'    => 'myusername',
			'password'    => 'mypassword',
		]);

		$this->assertAuthenticatedAs($user);
		$user->refresh();
		$this->assertNull($user->remember_token);
	}

	private function createUser($username, $email, $password, $forceVerify = false): User
	{
		$user = User::create(
			[
				'username'          => $username,
				'email'             => $email,
				'password'          => $password,
			]
		);
		if ($forceVerify)
		{
			$user->forceFill(['email_verified_at' => now()]);
		}
		$user->save();
		return $user;
	}
}
