<?php

namespace Tests\Feature;

use App\Cursos;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CursosControllerTest extends TestCase
{
    /*
    * @test
    */
    public function testeRotaIndexCursos()
    {
        $response = $this->get(route('cursos.index'));
        $response->assertSuccessful();
        $response->assertViewIs('cursos.index');
        $response->assertViewHas('cursos');
    }


    /*
    * @test
    */
    public function testeRotaShowCursos()
    {
        $curso = Cursos::get()->random();
        $response = $this->get(route('cursos.show', ['id' => $curso->id]));
        $response->assertViewIs('cursos.show');
        $response->assertViewHas('curso');
        $cursoRetornado = $response->original->curso;
        $this->assertEquals($curso->id, $cursoRetornado->id, 
            "O curso retornado é diferente do primeiro requisitado");
    }


    /*
    * @test
    */
    public function testeCreateCursos()
    {
        $dados = [
            'titulo' => Str::random(20),
            'descricao' => Str::random(30)
        ];

        $cursos = factory(Cursos::class)->create([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao']
        ]);

        $ultimoCursoCriado = Cursos::findOrFail($cursos->id);
        
        $this->assertInstanceOf(Cursos::class, $ultimoCursoCriado);
        $this->assertEquals($dados['titulo'], $ultimoCursoCriado->titulo);
        $this->assertEquals($dados['descricao'], $ultimoCursoCriado->descricao);
    }



    
}
