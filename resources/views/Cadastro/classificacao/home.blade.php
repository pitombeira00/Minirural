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
								<a class="breadcrumb">Cadastro</a>
								<a class="breadcrumb">Classificação</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
							<div class="row">
                               <a href="{{route('class.create')}}" class="modal-trigger btn-floating  COL S2">
									<i class=" material-icons blue white-text circle" >add</i>
								</a>
								<a name="Toast"></a>
							</div>
							<div class="row">
								<table class="responsive-table" >
									<thead>
										<tr>
											<th>Codigo</th>
											<th>Descrição</th>						
											<th>Tipo de Classificação</th>						
											<th>Editar</th>						
											<th>Excluir</th>						
										</tr>
									</thead>
									<tbody>
									@foreach($dados as $dad)
                                    <tr>
                                        <td>{{$dad->id}} </td> 
                                        <td>{{$dad->descricao}} </td>
										@if($dad->tipo == 1)
                                            <td>Receita</td>
										@elseif($dad->tipo == 2)
                                            <td>Despesa/Custo</td>
										@elseif($dad->tipo == 3)
                                            <td>Ativo</td>
										@endif
                                        <td>
                                            <a href="javascript: if(confirm('Deseja Editar ?')){ window.location.href = '{{route('class.edit', $dad->id)}}' } " class="btn-floating">
                                                <i class=" material-icons green white-text circle" href="#modal1">create</i>
                                            </a>
                                        </td>    
                                        <td>
                                            <a href="javascript: if(confirm('Deseja Excluir\n Essa Classificação ?')){ window.location.href = '{{route('class.destroy', $dad->id)}}' } " class="btn-floating">
                                                <i class=" material-icons red white-text circle" href="#modal1">close</i>
                                            </a>
                                        </td>
                                    @endforeach
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>        
	</div>
</div>
@endsection