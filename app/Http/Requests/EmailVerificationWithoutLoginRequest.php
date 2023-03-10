<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationWithoutLoginRequest extends EmailVerificationRequest
{
	public function authorize()
	{
		$user = User::find($this->route('id'));

		if (!hash_equals(
			(string) $this->route('hash'),
			sha1($user->getEmailForVerification())
		))
		{
			return false;
		}

		return true;
	}

	public function fulfill()
	{
		$user = User::find($this->route('id'));

		if (!$user->hasVerifiedEmail())
		{
			$user->markEmailAsVerified();

			event(new Verified($user));
		}
	}
}
