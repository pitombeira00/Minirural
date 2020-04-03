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
								<a class="breadcrumb">Relatórios</a>
								<a class="breadcrumb">Fluxo - Anual</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
							<div class="row">
                               <form method="POST" action="{{route('fluxo.anual')}} ">
							   {{csrf_field()}}
							   <div class="input-field col s10 ">
									<select name="ano" class="validate">
									<option value="" disabled selected>Escolha o Ano</option>
                                                @foreach($anos as $ano)
                                              <option value="{{$ano->ANO}}">{{$ano->ANO}}</option>
                                                @endforeach
									</select>
									<label>Ano do fluxo</label>
								</div>

								<div class="col s2">
									<button type="submit" class="right modal-trigger btn-floating  COL S2" >
										<i class=" material-icons blue white-text circle" >search</i>
									</button>
								</div>
								</form>
							<a name="Toast"></a>
							</div>
							<div class="row">
							@if(isset($aMES))
							<div class="col s12">
								<div class="card z-depth-5">
									<div class="card-content purple-text">
									<table class="responsive-table" >
										<thead>
											<tr>
												<th>Fluxo de Caixa</th>
												<th>Janeiro</th>
												<th>Fevereiro</th>						
												<th>Março</th>						
												<th>Abril</th>						
												<th>Maio</th>						
												<th>Junho</th>						
												<th>Julho</th>						
												<th>Agosto</th>						
												<th>Setembro</th>						
												<th>Outubro</th>						
												<th>Novembro</th>						
												<th>Dezembro</th>						
											</tr>
											<tbody>
											<tr>
                                                <td>Valor Inicial </td>
                                                <td>R$ {{number_format($aMES[0][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[1][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[2][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[3][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[4][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[5][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[6][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[7][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[8][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[9][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[10][4], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[11][4], 2, ',','.')}} </td>
                                            </tr>
											<tr>
                                                <td>Receitas </td>
                                                <td>R$ {{number_format($aMES[0][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[1][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[2][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[3][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[4][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[5][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[6][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[7][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[8][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[9][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[10][1], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[11][1], 2, ',','.')}} </td>
                                            </tr>
											<tr>
                                                <td>Despesas/Custos </td>
                                                <td>R$ {{number_format($aMES[0][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[1][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[2][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[3][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[4][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[5][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[6][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[7][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[8][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[9][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[10][2], 2, ',','.')}} </td>
                                                <td>R$ {{number_format($aMES[11][2], 2, ',','.')}} </td>
                                            </tr>
											<tr>
                                                <td>Ativo </td>
												<td>R$ {{number_format($aMES[0][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[1][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[2][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[3][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[4][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[5][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[6][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[7][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[8][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[9][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[10][3], 2, ',','.')}} </td>
												<td>R$ {{number_format($aMES[11][3], 2, ',','.')}} </td>
                                            </tr>
											<tr>
                                                <td>Lucro/Prejuizo </td>
                                                <td @if ( ($aMES[0][4] + $aMES[0][1] - $aMES[0][2]) < 0) class='red-text' @endif >R$ {{number_format($aMES[0][4] + $aMES[0][1] - $aMES[0][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[1][4] + $aMES[1][1] - $aMES[1][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[1][4] + $aMES[1][1] - $aMES[1][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[2][4] + $aMES[2][1] - $aMES[2][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[2][4] + $aMES[2][1] - $aMES[2][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[3][4] + $aMES[3][1] - $aMES[3][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[3][4] + $aMES[3][1] - $aMES[3][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[4][4] + $aMES[4][1] - $aMES[4][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[4][4] + $aMES[4][1] - $aMES[4][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[5][4] + $aMES[5][1] - $aMES[5][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[5][4] + $aMES[5][1] - $aMES[5][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[6][4] + $aMES[6][1] - $aMES[6][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[6][4] + $aMES[6][1] - $aMES[6][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[7][4] + $aMES[7][1] - $aMES[7][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[7][4] + $aMES[7][1] - $aMES[7][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[8][4] + $aMES[8][1] - $aMES[8][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[8][4] + $aMES[8][1] - $aMES[8][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[9][4] + $aMES[9][1] - $aMES[9][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[9][4] + $aMES[9][1] - $aMES[9][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[10][4] + $aMES[10][1] - $aMES[10][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[10][4] + $aMES[10][1] - $aMES[10][2], 2, ',','.') }} </td>
                                                <td @if ( ($aMES[11][4] + $aMES[11][1] - $aMES[11][2]) < 0) class='red-text' @endif>R$ {{number_format($aMES[11][4] + $aMES[11][1] - $aMES[11][2], 2, ',','.') }} </td>
                                            </tr>
											</tbody>
										</thead>
									</table>
									</div>
								</div>
							</div>
							@endif 
							
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>        
	</div>
</div>
@endsection