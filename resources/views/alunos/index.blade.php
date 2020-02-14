@extends('layout.app')

@section('title', 'Alunos')

@section('content')
    <section class="cursos">
        <div class="alunos__busca">
            <a class="btn btn-success mr-4 mb-4" href="{{route('alunos.create')}}">Novo Aluno</a>
            <form action="{{route('alunos.search')}}">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                </div>
            </form>
        </div>
 
        <div class="cursos__div">
            @foreach ($alunos as $aluno)
            <div class="info__cards">
                <div class="info__card--header">
                    <p>Aluno</p>
                    <hr>
                    <h3>{{$aluno->nome}}</h3>
                </div>
                <div class="info__card--body">
                    <p>
                       <strong>E-mail:</strong> {{$aluno->email}}
                    </p>
                    <hr>
                    <p>
                       <strong>Data de Nascimento:</strong> {{$aluno->data_nasc}}
                    </p>
                    <ul>
                        
                    </ul>
                </div>
                <div class="info__card--footer">
                    <a class="btn btn-sm btn-warning m-2" href="{{route('alunos.edit', ['id' => $aluno->id])}}">Editar</a>
                    <form action="{{route('alunos.destroy', ['id' => $aluno->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Deletar</button>
                    </form>
                </div>
            </div>           
        @endforeach
        </div>
    </section>
@endsection