<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientTest extends TestCase
{
    public function testClientGetAll()
    {
        $this->get('/client')->seeJson();
    }

    public function testClientGetId()
    {
        $this->get('/client/1')->seeJson();
    }

    public function testClientPost()
    {
        $this->post('/client', [
            'name'        => "Test Name",
            'responsible' => "Test Responsible",
            'email'       => "teste@email.com",
            'phone'       => "1111111111",
            'address'     => "Rua dos Bobos, 0",
            'obs'         => "bla",
        ])->seeJson();
    }

    public function testClientPut()
    {
        $this->put('/client/11', [
            'name'        => "Test Name2",
            'responsible' => "Test Responsible2",
            'email'       => "teste2@email.com",
            'phone'       => "2222222222",
            'address'     => "Rua dos Bobos, 1",
            'obs'         => "bla2",
        ])->seeJson();
    }

}