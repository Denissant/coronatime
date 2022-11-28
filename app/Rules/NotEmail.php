<?php

namespace App\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;
use Illuminate\Contracts\Validation\InvokableRule;

class NotEmail implements InvokableRule
{
	public function __invoke($attribute, $value, $fail)
	{
		if ((new EmailValidator)->isValid($value, new RFCValidation()))
		{
			$fail(__('validation.not_email'));
		}
	}
}
