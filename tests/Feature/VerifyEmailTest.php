<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use URL;

class VerifyEmailTest extends TestCase
{
	use RefreshDatabase;

	public function test_that_email_gets_verified_when_email_verification_link_is_opened()
	{
		$user = User::create([
			'username' => 'myusername',
			'email'    => 'mail@mail.com',
			'password' => 'password',
		]);
		$user->save();
		$this->assertFalse($user->hasVerifiedEmail());

		$verificationURL = (new VerifyEmail)->toMail($user)->actionUrl;
		$response = $this->get($verificationURL);

		$response->assertRedirect(route('email-splash'));
		$user->refresh();
		$this->assertTrue($user->hasVerifiedEmail());
	}

	public function test_email_verification_requires_a_valid_email_signature()
	{
		$user = User::create([
			'username' => 'myusername',
			'email'    => 'mail@mail.com',
			'password' => 'password',
		]);
		$user->save();
		$this->assertFalse($user->hasVerifiedEmail());

		$verificationURL = URL::temporarySignedRoute(
			'verification.verify',
			now()->addMinutes(60),
			['id' => $user->id, 'hash' => sha1('WRONG_MAIL@mail.com')]
		);
		$response = $this->get($verificationURL);
		$response->assertStatus(403);

		$user->refresh();
		$this->assertFalse($user->hasVerifiedEmail());
	}
}
