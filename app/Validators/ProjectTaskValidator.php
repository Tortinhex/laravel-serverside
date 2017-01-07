<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name'       => 'required',
        'status'     => 'required',
        'due_date'   => 'required',
        'start_date' => 'required',
   ];
}
