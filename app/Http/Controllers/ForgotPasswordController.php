<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
	public function forgot()
	{
		return view('auth.forgot');
	}

	public function email(ForgotPasswordRequest $request)
	{
		$request->validated();

		$status = Password::sendResetLink(
			$request->only('email')
		);

		return $status === Password::RESET_LINK_SENT
			? redirect()->route('confirmation-splash')
			: back()->withErrors(['email' => __($status)]);
	}
}
