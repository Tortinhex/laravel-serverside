<?php

namespace App\Services;

use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AbstractService
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
     * Contém o nome da entidade
     */
    private $name;

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct($repository, $validator, $name = 'Registro')
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->name       = $name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        try {
            return $this->repository->find($id);

        } catch(ModelNotFoundException $e) {
            return [
                "message" => "{$this->name} não foi encontrado",
                "error"   => true
            ];
        } catch(\Exception $e) {
            return [
                'error'   => true, 
                'message' => "Ocorreu algum erro ao consultar o {$this->name}."
            ];
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array $data
     */
    public function create(array $data)
    {
    	try {

    		$this->validator->with($data)->passesOrFail();
    		return $this->repository->create($data);

    	} catch(ValidatorException $e){
    		return [
    			'error'   => true,
    			'message' => $e->getMessageBag()
    		];
    	} catch(\Exception $e) {
            return [
                'error'   => true, 
                'message' => "Ocorreu algum erro ao incluir o {$this->name}."
            ];
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  int  $id
     */
    public function update(array $data, $id)
    {
    	try {

    		$this->validator->with($data)->passesOrFail();
    		return $this->repository->update($data, $id);

    	} catch(ValidatorException $e){
    		return [
    			'error'   => true,
    			'message' => $e->getMessageBag()
    		];
    	} catch (ModelNotFoundException $e) {
            return [
                'error'   => true, 
                'message' => "{$this->name} não encontrado."
            ];
        } catch(\Exception $e) {
            return [
                'error'   => true, 
                'message' => "Ocorreu algum erro ao atualizar o {$this->name}."
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
        try {
            $this->repository->find($id)->delete();
            return [
                'success' => true, 
                'message' => "{$this->name} deletado com sucesso!"
            ];
        } catch (QueryException $e) {
            return [
                'error'   => true, 
                'message' => "{$this->name} Projeto não pode ser apagado pois existe um ou mais clientes vinculados a ele."
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error'   => true, 
                'message' => "{$this->name} não encontrado."
            ];
        } catch (\Exception $e) {
            return [
                'error'   => true, 
                'message' => " Ocorreu algum erro ao excluir o {$this->name}."
            ];
        }
    }

}