@extends('layout.app')

@section('title', 'Novo Curso')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 ml-2">Novo Curso</h1>
        <form action="{{route('cursos.store')}}" method="post">
            @csrf
            <div class="form-group col-md-6">
                <label class="col-form-label" for="titulo">Título</label>
                <input class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" type="text" name="titulo" id="titulo" required>
                @if($errors->has('titulo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titulo') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="descricao">Descrição</label>
                <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-primary">Criar Curso</button>
                <a href="{{route('cursos.index')}}" class="btn btn-danger">
                    Voltar
                </a>                            
            </div>  
        </form>
    </div>  
@endsection

