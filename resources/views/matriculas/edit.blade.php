@extends('layout.app')

@section('title', 'Editar Matrícula')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('matriculas.update', ['id' => $matricula->id]) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group col-md-6">
                <label class="col-form-label" for="Alunos">Alunos</label>
                <select class="form-control" name="alunos_id" disabled id="">
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
                <button type="submit" class="btn btn-primary">Atualizar Cursos</button>
                <a class="btn btn-danger" href="{{route('matriculas.index')}}">Voltar</a>                       
            </div> 
        </form>
    </div>

@endsection