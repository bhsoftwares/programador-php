<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    public function aluno()
    {
        return $this->belongsTo('App\Alunos');
    }

    public function cursos()
    {
        return $this->belongsToMany('App\Cursos', 'matriculas_cursos', 'matricula_id', 'curso_id');
    }


}
