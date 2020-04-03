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
								<a class="breadcrumb">Demonstrativo Geral</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
							<div class="row">
                               <form method="POST" action="{{route('rel.dem')}} ">
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
										<i class=" material-icons blue white-text circle" >search</i>
									</button>
								</div>
								</form>
							<a name="Toast"></a>
							</div>
							<div class="row">
							@if(isset($GERAL))
							<div class="col s12">
								<div class="card z-depth-5">
									<div class="card-content purple-text">
									<table class="highlight responsive" >
										<thead>
											<tr>
												<th>Plano</th>
												<th>Receita</th>						
												<th>Despesas</th>						
												<th>Lucro/Prejuizo</th>						
											</tr>
											<tbody>
											<tr>
											@foreach ($GERAL as $mes)
													<tr>
														<td>R$ {{$mes->nome}} </td>
														<td>R$ {{ number_format($mes->RECEITA, 2, ',','.')}} </td>
														<td>R$ {{ number_format($mes->DESPESA, 2, ',','.')}} </td>
														<td>R$ {{ number_format($mes->RECEITA - $mes->DESPESA, 2, ',','.')}} </td>
													<tr>
											@endforeach
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