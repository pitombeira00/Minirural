<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lancamentos;
use App\planos;
use App\classificacao;
USE DB;

class InicialController extends Controller
{
    
    public function index(){
        
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');


       // dd(strftime('%B', strtotime('3/06/2019')));
        $anos = DB::table('lancamentos')
        ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
        ->GROUPBY("ANO")
        ->get();

        $cMesAtual = date('m');
        $cAnoAtual = date('Y');
        $aInfo = [];
        $aRecVal = [];
        $aRecDesc = [];
        $aDesVal = [];
        $aDesDesc = [];
        $aAtvVal = [];
        $aAtvDesc = [];
        $nReceita = 0;
        $nDespesa = 0;
        $nAtivo  = 0;
        //RECEITA DO MÊS

        $dados = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" sum(valor) AS RECEITA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','1')
            ->where('lancamentos.excluido','=','0')
            ->get();

        //DESPESA DO MÊS
        $dados2 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" sum(valor) AS DESPESA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','2')
            ->where('lancamentos.excluido','=','0')
            ->get();

        //ATIVO DO MÊS
        $dados3 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" sum(valor) AS ATIVO"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','3')
            ->where('lancamentos.excluido','=','0')
            ->get();

            if (isset($dados[0]->RECEITA)){
                
                $nReceita = $dados[0]->RECEITA;

            }

            if (isset($dados2[0]->DESPESA)){
                
                $nDespesa = $dados2[0]->DESPESA;

            }   
            if (isset($dados3[0]->ATIVO)){
                
                $nAtivo = $dados3[0]->ATIVO;

            }   
            ARRAY_PUSH($aInfo,[$nReceita,$nDespesa,$nAtivo]);
            
       
            //RECEITA POR PLANO

            $oRecPla = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" plano.nome,sum(valor) AS RECEITA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','1')
            ->where('lancamentos.excluido','=','0')
            ->GroupBy('nome')
            ->get();

         
            foreach ($oRecPla as $Rec) {
             
                if (isset($Rec->nome)){
                
                    ARRAY_PUSH($aRecDesc,$Rec->nome);
    
                }
    
                if (isset($Rec->RECEITA)){
                    
                    ARRAY_PUSH($aRecVal,$Rec->RECEITA);
    
                } 
                
                
          
            }
 
            $RetRec = $aRecVal;
            $RecDesc = json_encode($aRecDesc);
            //dd($RetRec);
            //DESPESA POR PLANO

            $oDesPla = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" plano.nome,sum(valor) AS DESPESA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','2')
            ->where('lancamentos.excluido','=','0')
            ->GroupBy('nome')
            ->get();

         
            foreach ($oDesPla as $Des) {
             
                if (!empty($Des->nome)){
                
                    ARRAY_PUSH($aDesDesc,$Des->nome);
    
                }
    
                if (!empty($Des->DESPESA)){
                    
                    ARRAY_PUSH($aDesVal,$Des->DESPESA);
    
                }  
                
                         
            }

            $RetDes = $aDesVal;
            $DesDesc = json_encode($aDesDesc);
            
            
            //DESPESA POR PLANO

            $oAtvPla = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" plano.nome,sum(valor) AS ATIVO"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','3')
            ->where('lancamentos.excluido','=','0')
            ->GroupBy('nome')
            ->get();

         
            foreach ($oAtvPla as $Atv) {
             
                if (!empty($Atv->nome)){
                
                    ARRAY_PUSH($aAtvDesc,$Atv->nome);
    
                }
    
                if (!empty($Atv->ATIVO)){
                    
                    ARRAY_PUSH($aAtvVal,$Atv->ATIVO);
    
                }  
                
                         
            }

            $RetAtv = $aAtvVal;
            $AtvDesc = json_encode($aAtvDesc);
          
            return view ('welcome',compact('aInfo','RetRec','RecDesc','RetDes','DesDesc','RetAtv','AtvDesc', 'anos', 'cMesAtual', 'cAnoAtual'));
    }


    public function inicial_dados(Request $request){
        

        $param = $request->all();
        
        if(empty($param['mes']) or empty($param['ano'])){
            
            \Session::flash('mensagem',['msg'=>'Ano ou Mês não indicados.']);
        
            return redirect()->route('home');
        }
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        
        $anos = DB::table('lancamentos')
        ->select(DB::RAW("YEAR(Data_pagamento) AS ANO"))
        ->GROUPBY("ANO")
        ->get();

        $cMesAtual = $param['mes'];
        $cAnoAtual = $param['ano'];
        $aInfo = [];
        $aRecVal = [];
        $aRecDesc = [];
        $aDesVal = [];
        $aDesDesc = [];
        $aAtvVal = [];
        $aAtvDesc = [];
        $nReceita = 0;
        $nDespesa = 0;
        $nAtivo  = 0;
        //RECEITA DO MÊS

        $dados = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" sum(valor) AS RECEITA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','1')
            ->where('lancamentos.excluido','=','0')
            ->get();

        //DESPESA DO MÊS
        $dados2 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" sum(valor) AS DESPESA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','2')
            ->where('lancamentos.excluido','=','0')
            ->get();

        //ATIVO DO MÊS
        $dados3 = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" sum(valor) AS ATIVO"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','3')
            ->where('lancamentos.excluido','=','0')
            ->get();

            if (isset($dados[0]->RECEITA)){
                
                $nReceita = $dados[0]->RECEITA;

            }

            if (isset($dados2[0]->DESPESA)){
                
                $nDespesa = $dados2[0]->DESPESA;

            }   
            if (isset($dados3[0]->ATIVO)){
                
                $nAtivo = $dados3[0]->ATIVO;

            }   
            ARRAY_PUSH($aInfo,[$nReceita,$nDespesa,$nAtivo]);
            
       
            //RECEITA POR PLANO

            $oRecPla = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" plano.nome,sum(valor) AS RECEITA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','1')
            ->where('lancamentos.excluido','=','0')
            ->GroupBy('nome')
            ->get();

         
            foreach ($oRecPla as $Rec) {
             
                if (isset($Rec->nome)){
                
                    ARRAY_PUSH($aRecDesc,$Rec->nome);
    
                }
    
                if (isset($Rec->RECEITA)){
                    
                    ARRAY_PUSH($aRecVal,$Rec->RECEITA);
    
                } 
                
                
          
            }

            $RetRec = json_encode($aRecVal);
            $RecDesc = json_encode($aRecDesc);
          
            //DESPESA POR PLANO

            $oDesPla = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" plano.nome,sum(valor) AS DESPESA"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','2')
            ->where('lancamentos.excluido','=','0')
            ->GroupBy('nome')
            ->get();

         
            foreach ($oDesPla as $Des) {
             
                if (!empty($Des->nome)){
                
                    ARRAY_PUSH($aDesDesc,$Des->nome);
    
                }
    
                if (!empty($Des->DESPESA)){
                    
                    ARRAY_PUSH($aDesVal,$Des->DESPESA);
    
                }  
                
                         
            }

            $RetDes = json_encode($aDesVal);
            $DesDesc = json_encode($aDesDesc);
            
            
            //DESPESA POR PLANO

            $oAtvPla = DB::table('lancamentos')
            ->join('plano', 'plano.id', '=', 'lancamentos.id_plano')
            ->join('classificacao', 'classificacao.id', '=', 'lancamentos.id_class')
            ->select(DB::RAW(" plano.nome,sum(valor) AS ATIVO"))
            ->whereRaw("year(Data_pagamento) = '".$cAnoAtual."'")
            ->whereRaw("month(Data_pagamento) = '".$cMesAtual."'")
            ->where('classificacao.tipo','=','3')
            ->where('lancamentos.excluido','=','0')
            ->GroupBy('nome')
            ->get();

         
            foreach ($oAtvPla as $Atv) {
             
                if (!empty($Atv->nome)){
                
                    ARRAY_PUSH($aAtvDesc,$Atv->nome);
    
                }
    
                if (!empty($Atv->ATIVO)){
                    
                    ARRAY_PUSH($aAtvVal,$Atv->ATIVO);
    
                }  
                
                         
            }

            $RetAtv = json_encode($aAtvVal);
            $AtvDesc = json_encode($aAtvDesc);
          
            return view ('welcome',compact('aInfo','RetRec','RecDesc','RetDes','DesDesc','RetAtv','AtvDesc', 'anos', 'cMesAtual', 'cAnoAtual'));
    }
}
