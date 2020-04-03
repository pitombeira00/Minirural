<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lancamentos;
use App\planos;
use App\classificacao;

class lancamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = lancamentos::where('excluido', '0')->get();
        
        return view('Cadastro.lancamento.home',compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = classificacao::where('excluido','0')->get();
        $planos = planos::where('excluido','0')->get();

        return view('Cadastro.lancamento.create',compact('class','planos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        if(empty($dados['id_plano'])){
            
            \Session::flash('mensagem',['msg'=>'Plano de conta não localizado.']);
        
            return redirect()->route('lanca.home');
        }

        if(empty($dados['id_class'])){
            
            \Session::flash('mensagem',['msg'=>'Classificação não localizada.']);
        
            return redirect()->route('lanca.home');
        }

        $salvar = new lancamentos();

        $salvar->valor = $dados['valor'];
        $salvar->Data_pagamento = $dados['data'];
        $salvar->id_plano = $dados['id_plano'];
        $salvar->id_class = $dados['id_class'];
        $salvar->excluido = 0;

        $salvar->save();

        \Session::flash('mensagem',['msg'=>'Lançamento Adicionado']);

        return redirect()->route('lanca.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados = lancamentos::find($id);
        $class = classificacao::where('excluido','0')->get();
        $planos = planos::where('excluido','0')->get();


        return view('Cadastro.lancamento.edit',compact('dados', 'class', 'planos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $dados = $request->all();

        $editar = lancamentos::find($dados['id']);

        $editar->valor = $dados['valor'];
        $editar->Data_pagamento = $dados['data'];
        $editar->id_plano = $dados['id_plano'];
        $editar->id_class = $dados['id_class'];
        $editar->excluido = 0;

        $editar->save();

        \Session::flash('mensagem',['msg'=>' Lançamento editado com Sucesso']);

        return redirect()->route('lanca.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $editar = lancamentos::find($id);

        $editar->excluido = 1;

        $editar->save();

        \Session::flash('mensagem',['msg'=>' Lançamento excluido com Sucesso']);

        return redirect()->route('lanca.home');
    }
}
