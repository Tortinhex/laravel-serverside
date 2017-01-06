<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectRepository;
use App\Services\ProjectService;

class ProjectController extends Controller
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
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectRepository $repository, 
        ProjectService $service)
    {
        $this->repository = $repository;
        $this->service    = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->findWhere([
            'owner_id' => \Authorizer::getResourceOwnerId()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if(!$this->checkProjectOwner($id)) {
            return [
                'error'   => true,
                'message' => "Access forbidden"
            ];
        } 

        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$this->checkProjectOwner($id)) {
            return [
                'error'   => true,
                'message' => "Access forbidden"
            ];
        } 

        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function checkProjectOwner($projectId)
    {
        $userId    = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($projectId, $userId);
    }

}
