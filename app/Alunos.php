<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    protected $fillable = ['nome', 'email'];

    public function matricula()
    {
        return $this->belongsTo('App\Matricula', 'aluno_id');
    }
}
