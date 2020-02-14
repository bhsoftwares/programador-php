@extends('layout.app')

@section('title', 'Dashboard')


@section('content')
    <section class="dashboard">
        <h1 class="text-center">Plataforma Ensino Online</h1>
        <div class="dashboard__div">
            <a class="dashboard__item" href="{{route('cursos.index')}}">
                <i class="fa fa-2x fa-play-circle-o"></i>
                <span>Cursos</span> 
            </a>
            <a class="dashboard__item" href="{{route('alunos.index')}}">
                <i class="fa fa-2x fa-user"></i>
                <span>Alunos</span>  
            </a>
            <a class="dashboard__item" href="{{route('matriculas.index')}}">
                <i class="fa fa-2x fa-ticket"></i>
                <span>Matrículas</span>
            </a>
        </div>
    </section>
@endsection