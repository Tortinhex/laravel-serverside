<?php

namespace App\Services;

use App\Repositories\ProjectMemberRepository;
use App\Validators\ProjectMemberValidator;

class ProjectMemberService extends AbstractService
{

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectMemberRepository $repository, ProjectMemberValidator $validator)
    {
        parent::__construct($repository, $validator, 'Projeto');
    }

}