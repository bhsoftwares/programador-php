<?php

namespace App\Http\Controllers;

use App\Alunos;
use App\Cursos;
use App\Matricula;
use Illuminate\Http\Request;

class MatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matriculas = Matricula::all();
        return view('matriculas.index', ['matriculas' => $matriculas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alunos = Alunos::all();
        $cursos = Cursos::all();

        return view('matriculas.create', [
            'alunos' => $alunos,
            'cursos' => $cursos
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
        $regras = [
            'alunos_id' => 'required',
            'cursos_id' => 'required'
        ];

        $mensagens = [
            'alunos_id.required' => 'Por favor, escolha o aluno',
            'cursos_id.required' => 'Por favor, escolha o(s) curso(s) do aluno'
        ];

        $request->validate($regras, $mensagens);

        $matricula = new Matricula();

        $matricula->aluno_id = $request->alunos_id;

        $matricula->save();

        $matricula->cursos()->attach($request->cursos_id);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula realizada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $alunos = Alunos::all();
        $cursos = Cursos::all();
        $matricula = Matricula::findOrFail($id);

        return view('matriculas.edit', [
            'alunos' => $alunos,
            'cursos' => $cursos,
            'matricula' => $matricula
        ]);
    }

    public function update(Request $request, $id)
    {
        $matricula = Matricula::findOrFail($id);

        $regras = [
            'cursos_id' => 'required'
        ];

        $mensagens = [
            'cursos_id.required' => 'Por favor, escolha o(s) curso(s) do aluno'
        ];

        $request->validate($regras, $mensagens);

        $matricula->cursos()->detach();

        $matricula->save();

        $matricula->cursos()->attach($request->cursos_id);

        return redirect()->route('matriculas.index')->with('success', 'Matrícula atualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Matricula::destroy($id);
        return redirect()->route('matriculas.index')->with('success', 'Matricula deletada');
    }
}
