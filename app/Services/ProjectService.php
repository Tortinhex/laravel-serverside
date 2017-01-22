<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\ProjectRepository;
use App\Validators\ProjectValidator;
use App\Entities\Project;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectService extends AbstractService
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var File
     */
    private $file;

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectRepository $repository, 
                                ProjectValidator $validator,
                                Filesystem $file,
                                Storage $storage)
    {
        parent::__construct($repository, $validator, 'Projeto');
        $this->file    = $file;
        $this->storage = $storage;
    }

    /**
     * Verifica as permissões (se existir) para a funcao em $action
     * 
     * @param  mixed   $data    Parametro a ser verificado
     * @param  string  $action  Ação CRUD
     * @return boolean|array 
     */
    public function checkPermission($id, $action = '')
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

    /**
     * Adiciona um Membro no Projeto
     * 
     * @param int    $id       ID do Projeto
     * @param int    $memberId ID do Membro
     * @return array           Resultado
     */
    public function addMember($id, $memberId)
    {
        try {
            $checkIsMember = $this->isMember($id, $memberId);
            if(!$checkIsMember['error']) {
                return [
                    'error'   => true,
                    'message' => "Membro ID {$memberId} já está relacionado ao projeto"
                ];
            }

            $this->repository->find($id)->members()->attach($memberId);
            return [
                'error'   => false,
                'message' => "Membro ID {$memberId} adicionado"
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'ID não encontrado'
            ];
        }
    }

    /**
     * Remove um Membro do Projeto
     * 
     * @param  int   $id          ID do Projeto
     * @return array           Resultado
     * @param  int   $memberId ID do Membro
     */
    public function removeMember($id, $memberId)
    {
        try {
            $checkIsMember = $this->isMember($id, $memberId);
            if($checkIsMember['error']) {
                return $checkIsMember;
            }

            $this->repository->find($id)->members()->detach($memberId);
            return [
                "error"   => false,
                "message" => "Membro ID {$memberId} foi removido"
            ];

        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'ID não encontrado'
            ];
        }
    }

    /**
     * Verifica se o Membro pertence ao Projeto
     * 
     * @param  int   $id       ID do Projeto
     * @param  int   $memberId ID do Membro
     * @return array           Resultado
     */
    public function isMember($id, $memberId)
    {
        try {
            $member = $this->repository->find($id)->members()->find($memberId);
            if($member) {
                return [
                    'error'   => false,
                    'message' => "Membro {$memberId} pertence ao projeto"
                ];
            }

            return [
                'error' => true,
                'message' => "Membro {$memberId} não pertence ao projeto"
            ];

        } catch(ModelNotFoundException $ex) {
            return [
                'error' => true,
                'message' => 'ID não encontrado'
            ];
        }
    }

    public function createFile(array $data)
    {
        $this->storage->put($data['name'] . "." . $data['extension'], $this->file->get($data['file']));
    }

}