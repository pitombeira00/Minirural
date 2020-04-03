@extends('layout.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><br>
					<nav>
						<div class="nav-wrapper deep-purple darken-4 z-depth-5">
							<div class="col s12">
								<a class="breadcrumb">Fluxo de Caixa</a>
								<a class="breadcrumb">Tela Inicial</a>
								<a class="breadcrumb">Mês {{$cMesAtual}} / Ano {{$cAnoAtual}}</a>
							</div>
						</div>
					</nav><br>		
				</div>
        <div class="row">
          <div class="col s12 m6">
            <div class="card white z-depth-5">
              <div class="card-content deep-purple-text">
                <span class="card-title">Receitas (Entradas) </span>
                <p>R$ {{number_format($aInfo[0][0], 2, ',','.')}} </p>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card z-depth-5">
              <div class="card-content deep-purple-text">
                <span class="card-title">Despesas/Custos (Pagamentos)</span>
                <p>R$ {{number_format($aInfo[0][1], 2, ',','.')}} </p>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card z-depth-5">
              <div class="card-content deep-purple-text">
                <span class="card-title">Lucro/Prejuizo</span>
                <p>R$ {{number_format($aInfo[0][0] - $aInfo[0][1], 2, ',','.')}} </p>
              </div>
            </div>
          </div>
          <div class="col s12 m6">
            <div class="card z-depth-5">
              <div class="card-content deep-purple-text">
                <span class="card-title">Ativo (Investimentos)</span>
                <p>
                R$ {{number_format($aInfo[0][2], 2, ',','.')}}
                </p>
              </div>
            </div>
          </div>
        </div>
              <div class="row">
                  <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a class="active" href="#Compara">Comparação</a></li>
                        <li class="tab col s3 purple-text"><a href="#Receita">Detalhamento Receitas</a></li>
                        <li class="tab col s3"><a href="#Despesa">Detalhamento Despesas/Custo</a></li>
                        <li class="tab col s3"><a href="#Ativo">Detalhamento Ativo </a></li>
                    </ul>
                    </div>
                    <div id="Compara" class="col s8 offset-s2">
                      <div id="chart1"></div>
                     
                        <div class="col s12">
                        <form method="POST" action="{{route('home.inicial')}} ">
							          {{csrf_field()}}
                          <div class="input-field col s5 ">
                            <select name="ano" class="validate">
                            <option value="" disabled selected>Escolha o Ano</option>
                                                          @foreach($anos as $ano)
                                                        <option value="{{$ano->ANO}}">{{$ano->ANO}}</option>
                                                          @endforeach
                            </select>
                            <label>Ano</label>
                          </div>
                          <div class="input-field col s5 ">
                            <select name="mes" class="validate">
                            <option value="" disabled selected>Escolha o Mes</option>
                            
                                  @for ($i = 1; $i <= 12; $i++)
                                  
                                                        <option value="{{$i}}">@if($i==3) março @else {{strftime('%B', strtotime($i.'/06/2019'))}} @endif</option>
                                                          @endfor
                            </select>
                            <label>Mes</label>
                          </div>
                        
                        <div class="col s2">
                          <button type="submit" class="right modal-trigger btn-floating  COL S2" >
                            <i class=" material-icons blue circle" >autorenew</i>
                          </button>
                        </div>
                      </form>
                      </div>
                    </div>
                    <div id="Receita" class="col s8 offset-s2">
                        <div id="chart" style="min-height: 158.566px;"></div>
                    </div>
                    <div id="Despesa" class="col s8 offset-s2"> 
                     <div id="chart2"></div>
                    </div>
                    <div id="Ativo" class="col s8 offset-s2"> 
                     <div id="chart3"></div>
                    </div>
            </div>
			</div>
		</div>        
	</div>
</div>
<script>

var DivReceita = {
            chart: {
                type: 'donut',
                size: '10%'
            },
            series: <?php echo(json_encode($RetRec,JSON_NUMERIC_CHECK)) ?>,
            labels: <?php echo($RecDesc) ?>
            
        }

var DivDespesa = {
            chart: {
                type: 'donut',
                size: '10%'
            },
            series: <?php echo(json_encode($RetDes,JSON_NUMERIC_CHECK)) ?>,
            labels: <?php echo($DesDesc) ?>
        }
        
var DivAtivo = {
            chart: {
                type: 'donut',
                size: '10%'
            },
            series: <?php echo(json_encode($RetAtv,JSON_NUMERIC_CHECK)) ?>,
            labels: <?php echo($AtvDesc) ?>
        }

var compara = {
  chart: {
    type: 'bar'
  },
   series: [
    {
    name: 'Receitas',
    data: [{!! $aInfo[0][0] !!}]
    },
   {
    name: 'Despesa/Custo',
    data: [{!! $aInfo[0][1] !!}]
   },
   {
    name: 'Ativo',
    data: [{!! $aInfo[0][2] !!}]
   }],
  xaxis: {
    categories: ['Receita','Despesa/Custo','Ativo'],
    colors:['#F44336', '#E91E63', '#F44336']
 
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), DivReceita);
var chart1 = new ApexCharts(document.querySelector("#chart1"), compara);
var chart2 = new ApexCharts(document.querySelector("#chart2"), DivDespesa);
var chart3 = new ApexCharts(document.querySelector("#chart3"), DivAtivo);

chart1.render();
chart2.render();
chart3.render();
chart.render();

</script>
@endsection