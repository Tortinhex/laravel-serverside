<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProjectRepository;
use App\Entities\Project;
use App\Presenters\projectPresenter;
use App\Validators\ProjectValidator;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Verifica se um usuário é dono de um projeto específico
     * 
     * @param  [int]  $projectId ID do Projeto
     * @param  [int]  $userId    ID do Usuário
     * @return boolean           
     */
    public function isOwner($projectId, $userId)
    {
        if(count($this->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
            return true;
        }

        return false;
    }

    /**
     * verifica se um usuário é membro de um projeto específico
     * 
     * @param  [int]  $projectId ID do Projeto
     * @param  [int]  $member    ID do Projeto
     * @return boolean
     */
    public function hasMember($projectId, $memberId)
    {
        $project = $this->find($projectId);
        foreach ($project->members as $member) {
            if($member->id == $memberId) {
                return true;
            }
        }
        return false;
    }
    /*
    public function presenter()
    {
        return projectPresenter::class;
    }
    */
}
