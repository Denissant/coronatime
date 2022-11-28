<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
	public function login()
	{
		return view('auth.login');
	}

	public function authenticate(LoginRequest $request)
	{
		$attributes = $request->validated();
		$remember = request('remember-me') === 'on';

		if (User::firstWhere('email', $attributes['username']))
		{
			$attributes['email'] = $attributes['username'];
			unset($attributes['username']);
		}

		if (auth()->attempt($attributes, $remember))
		{
			session()->regenerate();
			if (!auth()->user()->hasVerifiedEmail())
			{
				auth()->logout();
				return back()
					->withInput()
					->withErrors(['username' => __('validation.verify')]);
			}
			return redirect()->route('dashboard.home');
		}

		return back()
			->withInput()
			->withErrors(['password' => __('validation.invalid_credentials')]);
	}

	public function logout()
	{
		auth()->logout();

		return redirect()->route('dashboard.home');
	}
}
