<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cursos;
use App\Alunos;
use App\Matriculas;

class MatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Alunos::orderBy('nome', 'asc')->get();
        $cursos = Cursos::orderBy('titulo', 'asc')->get();
        $matriculas = Matriculas::all();
        return view('matriculas.index', ['alunos' => $alunos, 'cursos' => $cursos, 'matriculas' => $matriculas]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'aluno_id' => 'required',
            'curso_id' => 'required',
        ]);

        if (Matriculas::where('aluno_id', $request->aluno_id)->where('curso_id', $request->curso_id)->first()) {
            return redirect('matriculas')->with('error', 'Este Aluno já está cadastrado neste Curso.');
        }

        Matriculas::create([
            'aluno_id' => $request->aluno_id,
            'curso_id' => $request->curso_id,
        ]);
        return redirect('matriculas')->with('status', 'Matricula Realizada com Sucesso');
    }


    public function deletaMatricula($id)
    {
        Matriculas::destroy($id);
        return redirect('matriculas')->with('status', 'Matricula deletada com Sucesso');
    }

    public function editarMatricula(Request $request)
    {
        $matricula = Matriculas::where('id', $request->matricula_id)->first();
        $matricula->aluno_id = $request->aluno_id;
        $matricula->curso_id = $request->curso_id;
        $matricula->save();
        return redirect('matriculas')->with('status', 'Matricula Editada com Sucesso');
    }
}
