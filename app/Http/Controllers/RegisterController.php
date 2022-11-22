<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
	public function register()
	{
		return view('auth.register');
	}

	public function store(RegisterRequest $request)
	{
		$attributes = $request->validated();
		$user = User::create($attributes);
		event(new Registered($user));

		return redirect()->route('confirmation-splash');
	}
}
