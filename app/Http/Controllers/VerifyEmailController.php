<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationWithoutLoginRequest;

class VerifyEmailController extends Controller
{
	public function index(EmailVerificationWithoutLoginRequest $request)
	{
		$request->fulfill();

		return redirect()->route('email-splash');
	}
}
