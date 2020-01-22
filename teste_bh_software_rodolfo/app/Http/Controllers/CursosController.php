<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cursos;

class CursosController extends Controller
{

    public function index()
    {
        return view('cursos.index');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'titulo' => 'required|unique:cursos|max:255',
            'descricao' => 'required',
        ]);

        Cursos::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao
        ]);

        return response()->json(['status' => 'success', 'msg' => 'Curso Cadastrado com Sucesso!']);
    }

    public function getAllCursos()
    {
        return response()->json(['data' => Cursos::orderby('titulo', 'asc')->get()]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function deletaCurso($id)
    {
        Cursos::destroy($id);
        return response()->json(['status' => 'success', 'msg' => 'Curso deletado com Sucesso!']);
    }

    public function getCurso($id)
    {
        $curso = Cursos::where('id', $id)->first();
        return response()->json($curso);
    }

    public function editCurso(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descricao' => 'required',
        ]);

        $curso = Cursos::where('id', $id)->first();
        $curso->titulo = $request->titulo;
        $curso->descricao = $request->descricao;
        $curso->save();                
        return response()->json(['status' => 'success', 'msg' => 'Curso editado com Sucesso!']);
    }
}
