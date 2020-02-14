@extends('layout.app')

@section('title', 'Novo Aluno')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 ml-2">Novo Aluno</h1>
        <form action="{{route('alunos.store')}}" method="post">
            @csrf
            <div class="form-group col-md-6">
                <label class="col-form-label" for="nome">Nome</label>
                <input class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" type="text" name="nome">
                @if($errors->has('nome'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nome') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="email">E-mail</label>
                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"></input>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label class="col-form-label" for="data_nasc">Data Nascimento</label>
                <input type="text" class="form-control" name="data_nasc" placeholder="xxxx-xx-xx"></input>
            </div>
            <div class="form-group mt-2 col-md-6">
                <button type="submit" class="btn btn-primary">Novo Aluno</button>
                <a href="{{route('alunos.index')}}" class="btn btn-danger">Voltar</a>                     
            </div>  
        </form>
    </div>   
@endsection

