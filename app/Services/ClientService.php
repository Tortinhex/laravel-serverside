<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use App\Validators\ClientValidator;

class ClientService extends AbstractService
{

	/**
     * @author Danilo Dorotheu <danilo.dorotheu@live.com>
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        parent::__construct($repository, $validator, 'Cliente');
    }

}   