<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
	/**
	 * Transforma o resultado do JSON do objeto quando enviado à view, no 
	 * modelo abaixo
	 * 
	 * @param  Project $project 
	 * @return array           
	 */
	public function transform(User $member)
	{
		return [
			'member_id'   => $member->id,
		];
	}
}