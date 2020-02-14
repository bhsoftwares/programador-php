<?php

namespace App\Http\Controllers;

use App\Cursos;
use App\Alunos;
use App\Matricula;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cursos = Cursos::all()->count();
        $alunos = Alunos::all()->count();
        $matriculas = Matricula::all()->count();
        return view ('dashboard.index', [
            'cursos' => $cursos,
            'alunos' => $alunos,
            'matriculas' => $matriculas
        ]);
    }
}
