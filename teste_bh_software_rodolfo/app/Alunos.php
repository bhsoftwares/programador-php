<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    protected $fillable = [
    	'nome', 'email', 'dt_nasc'
    ];

    public function getDtNascAttribute($valor)
    {
    	return date('d/m/Y', strtotime($valor));
    }
}
