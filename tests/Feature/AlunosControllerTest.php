<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Alunos;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunosControllerTest extends TestCase
{
    /*
    * @test
    */
    public function testeRotaIndexAlunos()
    {
        $response = $this->get(route('alunos.index'));
        $response->assertSuccessful();
        $response->assertViewIs('alunos.index');
        $response->assertViewHas('alunos');
    }

}
