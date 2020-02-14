@extends('layout.app')

@section('title', 'Matrículas')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 ml-2">Nova Matrícula</h1>
        <form action="{{ route('matriculas.store') }}" method="post">
            @csrf
            <div class="form-group col-md-6">
                <label class="col-form-label" for="Alunos">Alunos</label>
                <select class="form-control" name="alunos_id" id="">
                    @foreach ($alunos as $aluno)
                        <option value="{{$aluno->id}}">{{$aluno->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="Cursos">Cursos</label>
                <select class="form-control" name="cursos_id[]" id="optgroup" multiple="multiple">
                    <optgroup label='Aluno'>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->titulo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6 mt-2">
                <button type="submit" class="btn btn-primary">Nova Matrícula</button>
                <a class="btn btn-danger" href="{{route('matriculas.index')}}">Voltar</a>                           
            </div> 
        </form>
    </div>

@endsection