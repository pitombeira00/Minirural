<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\planos;

class planosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dados = planos::where('excluido', '0')->get();
        
        return view('Cadastro.plano.home',compact('dados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Cadastro.plano.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $salvar = $request->all();

        $novo =  new planos();

        $novo->nome  = $salvar['nome'];
        $novo->excluido  = 0;

        $novo->save();

        \Session::flash('mensagem',['msg'=>' '.$salvar['nome'].' Criado com Sucesso']);
        
        return redirect()->route('plano.home');

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
        
        $dados = planos::find($id);

        return view('Cadastro.plano.edit',compact('dados'));
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

        
        $editado = planos::find($dados['id']);

        $editado->nome = $dados['nome'];
        
        $editado->save();
         
        \Session::flash('mensagem',['msg'=>'Edição Realizada']);
        
        return redirect()->route('plano.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $apagar = planos::find($id);

        $apagar->excluido = 1;

        $apagar->save();
         
        \Session::flash('mensagem',['msg'=>'Plano Excluido']);
        
        return redirect()->route('plano.home');
    }
}
