<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matriculas extends Model
{
    protected $fillable = [
    	'aluno_id', 'curso_id'
    ];

    public function aluno()
    {
        return $this->belongsTo('App\Alunos');
    }   
    public function curso()
    {
        return $this->belongsTo('App\Cursos');
    }        
}
