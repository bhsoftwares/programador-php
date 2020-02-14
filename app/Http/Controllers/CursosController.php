<?php

namespace App\Http\Controllers;

use App\Cursos;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Cursos::all();
        return view ('cursos.index', ['cursos' => $cursos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('cursos.create');
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
            'titulo' => 'required|unique:cursos', 
        ];

        $mensagens = [
            'titulo.required' => 'Por favor, inserir o nome do curso',
            'titulo.unique' => 'Nome do curso já existe'
        ];

        $request->validate($regras, $mensagens);

        $curso = new Cursos();
        $curso->titulo = $request->titulo;
        $curso->descricao = $request->descricao;
        $curso->save();

        return redirect()->route('cursos.index')->with('success', 'Curso cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Cursos::findOrFail($id);
        if($curso == null){
            return back()->with('error', 'Este curso não existe');
        }

        return view('cursos.show', ['curso' => $curso]);
    }

    public function edit($id)
    {
        $curso = Cursos::findOrFail($id);
        return view('cursos.edit', ['curso' => $curso ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $curso = Cursos::findOrFail($id);

        if($curso == null) {
            return back()->with('error', 'Este curso não existe');
        }

        $regras = [
            'titulo' => 'required|unique:cursos', 
        ];

        $mensagens = [
            'titulo.required' => 'Por favor, inserir o nome do curso',
            'titulo.unique' => 'Nome do curso já existe'
        ];

        $request->validate($regras, $mensagens);

        $curso->titulo = $request->titulo;
        $curso->descricao = $request->descricao;
        $curso->save();

        return redirect()->route('cursos.index')->with('success', 'Curso alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Cursos::findOrFail($id);
        if($curso == null){
            return back()->with('error', 'Este curso não existe');
        }

        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso deletado com sucesso');

    }
}
