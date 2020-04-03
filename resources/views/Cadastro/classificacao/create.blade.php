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
								<a class="breadcrumb">Classificação</a>
								<a class="breadcrumb">Incluir</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
                        <h4 class='center'>Criar Classificação de Lançamento</h4>
							<form method="POST" action="{{route('class.store')}} ">
								{{csrf_field()}}
								<div class="row">
							        <div class="input-field col s12">
							          <input name="descricao" type="text" class="validate">
							          <label>Nome do Lançamento</label>
							        </div>
									<div class="input-field col s12">
							          	<select name="tipo_plano" class="validate">
										      <option value="" disabled selected>Tipo de plano</option>
										      <option value="1">Receita</option>
										      <option value="2">Despesa/Custo</option>
										      <option value="3">Ativo</option>
										</select>
									    <label>Tipo de Plano</label>
							        </div>
							    <button type="submit" class="waves-effect green btn right" >Adicionar</button>
						      	<a href="{{route('class.home')}} " class="red white-text waves-effect right btn ">Cancelar</a>
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