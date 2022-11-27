<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
	public function edit($locale)
	{
		app()->setLocale($locale);
		session()->put('locale', $locale);
		return redirect()->back();
	}
}
