<?php

namespace App\Services;

use App\Repositories\ProjectTaskRepository;
use App\Validators\ProjectTaskValidator;

class ProjectTaskService extends AbstractService
{

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        parent::__construct($repository, $validator, 'Task');
    }

}