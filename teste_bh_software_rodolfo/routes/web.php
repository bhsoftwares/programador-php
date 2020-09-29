<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CursosController@index');

Route::resource('cursos', 'CursosController');
Route::get('getCursos', 'CursosController@getAllCursos');
Route::get('deletaCurso/{id}', 'CursosController@deletaCurso');
Route::get('getCurso/{id}', 'CursosController@getCurso');
Route::post('editCurso/{id}', 'CursosController@editCurso');

Route::resource('alunos', 'AlunosController');
Route::get('getAlunos', 'AlunosController@getAllAlunos');
Route::get('deletaAluno/{id}', 'AlunosController@deletaAluno');
Route::get('getAluno/{id}', 'AlunosController@getAluno');
Route::post('editAluno/{id}', 'AlunosController@editAluno');
Route::post('getAlunosPesquisa', 'AlunosController@getAlunosPesquisa');


Route::resource('matriculas', 'MatriculasController');
Route::get('getMatriculas', 'MatriculasController@getAllCursos');
Route::get('deletaMatricula/{id}', 'MatriculasController@deletaMatricula');
Route::post('editarMatricula', 'MatriculasController@editarMatricula');