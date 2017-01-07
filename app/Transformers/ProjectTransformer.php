<?php

namespace App\Transformers;

use App\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

	protected $defaultIncludes = ['members'];
	/**
	 * Transforma o resultado do JSON do objeto quando enviado à view, no 
	 * modelo abaixo
	 * 
	 * @param  Project $project 
	 * @return array           
	 */
	public function transform(Project $project)
	{
		return [
			'project_id'  => $project->id,
			'project'     => $project->name,
			'description' => $project->description,
			'progress'    => $project->progress,
			'status'      => $project->status,
			'due_date'    => $project->due_date,
		];
	}

	public function includeMembers(Project $project)
	{
		return $this->collection($project->members, new ProjectMemberTransformer());
	}
}