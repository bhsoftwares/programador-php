<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Plataforma de Ensino - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/multi-select.css')}}">
    <link rel="stylesheet" href="{{ asset('css/media.css')}}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <h3 class="text-center mt-4">Menu</h3>
            <hr>
            <ul class="list-unstyled components">
                <li class="sidebar-li ">
                    <i class="fa fa-2x fa-home"></i><a href="{{route('dashboard.index')}}">Dashboard</a>
                </li>
                <li class="sidebar-li">
                    <i class="fa fa-2x fa-play-circle-o"></i><a href="{{route('cursos.index')}}">Cursos</a>
                </li>
                <li class="sidebar-li">
                    <i class="fa fa-2x fa-code"></i><a href="{{route('alunos.index')}}">Alunos</a>
                </li>
                <li class="sidebar-li">
                    <i class="fa fa-2x fa-ticket"></i> <a href="{{route('matriculas.index')}}">Matrículas</a>
                </li>
            </ul>
        </nav>
        <div id="content" style="width: 100%">
            <nav class="navbar navbar-expand-lg x1">
                <button type="button" id="sidebarCollapse" class="toogle-button">
                    <i class="fa fa-bars"></i>
                </button>
            </nav>

            <main>
                @include('mensagens.flash')
                @yield('content')
            </main>    
        </div>
    
    </div>

    <script src="{{asset('js/app.js') }}"></script>
    <script src="{{asset('js/master.js') }}"></script>
    <script src="{{asset('js/jquery.multi-select.js')}}"></script>
</body>
</html>