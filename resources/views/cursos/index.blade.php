@extends('layout.app')

@section('title', 'Cursos')

@section('content')
    <section class="cursos">
        <a href="{{route('cursos.create')}}" class="btn btn-success mb-4">Novo Curso</a>
        <div class="cursos__div">
            @foreach ($cursos as $curso)
                <div class="info__cards">
                    <div class="info__card--header">
                        <p>Curso</p>
                        <hr>
                        <h3>{{$curso->titulo}}</h3>
                    </div>
                    <div class="info__card--body">
                        <h4 class="text-center">
                            Descrição
                            <hr>
                        </h4>
                        <p>{{$curso->descricao}}</p>
                    </div>
                    <div class="info__card--footer">
                        <a class="btn btn-sm btn-info" href="{{route('cursos.show', ['id' => $curso->id])}}">Mais Informações</a>
                        <a class="btn btn-sm btn-warning m-2" href="{{route('cursos.edit', ['id' => $curso->id])}}">Editar</a>
                        <form action="{{route('cursos.destroy', ['id' => $curso->id]) }}" method="post">
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