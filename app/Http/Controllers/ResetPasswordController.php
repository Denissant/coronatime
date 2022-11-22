<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
	public function reset($token)
	{
		return view('auth.change-password', ['token' => $token]);
	}

	public function update(ResetPasswordRequest $request)
	{
		$request->validated();

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) {
				$user->forceFill([
					'password' => $password,
				]);

				$user->save();

				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
			? redirect()->route('password-splash')->with('status', __($status))
			: back()->withErrors(['email' => [__($status)]]);
	}
}
