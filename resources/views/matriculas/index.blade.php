@extends('layout.app')

@section('title', 'Matrículas')

@section('content')
    <section class="cursos">
        <a href="{{route('matriculas.create')}}" class="btn btn-success mb-4">Nova Matrícula</a>
        <div class="cursos__div">
            @foreach ($matriculas as $matricula)
                <div class="info__cards">
                    <div class="info__card--header">
                        <h4>
                         Matrícula - {{$matricula->id}} <br> <hr>
                         Nome - {{$matricula->aluno->nome}}
                        </h4>
                    </div>
                    <div class="info__card--body">
                        <h4 class="text-center">
                            Cursos
                            <hr>
                        </h4>
                        <ul>
                            @foreach ($matricula->cursos as $curso )
                                <li>{{$curso->titulo}}</li>
                            @endforeach
                        </ul>
                        <p>{{$matricula->descricao}}</p>
                    </div>
                    <div class="info__card--footer">
                        <a class="btn btn-sm btn-warning mr-2" href="{{route('matriculas.edit', ['id' => $matricula->id])}}">Editar</a>
                        <form action="{{route('matriculas.destroy', ['id' => $matricula->id]) }}" method="post">
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