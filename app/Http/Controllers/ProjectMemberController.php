<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectMemberRepository;
use App\Services\ProjectMemberService;
use App\Services\ProjectService;

class ProjectMemberController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var ClientService
     */
    private $service;

    /**
     * @var ProjectService
     */
    private $projectService;

    /**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(
        ProjectMemberRepository $repository,  
        ProjectMemberService $service,
        ProjectService $projectService
    )
    {
        $this->repository     = $repository;
        $this->service        = $service;
        $this->projectService = $projectService;
    }

    /**
     * Exibe a listagem de membros de um projeto específico
     * 
     * @param  int    $id ID do projeto
     * @return object     Membros do projeto
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Adiciona um membro no projeto
     * 
     * @param Request $request 
     * @param int     $id      ID do projeto
     * @return array
     */
    public function create(Request $request, $id)
    {
        $memberId = $request->get('member_id');
        return $this->projectService->addMember($id, $memberId);
    }

    /**
     * Remove um membro do projeto
     * 
     * @param  int   $id       ID do Projeto
     * @param  int   $memberId ID do Membro
     * @return array           
     */
    public function delete($id, $memberId)
    {
        return $this->projectService->removeMember($id, $memberId);
    }

}
