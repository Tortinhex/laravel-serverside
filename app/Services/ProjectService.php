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

    /**
     * Checa as permissões 
     * @override
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function checkPermission(int $id, $action = '')
    {
    	// Não é desejado fazer a verificação nessas funcoes CRUD no momento
    	if('create' == $action or 'destroy' == $action){
    		return true;
    	}

    	if($this->checkProjectOwner($id) or $this->checkProjectMember($id)) {
            return true;
        }

        return [
        	'error'   => true,
        	'message' => "Access forbidden"
        ];
    }

    /**
     * Verifica se o usuário é owner do $projectId
     * 
     * @param  [int]     $projectId ID do projeto a ser verificado
     * @return [boolean] 
     */
    public function checkProjectOwner($projectId)
    {
        $userId    = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

    /**
     * Verifica se o usuário é membro do $projectId
     * 
     * @param  [int]     $projectId ID do projeto a ser verificado
     * @return [boolean]       
     */
    public function checkProjectMember($projectId)
    {
        $userId    = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($projectId, $userId);
    }

}