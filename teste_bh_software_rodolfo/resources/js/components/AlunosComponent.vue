<template>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Cadatro de Alunos</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Cadatro de Alunos</li>
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
                        <h4 class="card-title">Cadastro de Alunos</h4>
                        <h5 class="card-subtitle"> Cadastrar um novo Aluno</h5>                       
                        <form class="form-horizontal m-t-30">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome" v-model="aluno.nome">
                                <span class="text-error" id="nomeTextError">Preencha Corretamente</span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                               <input type="email" class="form-control" name="email" id="email" v-model="aluno.email">
                                <span class="text-error" id="emailTextError">Preencha Corretamente</span>
                            </div>
                            <div class="form-group">
                                <label>Data de Nascimento</label>
                               <input type="text" class="form-control" name="dt_nasc" id="dt_nasc" v-model="aluno.dt_nasc" v-mask="'##/##/####'">
                                <span class="text-error" id="dt_nascTextError">Preencha Corretamente</span>
                            </div>                            
                            <div class="form-group">
                            	<button type="button"class="btn btn-default" v-on:click="salvaAluno">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        	<div class="box-search">
                        	<div>
                            <h4 class="card-title">Alunos Cadastrados</h4>
                            <h6 class="card-subtitle">Lista de Alunos Cadastrados</h6>                        		
                        	</div>
                        	<div class="flex">
                            <label>Pesquisar: </label>
                            <input type="text" name="" class="form-control input-search" placeholder="Pesquisar por nome ou email.." v-model="pesquisa" v-on:keyup="buscaDados">
                        	</div>
                        	</div>
                            <div class="table-responsive">
                                <table class="table" id="table-page">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Data de Nascimento</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="aluno in alunos.data" :key="aluno.id">
                                            <th scope="row">{{aluno.id}}</th>
                                            <th scope="row">{{aluno.nome}}</th>
                                            <th scope="row">{{ aluno.email.length > 15 ? aluno.email.substr(0, 15)+'...': aluno.email}}</th>
                                            <th scope="row">{{aluno.dt_nasc}}</th>
                                            <td><button v-on:click="getAlunoEdit(aluno.id)" class=" btn btn-info mdi mdi-grease-pencil" title="Editar"></button> <button v-on:click="deletaAluno(aluno.id)" class="btn btn-info mdi mdi-delete-forever" title="Deletar"></button></td>
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
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t-30">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nomeEdit" id="nomeEdit" v-model="alunoEdit.nome">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                           <input type="email" class="form-control" name="emailEdit" id="emailEdit" v-model="alunoEdit.email">
                        </div>
                        <div class="form-group">
                            <label>Data de Nascimento</label>
                           <input type="text" class="form-control" name="dt_nascEdit" id="dt_nascEdit" v-model="alunoEdit.dt_nasc" v-mask="'##/##/####'">
                        </div>
                        <div class="form-group">
                            <button type="button"class="btn btn-default" v-on:click="editaAluno">Salvar Modificações</button>
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
    import {TheMask} from 'vue-the-mask'
	export default {
        components: {TheMask},
        data() {
            return {
                aluno: {},
                alunoEdit: {
                    id: null,
                    nome: '',
                    email: '',
                    dt_nasc: ''
                },
                alunos: {},
                pesquisa: '',
                timer: ''
            }
        },
		mounted() {
			console.log('Componente Inicializado')
            this.getAlunos()
		},
		methods: {
			salvaAluno() {
				console.log('Salvando Aluno')
                $('input, textarea').removeClass('input-error');
                $('.text-error').hide()                
                axios.post('/alunos', {
                		nome: this.aluno.nome,
                        email: this.aluno.email,
                        dt_nasc: this.aluno.dt_nasc
                	})
                    .then(response => {
                        console.log(response.data)
                        toastr.info(response.data.msg, 'Sucesso!')
                        this.aluno.nome = ''
                        this.aluno.email = ''
                        this.aluno.dt_nasc = ''
                        this.getAlunos()
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
            getAlunos() {
                console.log('Buscando Alunos')
                axios.get('/getAlunos')
                    .then(response => {
                        console.log(response.data)
                        this.alunos = response.data
                    })
                    .catch(error => {
                        console.log(error)
                        alert('Ocorreu algum problema :(');
                    })
            },
            deletaAluno(id) {
                axios.get('/deletaAluno/'+id)
                    .then(response => {
                        console.log(response.data)
                        toastr.info(response.data.msg, 'Sucesso!')
                        this.getAlunos()
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
            getAlunoEdit(id) {
                axios.get('/getAluno/'+id)
                    .then(response => {
                        console.log(response.data)
                        this.alunoEdit.id = id
                        this.alunoEdit.nome = response.data.nome
                        this.alunoEdit.email = response.data.email
                        this.alunoEdit.dt_nasc = response.data.dt_nasc
                        console.log(this.alunoEdit)
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
            editaAluno() {
                console.log('Salvando Aluno')
                axios.post('/editAluno/'+this.alunoEdit.id, {
                        nome: this.alunoEdit.nome,
                        email: this.alunoEdit.email,
                        dt_nasc: this.alunoEdit.dt_nasc
                    })
                    .then(response => {
                        console.log(response.data)
                        toastr.info(response.data.msg, 'Sucesso!')
                        $('#myModal').modal('hide')
                        this.getAlunos()
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
            buscaDados() {
            	clearTimeout(this.timer);
            	var search = this.pesquisa
                axios.post('/getAlunosPesquisa', {
                	pesquisa: search
                })
                .then(response => {
                    console.log(response.data)
                    this.alunos = response.data
                })
                .catch(error => {
                    console.log(error)
                    alert('Ocorreu algum problema :(');
                })	            	
				// this.timer = setTimeout(function() {
	   //              axios.post('/getAlunosPesquisa', {
	   //              	pesquisa: search
	   //              })
    //                 .then(response => {
    //                     console.log(response.data)
    //                     this.alunos = response.data
    //                 })
    //                 .catch(error => {
    //                     console.log(error)
    //                     alert('Ocorreu algum problema :(');
    //                 })	            						
				// }, 1000);            	
            }
		}
	}
</script>