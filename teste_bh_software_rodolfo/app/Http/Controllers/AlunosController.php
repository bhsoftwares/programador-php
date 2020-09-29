<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Alunos;
use Illuminate\Support\Facades\DB;

class AlunosController extends Controller
{
    public function index()
    {
        return view('alunos.index');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nome' => 'required',
            'email' => 'required|email|max:255',
            'dt_nasc' => 'required',
        ]);

        Alunos::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'dt_nasc' => date('Y-d-m', strtotime($request->dt_nasc))
        ]);

        return response()->json(['status' => 'success', 'msg' => 'Aluno Cadastrado com Sucesso!']);
    }

    public function getAllAlunos()
    {
        return response()->json(['data' => Alunos::orderby('nome', 'asc')->get()]);
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

    public function deletaAluno($id)
    {
        Alunos::destroy($id);
        return response()->json(['status' => 'success', 'msg' => 'Aluno deletado com Sucesso!']);
    }

    public function getAluno($id)
    {
        $aluno = Alunos::where('id', $id)->first();
        return response()->json($aluno);
    }

    public function editAluno(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required',
            'email' => 'required|max:255',
            'dt_nasc' => 'required',
        ]);

        $curso = Alunos::where('id', $id)->first();
        $curso->nome = $request->nome;
        $curso->email = $request->email;
        $curso->dt_nasc = date('Y-d-m', strtotime($request->dt_nasc));
        $curso->save();                
        return response()->json(['status' => 'success', 'msg' => 'Aluno editado com Sucesso!']);
    }

    public function getAlunosPesquisa(Request $request)
    {

        // DB::listen(function ($query) {
        //     var_dump([
        //         $query->sql,
        //         $query->bindings,
        //         $query->time
        //     ]);
        // });

        if ($request->pesquisa == '' || empty($request->pesquisa)) {
            return $this->getAllAlunos();
        }
        $alunos = DB::table('alunos')
                        ->where('nome', 'like', '%'.$request->pesquisa.'%')
                        ->orWhere('email', 'like', '%'.$request->pesquisa.'%')
                        ->orderby('nome', 'asc')
                        ->get();
        return response()->json(['data' => $alunos]);                        
    }
}
