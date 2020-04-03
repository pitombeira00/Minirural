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
								<a class="breadcrumb">Lançamentos</a>
							</div>
						</div>
					</nav><br>		
				</div>
				<div class="panel-body">
					<div class="card">
						<div class="card-content">
							<div class="row">
                               <a href="{{route('lanca.create')}}" class="modal-trigger btn-floating  COL S2">
									<i class=" material-icons blue white-text circle" >add</i>
								</a>
								<a name="Toast"></a>
							</div>
							<div class="row">
								<table class="responsive-table" >
									<thead>
										<tr>
											<th>Data de Lançamento</th>
											<th>Plano de Contas</th>						
											<th>Classificação</th>						
											<th>Valor</th>						
											<th>Data de Pagamento</th>						
											<th>Editar</th>						
											<th>Apagar</th>						
										</tr>
									</thead>
									<tbody>
									@foreach($dados as $dad)
                                    <tr>
                                        <td>{{date('d/m/Y', strtotime($dad->created_at))}} </td>
                                        <td>{{$dad->plano->nome}} </td>
                                        <td>{{$dad->classificacao->descricao}} </td>
                                        <td>R$ {{ number_format($dad->valor, 2, ',','.')}} </td>
                                        <td>{{date('d/m/Y', strtotime($dad->Data_pagamento))}} </td>
                                        

                                        <td>
                                            <a href="javascript: if(confirm('Deseja Editar ?')){ window.location.href = '{{route('lanca.edit', $dad->id)}}' } " class="btn-floating">
                                                <i class=" material-icons green white-text circle" href="#modal1">create</i>
                                            </a>
                                        </td>    
                                        <td>
                                            <a href="javascript: if(confirm('Deseja Excluir\n Esse Lançamento ?')){ window.location.href = '{{route('lanca.destroy', $dad->id)}}' } " class="btn-floating">
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