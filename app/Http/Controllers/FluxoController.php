<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lancamentos;
use App\planos;
use App\classificacao;
USE DB;

class FluxoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        
        $anos = DB::table('lancamentos')
                    ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
                    ->GROUPBY("ANO")
                    ->get();

        return view('Fluxo.um',compact('anos'));
    }

    public function fluxo_um(Request $request)
    {
        $param = $request->all();

        if(empty($param['ano']) or empty($param['mes'])){
            
            \Session::flash('mensagem',['msg'=>'Parâmetros não escolhidos.']);
        
            return redirect()->route('fluxo.um');
        }
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        //select de anos e meses
        
        $anos = DB::table('lancamentos')
        ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
        ->GROUPBY("ANO")
        ->get();

        
        $a = 1;
        $aMES = [];
        $nTotDesp = 0;
        $nTotReic = 0;
        $nVlrAnt = 0;
        
        if ($param['mes'] < "10"){

            
            $param['mes'] = str_pad($param['mes'],2,"0", STR_PAD_LEFT);
        } 

        $valorRct = DB::table('lancamentos')
        ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
        ->select(DB::RAW("sum(valor) AS RECEITA"))
        ->whereraw("Data_pagamento < '".$param['ano']."-".$param['mes']."-01'")
        ->where('classificacao.tipo','=','1')
        ->get();

        $valorDsp = DB::table('lancamentos')
        ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
        ->select(DB::RAW("sum(valor) AS DESPESA"))
        ->whereraw("Data_pagamento < '".$param['ano']."-".$param['mes']."-01'")
        ->where('classificacao.tipo','=','2')
        ->get();



        
        $nVlrIni = $valorRct[0]->RECEITA - $valorDsp[0]->DESPESA;

        $nVlrAnt = $nVlrIni;
        
        //dd($nVlrIni);
        while ($a <= 30) {
            
            $nReceita = 0;
            $nDespesa = 0;
            $nAtivo = 0;
            $dados = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW("day(Data_pagamento) AS DIA, sum(valor) AS RECEITA"))
            ->whereRaw("year(Data_pagamento) = '".$param['ano']."'")
            ->whereRaw("month(Data_pagamento) = '".$param['mes']."'")
            ->whereRaw("day(Data_pagamento) = '".$a."'")
            ->where('classificacao.tipo','=','1')
            ->where('lancamentos.excluido','=','0')
            ->groupBy('valor', 'DIA')
            ->get();
    
            $dados2 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW("day(Data_pagamento) AS DIA, sum(valor) AS DESPESA"))
            ->whereRaw("year(Data_pagamento) = '".$param['ano']."'")
            ->whereRaw("month(Data_pagamento) = '".$param['mes']."'")
            ->whereRaw("day(Data_pagamento) = '".$a."'")
            ->where('classificacao.tipo','=','2')
            ->where('lancamentos.excluido','=','0')
            ->groupBy('valor', 'DIA')
            ->Get();

            $dados3 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW("day(Data_pagamento) AS DIA, sum(valor) AS ATIVO"))
            ->whereRaw("year(Data_pagamento) = '".$param['ano']."'")
            ->whereRaw("month(Data_pagamento) = '".$param['mes']."'")
            ->whereRaw("day(Data_pagamento) = '".$a."'")
            ->where('classificacao.tipo','=','3')
            ->where('lancamentos.excluido','=','0')
            ->groupBy('valor', 'DIA')
            ->Get();

            if (isset($dados[0]->RECEITA)){
                
                $nReceita = $dados[0]->RECEITA;

            }

            if (isset($dados2[0]->DESPESA)){
                
                $nDespesa = $dados2[0]->DESPESA;

            }

            if (isset($dados3[0]->ATIVO)){
                
                $nAtivo = $dados3[0]->ATIVO;

            }
            

            if ($a == 1){

                ARRAY_PUSH($aMES,[$a,$nReceita,$nDespesa,$nAtivo,$nVlrIni]);

            }
            else{

                ARRAY_PUSH($aMES,[$a,$nReceita,$nDespesa,$nAtivo,$nVlrAnt]);

            }

            $nVlrAnt = $nVlrAnt + $nReceita - $nDespesa;

            $nTotDesp = $nTotDesp + $nDespesa; 
            $nTotReic = $nTotReic + $nReceita; 
            $a++;
        }

        
       // dd($aMES);
     
        return view('Fluxo.um',compact('aMES', 'anos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ParaAnual()
    {
        

        $anos = DB::table('lancamentos')
        ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
        ->GROUPBY("ANO")
        ->get();


        return view('Fluxo.anual',compact('anos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Anual(Request $request)
    {
        $param = $request->all();

        if(empty($param['ano'])){
            
            \Session::flash('mensagem',['msg'=>'Parâmetros não escolhidos.']);
        
            return redirect()->route('fluxo.Para.anual');
        }

        //select de anos e meses
        $anos = DB::table('lancamentos')
        ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
        ->GROUPBY("ANO")
        ->get();


        $a = 1;
        $aMES = [];
        $nTotDesp = 0;
        $nTotReic = 0;
        
       
        $valorRct = DB::table('lancamentos')
        ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
        ->select(DB::RAW("sum(valor) AS RECEITA"))
        ->whereraw("Data_pagamento < '".$param['ano']."-01-01'")
        ->where('classificacao.tipo','=','1')
        ->get();

        $valorDsp = DB::table('lancamentos')
        ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
        ->select(DB::RAW("sum(valor) AS DESPESA"))
        ->whereraw("Data_pagamento < '".$param['ano']."-01-01'")
        ->where('classificacao.tipo','=','2')
        ->get();



        
        $nVlrIni = $valorRct[0]->RECEITA - $valorDsp[0]->DESPESA;

        $nVlrAnt = $nVlrIni;

        
        while ($a <= 12) {
            
            $nReceita = 0;
            $nDespesa = 0;
            $nAtivo = 0;

            $dados = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW("sum(valor) as valor"))
            ->whereRaw("year(Data_pagamento) = '".$param['ano']."'")
            ->whereRaw("month(Data_pagamento) = '".$a."'")
            ->where('classificacao.tipo','=','1')
            ->where('lancamentos.excluido','=','0')
            ->get();
    
            if (isset($dados[0]->valor)){
                
                $nReceita = $dados[0]->valor;
              
            }

            $dados2 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW("sum(valor) as valor"))
            ->whereRaw("year(Data_pagamento) = '".$param['ano']."'")
            ->whereRaw("month(Data_pagamento) = '".$a."'")
            ->where('classificacao.tipo','=','2')
            ->where('lancamentos.excluido','=','0')
            ->get();
    
            if (isset($dados2[0]->valor)){
                
                $nDespesa = $dados2[0]->valor;
              
            }

            $dados3 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW("sum(valor) as valor"))
            ->whereRaw("year(Data_pagamento) = '".$param['ano']."'")
            ->whereRaw("month(Data_pagamento) = '".$a."'")
            ->where('classificacao.tipo','=','3')
            ->where('lancamentos.excluido','=','0')
            ->get();
    
            if (isset($dados3[0]->valor)){
                
                $nAtivo = $dados3[0]->valor;
              
            }

           
            
            if($a == 1){

                ARRAY_PUSH($aMES,[$a,$nReceita,$nDespesa,$nAtivo, $nVlrIni]);
                
            }
            else{

                ARRAY_PUSH($aMES,[$a,$nReceita,$nDespesa,$nAtivo, $nVlrAnt]);
           
            }
            
            $nVlrAnt = $nVlrAnt + $nReceita - $nDespesa;
           // $nTotDesp = $nTotDesp + $nDespesa; 
            $nTotReic = $nTotReic + $nReceita; 
            $a++;
        }

             
        return view('Fluxo.anual',compact('aMES', 'anos'));
    }

    
    public function ParaDem()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        
        $anos = DB::table('lancamentos')
                    ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
                    ->GROUPBY("ANO")
                    ->get();

        return view('Fluxo.geral',compact('anos'));
    }

    public function Demonstrativo(Request $request)
    {
        $param = $request->all();
        
        if(empty($param['ano']) or empty($param['mes'])){
            
            \Session::flash('mensagem',['msg'=>'Parâmetros não escolhidos.']);
        
            return redirect()->route('rel.para.dem');
        }

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        
        $anos = DB::table('lancamentos')
                    ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
                    ->GROUPBY("ANO")
                    ->get();

        $GERAL = DB::select(DB::RAW(" SELECT nome,SUM(ATIVO) AS ATIVO,SUM(RECEITA) AS RECEITA,SUM(DESPESA) AS DESPESA FROM (SELECT plano.nome, sum(lancamentos.valor) RECEITA, 0 DESPESA, 0 ATIVO FROM lancamentos
        INNER JOIN classificacao ON classificacao.id = lancamentos.id_class
        INNER JOIN plano on plano.id = lancamentos.id_plano
        WHERE
        classificacao.tipo = '1'
        and plano.excluido = '0'
        and classificacao.excluido = '0'
        and lancamentos.excluido = '0'
        and year(Data_pagamento) = '".$param['ano']."'
        and month(Data_pagamento) = '".$param['mes']."'    
        GROUP BY plano.nome
        
        UNION ALL
        
        SELECT plano.nome, 0 RECEITA, sum(lancamentos.valor) DESPESA, 0 ATIVO FROM lancamentos
        INNER JOIN classificacao ON classificacao.id = lancamentos.id_class
        INNER JOIN plano on plano.id = lancamentos.id_plano
        WHERE
        classificacao.tipo = '2'
        and plano.excluido = '0'
        and classificacao.excluido = '0'
        and lancamentos.excluido = '0'
        and year(Data_pagamento) = '".$param['ano']."'
        and month(Data_pagamento) = '".$param['mes']."' 
        GROUP BY plano.nome
        
        UNION ALL
        
        SELECT plano.nome, 0 RECEITA, 0 DESPESA, sum(lancamentos.valor) ATIVO FROM lancamentos
        INNER JOIN classificacao ON classificacao.id = lancamentos.id_class
        INNER JOIN plano on plano.id = lancamentos.id_plano
        WHERE
        classificacao.tipo = '3'
        and plano.excluido = '0'
        and classificacao.excluido = '0'
        and lancamentos.excluido = '0'
        and year(Data_pagamento) = '".$param['ano']."'
        and month(Data_pagamento) = '".$param['mes']."' 
        GROUP BY plano.nome ) AS RELATORIO GROUP by nome"));
        
        

            

        
            


        return view('Fluxo.geral',compact('GERAL', 'anos'));
    }

    
}
