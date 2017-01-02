<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectNoteService
{

	/**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var ClientValidator
     */
    private $validator;

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array $data
     * @return array
     */
    public function create(array $data)
    {
        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);

        }catch(ValidatorException $e){
            return [
                'error'   => true,
                'message' => $e->getMessageBack()
            ];
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $data, $id)
    {
        try {

            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

        }catch(ValidatorException $e){
            return [
                'error'   => true,
                'message' => $e->getMessageBag()
            ];
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
    }

}