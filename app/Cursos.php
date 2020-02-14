<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $fillable = ['titulo', 'descricao'];

    public function matricula()
    {
        return $this->belongsToMany('App\Matricula', 'matriculas_cursos', 'curso_id', 'matricula_id');
    }
}
