<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidatorValidator extends LaravelValidator
{

    protected $rules = [
        'project_id' => 'required|integer',
		'title'      => 'required',
		'note'       => 'required',
   ];
}
