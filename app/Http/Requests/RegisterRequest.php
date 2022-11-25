<?php

namespace App\Http\Requests;

use App\Rules\NotEmail;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'username' => ['required', 'max:255', 'min:3', 'unique:users,username', new NotEmail],
			'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
			'password' => ['required', 'confirmed', 'max:255', 'min:3'],
		];
	}
}
