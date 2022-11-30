<?php

namespace Tests\Feature;

use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
	use RefreshDatabase;

	public function test_reset_password_page_is_accessible()
	{
		$response = $this->get($this->generatePasswordResetLink('mail@mail.com', 'mytoken'));
		$response->assertSuccessful();
		$response->assertSee(__('auth.reset'));
		$response->assertViewIs('auth.change-password');
	}

	public function test_can_reset_password_with_valid_input()
	{
		$email = 'mail@mail.com';
		$old_password = 'old_password';
		$new_password = 'new_password';
		$user = $this->createUser('name', $email, $old_password);
		$token = $this->getToken($user);

		auth()->attempt(['email' => $email, 'password' => $old_password]);
		$this->assertAuthenticatedAs($user);
		auth()->logout();
		$this->assertGuest();

		$this->generatePasswordResetLink($email, $token);
		$response = $this->post(route('password.update'), [
			'password'              => $new_password,
			'password_confirmation' => $new_password,
			'token'                 => $token,
			'email'                 => $email,
		]);

		$response->assertSessionHasNoErrors();
		$response->assertRedirect(route('password-splash'));

		auth()->attempt(['email' => $email, 'password' => $old_password]);
		$this->assertGuest();

		auth()->attempt(['email' => $email, 'password' => $new_password]);
		$this->assertAuthenticatedAs($user);
	}

	public function test_can_not_reset_password_with_invalid_token()
	{
		$email = 'mail@mail.com';
		$new_password = 'new_password';
		$user = $this->createUser('name', $email, 'pass');
		$token = $this->getToken($user);

		$this->generatePasswordResetLink($email, $token);
		$wrong_user = $this->createUser('other_name', 'other_mail@mail.com', 'pass');
		$response = $this->post(route('password.update'), [
			'password'              => $new_password,
			'password_confirmation' => $new_password,
			'token'                 => $this->getToken($wrong_user),
			'email'                 => $email,
		]);

		$response->assertSessionHasErrors([
			'email' => __('passwords.token'),
		]);
	}

	public function test_can_not_reset_password_with_wrong_email()
	{
		$email = 'mail@mail.com';
		$new_password = 'new_password';
		$user = $this->createUser('name', $email, 'pass');
		$token = $this->getToken($user);

		$this->generatePasswordResetLink($email, $token);
		$this->createUser('other_name', 'WRONG_EMAIL@mail.com', 'pass');
		$response = $this->post(route('password.update'), [
			'password'              => $new_password,
			'password_confirmation' => $new_password,
			'token'                 => $token,
			'email'                 => 'WRONG_EMAIL@mail.com',
		]);

		$response->assertSessionHasErrors([
			'email' => __('passwords.token'),
		]);
	}

	public function test_passwords_should_match_to_reset_password()
	{
		$email = 'mail@mail.com';
		$new_password = 'new_password';
		$user = $this->createUser('name', $email, 'pass');
		$token = $this->getToken($user);

		$this->generatePasswordResetLink($email, $token);
		$response = $this->post(route('password.update'), [
			'password'              => $new_password,
			'password_confirmation' => 'WRONG_PASSWORD',
			'token'                 => $token,
			'email'                 => $email,
		]);

		$response->assertSessionHasErrors([
			'password' => __('validation.confirmed', ['attribute' => 'password']),
		]);
	}

	public function test_all_fields_are_required_to_reset_password()
	{
		$user = $this->createUser('name', 'mail@mail.com', 'pass');
		$this->generatePasswordResetLink('mail@mail.com', $this->getToken($user));
		$response = $this->post(route('password.update'));

		$response->assertSessionHasErrors([
			'email'    => __('validation.required', ['attribute' => 'email']),
			'token'    => __('validation.required', ['attribute' => 'token']),
			'password' => __('validation.required', ['attribute' => 'password']),
		]);
	}

	public function test_password_should_be_longer_than_two_characters_to_reset_password()
	{
		$email = 'mail@mail.com';
		$new_password = 'P';
		$user = $this->createUser('name', $email, 'pass');
		$token = $this->getToken($user);

		$this->generatePasswordResetLink($email, $token);
		$response = $this->post(route('password.update'), [
			'password'              => $new_password,
			'password_confirmation' => $new_password,
			'token'                 => $token,
			'email'                 => $email,
		]);

		$response->assertSessionHasErrors([
			'password' => __('validation.min.string', ['attribute' => 'password', 'min' => 3]),
		]);
	}

	private function getToken($user): string
	{
		return Password::broker('users')->createToken($user);
	}

	private function generatePasswordResetLink($email, $token)
	{
		DB::table('password_resets')->insert([
			'email' => $email,
			'token' => $token,
		]);
		return route('password.reset', $token);
	}

	private function createUser($username, $email, $password): User
	{
		$user = User::create([
			'username' => $username,
			'email'    => $email,
			'password' => $password,
		]);
		$user->save();
		return $user;
	}
}
