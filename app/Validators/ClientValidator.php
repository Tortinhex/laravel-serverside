<?php

namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
	protected $rules = [
		'name'        => 'required|min:2|max:255',
		//'responsible' => 'required|max:255',
		//'email'       => 'required|email',
		//'phone'       => 'required',
		//'address'     => 'required'
	];
}