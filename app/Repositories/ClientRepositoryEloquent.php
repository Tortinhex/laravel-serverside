<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Entities\Client;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
	public function model()
	{
		return Client::class;
	}
}