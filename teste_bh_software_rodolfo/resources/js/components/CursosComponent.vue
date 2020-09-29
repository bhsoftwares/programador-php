<template>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Área de Cursos</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Área de Cursos</li>
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
                        <h4 class="card-title">Cadastro de Cursos</h4>
                        <h5 class="card-subtitle"> Cadastrar um novo curso</h5>                       
                        <form class="form-horizontal m-t-30">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" v-model="curso.titulo">
                                <span class="text-error" id="tituloTextError">Preencha Corretamente</span>
                            </div>
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control" rows="5" name="descricao" id="descricao" v-model="curso.descricao"></textarea>
                                <span class="text-error" id="descricaoTextError">Preencha Corretamente</span>
                            </div>
                            <div class="form-group">
                            	<button type="button"class="btn btn-default" v-on:click="salvaCurso">Cadastrar</button>
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
                                            <th scope="col">#</th>
                                            <th scope="col">Título</th>
                                            <th scope="col">Descrição</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="curso in cursos.data" :key="curso.id">
                                            <th scope="row">{{curso.id}}</th>
                                            <th scope="row">{{curso.titulo}}</th>
                                            <th scope="row">{{ curso.descricao.length > 15 ? curso.descricao.substr(0, 15)+'...': curso.descricao}}</th>
                                            <td><button v-on:click="getCursoEdit(curso.id)" class=" btn btn-info mdi mdi-grease-pencil" title="Editar"></button> <button v-on:click="deletaCurso(curso.id)" class="btn btn-info mdi mdi-delete-forever" title="Deletar"></button></td>
                                        </tr>
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
                  <h4 class="modal-title">Editar Curso</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t-30">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" class="form-control" name="tituloEdit" id="tituloEdit" v-model="cursoEdit.titulo">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea class="form-control" rows="5" name="descricaoEdit" id="descricaoEdit" v-model="cursoEdit.descricao"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button"class="btn btn-default" v-on:click="editaCurso">Salvar Modificações</button>
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
</template>

<script>
	export default {
        data() {
            return {
                curso: {},
                cursoEdit: {
                    id: null,
                    titulo: '',
                    descricao: ''
                },
                cursos: {}
            }
        },
		mounted() {
			console.log('Componente Inicializado')
            this.getCursos()
		},
		methods: {
			salvaCurso() {
				console.log('Salvando Curso')
                $('input, textarea').removeClass('input-error');
                $('.text-error').hide()                
                axios.post('/cursos', {
                		titulo: this.curso.titulo,
                        descricao: this.curso.descricao
                	})
                    .then(response => {
                        console.log(response.data)
                        toastr.info(response.data.msg, 'Sucesso!')
                        this.curso.titulo = ''
                        this.curso.descricao = ''
                        this.getCursos()
                    })
                    .catch(error => {
                        if (error.response.status == 422){
                            console.log('AQUI')
                            console.log(error.response.data.errors)
                            console.log('AQUI')
                            console.log('lista de erros')
                            for (let index in error.response.data.errors) {
                                console.log(index);
                                $('#'+index).addClass('input-error')
                                $('#'+index+'TextError').show();
                            }
                        }                        
                    });                    				
			},
            getCursos() {
                console.log('Buscando Cursos')
                axios.get('/getCursos')
                    .then(response => {
                        console.log(response.data)
                        this.cursos = response.data
                    })
                    .catch(error => {
                        console.log(error)
                        alert('Ocorreu algum problema :(');
                    })
            },
            deletaCurso(id) {
                axios.get('/deletaCurso/'+id)
                    .then(response => {
                        console.log(response.data)
                        toastr.info(response.data.msg, 'Sucesso!')
                        this.getCursos()
                    })
                    .catch(error => {
                        // if (error.response.status == 422){
                        //     console.log(error.response.data)
                        //     this.erros = error.response.data.errors;
                        //     console.log('lista de erros')
                        //     console.log(this.erros);
                        // }                        
                        alert("Aconteceu algum problema :(");
                    });
            },
            getCursoEdit(id) {
                axios.get('/getCurso/'+id)
                    .then(response => {
                        console.log(response.data)
                        this.cursoEdit.id = id
                        this.cursoEdit.titulo = response.data.titulo
                        this.cursoEdit.descricao = response.data.descricao
                        $('#myModal').modal();
                    })
                    .catch(error => {
                        // if (error.response.status == 422){
                        //     console.log(error.response.data)
                        //     this.erros = error.response.data.errors;
                        //     console.log(this.erros);
                        // }                        
                        alert("Aconteceu algum problema :(");
                    });                
            },
            editaCurso() {
                console.log('Salvando Curso')
                axios.post('/editCurso/'+this.cursoEdit.id, {
                        titulo: this.cursoEdit.titulo,
                        descricao: this.cursoEdit.descricao
                    })
                    .then(response => {
                        console.log(response.data)
                        toastr.info(response.data.msg, 'Sucesso!')
                        $('#myModal').modal('hide')
                        this.getCursos()
                    })
                    .catch(error => {
                        // if (error.response.status == 422){
                        //     console.log(error.response.data)
                        //     this.erros = error.response.data.errors;
                        //     console.log(this.erros);
                        // }                        
                        alert("Aconteceu algum problema :(");
                    }); 
            }
		}
	}
</script>