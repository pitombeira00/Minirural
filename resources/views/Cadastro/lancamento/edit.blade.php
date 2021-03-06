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
								<a class="breadcrumb">Cadastros</a>
								<a class="breadcrumb">Lançamentos</a>
								<a class="breadcrumb">Editar</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
                        <h4 class='center'>Lançamentos</h4>
							<form method="POST" action="{{route('lanca.update')}} ">
								{{csrf_field()}}
								<div class="row">
                                    <input type="hidden" name="id" value="{{$dados->id}}">
							        <div class="input-field col s12">
							          <input name="valor" type="number" step=0.01 class="validate" value="{{ isset($dados->valor) ? $dados->valor : '' }}">
							          <label>Valor</label>
							        </div>
                                    <div class="inputfield col s12">
                                        <label>Data de Pagamento</label>
                                    </div>
							        <div class="input-field col s12">
							          <input name="data" type="date" class="validate" value="{{ isset($dados->Data_pagamento) ? $dados->Data_pagamento : '' }}">
							        </div>
							        <div class="input-field col s12">
							          	<select name="id_plano" class="validate">
										      <option value="" disabled selected>Escolha o Plano de Conta</option>
                                                @foreach($planos as $plan)
                                              <option value="{{$plan->id}}"
                                               @if($dados->id_plano == $plan->id)
                                               selected
                                               @endif
                                               >{{$plan->nome}}</option>
                                                @endforeach
                                        </select>
									    <label>Plano de Conta</label>
							        </div>
							        <div class="input-field col s12">
							          	<select name="id_class" class="validate">
										      <option value="" disabled selected>Escolha a Classificação</option>
                                                @foreach($class as $cla)
                                              <option value="{{$cla->id}}"
                                              @if($dados->id_class == $cla->id)
                                               selected
                                               @endif
                                              >{{$cla->descricao}}</option>
                                                @endforeach
                                        </select>
									    <label>Classificação</label>
							        </div>
							    <button type="submit" class="waves-effect green btn right" >Editar</button>
						      	<a href="{{route('lanca.home')}} " class="red white-text waves-effect right btn ">Cancelar</a>
								</div>
							</form>

						</div>
					</div>
				</div>
			</div>
		</div>        
	</div>
</div>
@endsection