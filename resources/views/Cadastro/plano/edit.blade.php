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
								<a class="breadcrumb">Planos</a>
								<a class="breadcrumb">Incluir</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
                        <h4 class='center'>Editar Plano de Conta</h4>
							<form method="POST" action="{{route('plano.update')}} ">
								{{csrf_field()}}
								<div class="row">
							        <div class="input-field col s12">
                                    <input type="hidden" name="id" value="{{$dados->id}}">
							          <input name="nome" type="text" class="validate" value="{{ isset($dados->nome) ? $dados->nome : '' }}">
							          <label>Nome do Plano de Conta</label>
							        </div>
							    <button type="submit" class="waves-effect green btn right" >Editar</button>
						      	<a href="{{route('plano.home')}} " class="red white-text waves-effect right btn ">Cancelar</a>
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