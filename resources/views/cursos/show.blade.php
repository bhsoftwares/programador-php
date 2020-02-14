@extends('layout.app')

@section('title', 'Cursos')

@section('content')
    <section class="cursos__show">
        <div class="info__show">
            <div class="info__show--header">
                <h1>
                    {{$curso->titulo}}
                    <hr>
                </h1>
            </div>
            <div class="info__show--body">
                <p>{{$curso->descricao}}</p>
            </div>
        </div>
        <div class="alunos__info text-center">
           <h2>
               Alunos deste curso
               <hr>
            </h2>
           <ul class="text-left">
               @foreach ($curso->matricula as $matricula)
                   <li> 
                       {{$matricula->aluno->nome}}
                    </li>
                    <hr>
               @endforeach
           </ul>
        </div>
    </section>

@endsection
