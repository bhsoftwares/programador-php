<?php

namespace App\Http\Controllers;

use App\Alunos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Alunos::all();
        return view('alunos.index', ['alunos' => $alunos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alunos.create');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $alunos = DB::table('alunos')->where('nome', 'like', '%' .$search. '%', 'or')
            ->orWhere('email', 'like', '%' .$search. '%')
            ->paginate(5);
        return view('alunos.index', ['alunos' => $alunos]);
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
            'nome' => 'required',
            'email' => 'required|unique:alunos',
        ];

        $mensagens = [
            'nome.required' => 'Por favor, insira o nome do aluno',
            'email.required' => 'Por favor, insira o email',
            'email.unique' => 'Este e-mail já existe'
        ];

        $request->validate($regras, $mensagens);

        $aluno = new Alunos();
        $aluno->nome = $request->nome;
        $aluno->email = $request->email;
        $aluno->data_nasc = $request->data_nasc;
        $aluno->save();

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso');
    }

    public function edit($id)
    {
        $aluno = Alunos::findOrFail($id);
        return view('alunos.edit', ['aluno' => $aluno]);
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
        $aluno = Alunos::findOrFail($id);

        if($aluno == null){
            return back()->with('error', 'Id inválido');
        }

        $regras = [
            'nome' => 'required'
        ];

        $mensagens = [
            'nome.required' => 'Por favor, insira o nome do aluno',
        ];

        $request->validate($regras, $mensagens);

        $aluno->nome = $request->nome;
        $aluno->data_nasc = $request->data_nasc;
        $aluno->save();

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = Alunos::findOrFail($id);
        if($aluno == null){
            return back()->with('error', 'Este curso não existe');
        }

        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno deletado com sucesso');
    }
}
