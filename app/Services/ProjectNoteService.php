<?php

namespace App\Services;

use App\Repositories\ProjectNoteRepository;
use App\Validators\ProjectNoteValidator;

class ProjectNoteService extends AbstractService
{

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        parent::__construct($repository, $validator, 'Projeto');
    }

}