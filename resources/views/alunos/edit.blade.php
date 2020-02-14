@extends('layout.app')

@section('title', 'Editar Aluno')

@section('content')
    <div class="container-fluid">
        <form action="{{route('alunos.update', ['id' => $aluno->id])}}" method="post">
            @csrf
            @method('put')
            <div class="form-group col-md-6">
                <label class="col-form-label" for="nome">Nome</label>
                <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome" value="{{$aluno->nome}}" required>
                @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="email">E-mail</label>
                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" disabled value="{{$aluno->email}}"></input>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="data_nasc">Data Nascimento</label>
                <input type="text" class="form-control" name="data_nasc" value="{{$aluno->data_nasc}}"></input>
            </div>
            <div class="form-group col-md-6 mt-2">
                <button type="submit" class="btn btn-primary">Atualizar Aluno</button>
                <a href="{{route('alunos.index')}}" class="btn btn-danger">Voltar</a>                     
            </div>  
        </form>
    </div>   
@endsection

