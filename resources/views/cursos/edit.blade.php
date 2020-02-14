@extends('layout.app')

@section('title', 'Novo Curso')

@section('content')
    <div class="container-fluid">
        <form action="{{route('cursos.update', ['id' => $curso->id])}}" method="post">
            @csrf
            @method('put')
            <div class="form-group col-md-6">
                <label class="col-form-label" for="titulo">Título</label>
                <input class="form-control  {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" value="{{$curso->titulo}}" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="descricao">Descrição</label>
                <textarea class="form-control" name="descricao" cols="30" rows="5">{{$curso->descricao}}</textarea>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Atualizar Curso</button>
                <a href="{{route('cursos.index')}}" class="btn btn-danger">
                    Voltar
                </a>                            
            </div>  
        </form>
    </div>  
@endsection