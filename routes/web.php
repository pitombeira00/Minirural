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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/',['as'=>'home','uses'=>'InicialController@index']);
Route::post('/Graficos',['as'=>'home.inicial','uses'=>'InicialController@inicial_dados']);


Route::get('/Cadastro/Planos',['as'=>'plano.home','uses'=>'planosController@index']);
Route::get('/Cadastro/Planos/Novo',['as'=>'plano.create','uses'=>'planosController@create']);
Route::post('/Cadastro/Planos/salvar',['as'=>'plano.store','uses'=>'planosController@store']);
Route::post('/Cadastro/Planos/Editar/Salvar',['as'=>'plano.update','uses'=>'planosController@update']);
Route::get('/Cadastro/Planos/Excluir/{id}',['as'=>'plano.destroy','uses'=>'planosController@destroy']);
Route::get('/Cadastro/Planos/Editar/{id}',['as'=>'plano.edit','uses'=>'planosController@edit']);

Route::get('/Cadastro/Lancamentos',['as'=>'lanca.home','uses'=>'lancamentosController@index']);
Route::get('/Cadastro/Lancamentos/Novo',['as'=>'lanca.create','uses'=>'lancamentosController@create']);
Route::post('/Cadastro/Lancamentos/salvar',['as'=>'lanca.store','uses'=>'lancamentosController@store']);
Route::post('/Cadastro/Lancamentos/Editar/Salvar',['as'=>'lanca.update','uses'=>'lancamentosController@update']);
Route::get('/Cadastro/Lancamentos/Excluir/{id}',['as'=>'lanca.destroy','uses'=>'lancamentosController@destroy']);
Route::get('/Cadastro/Lancamentos/Editar/{id}',['as'=>'lanca.edit','uses'=>'lancamentosController@edit']);

Route::get('/Cadastro/Classificacao',['as'=>'class.home','uses'=>'ClassificacaoController@index']);
Route::get('/Cadastro/Classificacao/Novo',['as'=>'class.create','uses'=>'ClassificacaoController@create']);
Route::post('/Cadastro/Classificacao/salvar',['as'=>'class.store','uses'=>'ClassificacaoController@store']);
Route::post('/Cadastro/Classificacao/Editar/Salvar',['as'=>'class.update','uses'=>'ClassificacaoController@update']);
Route::get('/Cadastro/Classificacao/Excluir/{id}',['as'=>'class.destroy','uses'=>'ClassificacaoController@destroy']);
Route::get('/Cadastro/Classificacao/Editar/{id}',['as'=>'class.edit','uses'=>'ClassificacaoController@edit']);

Route::get('/Cadastro/Fluxo',['as'=>'fluxo.um','uses'=>'FluxoController@index']);
Route::post('/Cadastro/Fluxo/Search',['as'=>'fluxo.search','uses'=>'FluxoController@fluxo_um']);
Route::get('/Cadastro/Fluxo/Anual',['as'=>'fluxo.Para.anual','uses'=>'FluxoController@ParaAnual']);
Route::post('/Cadastro/Fluxo/Anual',['as'=>'fluxo.anual','uses'=>'FluxoController@Anual']);
Route::post('/Cadastro/Relatorio/Demonstrativo',['as'=>'rel.dem','uses'=>'FluxoController@Demonstrativo']);
Route::get('/Cadastro/Relatorio/Demonstrativo',['as'=>'rel.para.dem','uses'=>'FluxoController@ParaDem']);


