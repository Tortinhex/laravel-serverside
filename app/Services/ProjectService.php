<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Validators\ProjectValidator;

class ProjectService extends AbstractService
{

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        parent::__construct($repository, $validator, 'Projeto');
    }

}