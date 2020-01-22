<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $fillable = [
    	'titulo', 'descricao'
    ];

    public function getTituloAttribute($valor)
    {
    	return ucfirst($valor);
    }
}
