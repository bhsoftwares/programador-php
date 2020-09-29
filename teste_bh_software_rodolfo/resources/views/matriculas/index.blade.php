@extends('layout')
@section('title', 'Matrículas')
@section('bladeContent')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Matrículas</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastro de Matrículas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>   

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card card-body">
                    <h4 class="card-title">Cadastro de Matrículas</h4>
                    <h5 class="card-subtitle"> Cadastrar uma Nova Matrícula</h5>                                           
                    <form class="form-horizontal m-t-30" method="POST" action="{{ route('matriculas.store') }}">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>Aluno</label>
                            <select class="form-control" name="aluno_id">
                            	@foreach($alunos as $key => $aluno)
                            		<option value={{ $aluno->id }}>{{ $aluno->nome }}</option>>
                            	@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Curso</label>
                            <select class="form-control" name="curso_id">
                            	@foreach($cursos as $key => $curso)
                            		<option value={{ $curso->id }}>{{ $curso->titulo }}</option>>
                            	@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        	<input type="submit"class="btn btn-default" value="Cadastrar"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Cursos Cadastrados</h4>
                            <h6 class="card-subtitle">Lista de Cursos Cadastrados</h6>
                            <div class="table-responsive">
                                <table class="table" id="table-page">
                                    <thead>
                                        <tr>
                                            <th scope="col">Matrícula</th>
                                            <th scope="col">Aluno</th>
                                            <th scope="col">Curso</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($matriculas as $key => $m)
                                        <tr>
                                            <th scope="row">{{ $m->id }}</th>
                                            <th scope="row">{{ $m->aluno->nome }}</th>
                                            <th scope="row">{{ $m->curso->titulo }}</th>
                                            <td><button class="btn btn-info mdi mdi-grease-pencil" title="Editar" onclick="getMatricula({{ $m->id }}, {{ $m->aluno_id }}, {{ $m->curso_id }})"></button> <a style="color: #fff" class="btn btn-info mdi mdi-delete-forever" title="Deletar" href="{{ url('/') }}/deletaMatricula/{{ $m->id }}"></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form class="form-horizontal m-t-30" method="POST" action="{{ url('/') }}/editarMatricula">
                    	<input type="hidden" name="matricula_id" id="matricula_id">
                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>Aluno</label>
                            <select class="form-control" name="aluno_id" id="aluno_id_edit">
                            	@foreach($alunos as $key => $aluno)
                            		<option value={{ $aluno->id }}>{{ $aluno->nome }}</option>>
                            	@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Curso</label>
                            <select class="form-control" name="curso_id" id="curso_id_edit">
                            	@foreach($cursos as $key => $curso)
                            		<option value={{ $curso->id }}>{{ $curso->titulo }}</option>>
                            	@endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        	<input type="submit"class="btn btn-default" value="Salvar Modificações"/>
                        </div>
                    </form>
            </div>
          </div>
          
        </div>
      </div>                    

    </div>

    <footer class="footer text-center">
        Todos os Direitos reservados para <a href="https://github.com/rodolfoSant0s" target="_blank">Rodolfo Santos</a>. Template desenvolvido por <a href="https://wrappixel.com">WrapPixel</a>.
    </footer>

</div>

@endsection

@section('javascript')
<script>
	$(document).ready(function () {
		// 
	});

	@if (session('status'))
		toastr.info("{{ session('status') }}", 'Sucesso!')
	@endif

	@if (session('error'))
		toastr.error("{{ session('error') }}", 'Atenção!')
	@endif	 	

	function getMatricula(id, aluno_id, curso_id)
	{
		$('#matricula_id').val(id);
		$('#aluno_id_edit').val(aluno_id)
		$('#curso_id_edit').val(curso_id)
		$('#myModal').modal();
	}
</script>
@endsection