<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use App\classificacao;

class classificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = classificacao::where('excluido', '0')->get();
        
        return(view('Cadastro.classificacao.home',compact('dados')) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Cadastro.classificacao.create');
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

        $salvar = new classificacao();

        $salvar->descricao = $dados['descricao'];
        $salvar->tipo = $dados['tipo_plano'];
        $salvar->excluido = 0;

        $salvar->save();

        \Session::flash('mensagem',['msg'=>' '.$dados['descricao'].' Criado com Sucesso']);
        
        return redirect()->route('class.home');


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
        $dados = classificacao::find($id);

        return view('Cadastro.classificacao.edit',compact('dados'));
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

        if(empty($dados['tipo_plano'])){
            
            \Session::flash('mensagem',['msg'=>'Edição não realizada, faltou informar o tipo de plano']);
        
            return redirect()->route('class.home');
        }

        $editado = classificacao::find($dados['id']);

        $editado->descricao = $dados['descricao'];
        $editado->tipo      = $dados['tipo_plano'];

        $editado->save();
         
        \Session::flash('mensagem',['msg'=>'Edição Realizada']);
        
        return redirect()->route('class.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apagar = classificacao::find($id);

        $apagar->excluido = 1;

        $apagar->save();
         
        \Session::flash('mensagem',['msg'=>'Classificação Excluida']);
        
        return redirect()->route('class.home');
    }
}
