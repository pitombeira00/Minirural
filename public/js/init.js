function exibeNota(data){
	if ($.isArray(data)) {
			$("#retorno").empty();
			$.each(data, function(index, value) {
					$("#retorno").prepend("ID: "+value.id+"<br>Titulo: "+value.title+"<br>Conteudo: "+value.body+"<br><br>");
			});
	} else {
			$("#retorno").html("ID: "+data.id+"<br>Titulo: "+data.title+"<br>Conteudo: "+data.body+"<br><br>");
	}
	$("#loading").empty();
}

function exibeErroNota(){
	$("#retorno").html("Ops, algo de errado aconteceu.");
	$("#loading").empty();
}

function aguardaNota(){
	$("#loading").html("<img style='width: 15px; margin-left: 10px;' src='http://www.devmedia.com.br/cursos/img/loading.gif' alt='loading'>");
}

function cliqueBotao(event) {
	event.preventDefault();
	var id = $("#id_nota").val();
 
 jQuery.ajax({
			type: "GET",
			dataType: "json",
			url: "http://www.deveup.com.br/notas/api/notes/"+id,
			success: exibeNota,
			beforeSend: aguardaNota,
			error: exibeErroNota
	});
}

$(document).ready(function(){
	
	$(".button-collapse").sideNav();
	
	$('ul.tabs').tabs();
	
	$(".dropdown-button").dropdown();

	$('select').material_select();

	$('.modal').modal();

	$('input#input_text, textarae#textarea1').characterCounter();
  
	$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });

	$('#modal1').modal('open');

	$('#modal1').modal('close');

	$('.tooltipped').tooltip({delay: 50});
	
	
	
		function Adicionar(){
		$("#tblCadastro tbody").append(
			"<tr>"+
			"<td><input type='text'/></td>"+
		  "<td><select><option>teste</option></select></td>"+
			"<td><a id='enviar' class='modal-trigger btn-floating'><i class=' material-icons green white-text circle' >search</i></a></td>"+
			"<td><button id='enviar'>ENVIAR</button> <span id='loading'></span></td>"+
			"</tr>");

		$(".btnSalvar").bind("click", Salvar);     
		$(".btnExcluir").bind("click", Excluir);
	};

	function Salvar(){
		var par = $(this).parent().parent(); //tr
		var tdNome = par.children("td:nth-child(1)");
		var tdTelefone = par.children("td:nth-child(2)");
		var tdEmail = par.children("td:nth-child(3)");
		var tdBotoes = par.children("td:nth-child(4)");

		tdNome.html(tdNome.children("input[type=text]").val());
		tdTelefone.html(tdTelefone.children("input[type=text]").val());
		tdEmail.html(tdEmail.children("input[type=text]").val());
		tdBotoes.html("<img src='images/delete.png'class='btnExcluir'/><img src='images/pencil.png' class='btnEditar'/>");

		$(".btnEditar").bind("click", Editar);
		$(".btnExcluir").bind("click", Excluir);
	};

	function Editar(){
		var par = $(this).parent().parent(); //tr
		var tdNome = par.children("td:nth-child(1)");
		var tdTelefone = par.children("td:nth-child(2)");
		var tdEmail = par.children("td:nth-child(3)");
		var tdBotoes = par.children("td:nth-child(4)");

		tdNome.html("<input type='text' id='txtNome' value='"+tdNome.html()+"'/>");
		tdTelefone.html("<input type='text'id='txtTelefone' value='"+tdTelefone.html()+"'/>");
		tdEmail.html("<input type='text' id='txtEmail' value='"+tdEmail.html()+"'/>");
		tdBotoes.html("<img src='images/disk.png' class='btnSalvar'/>");

		$(".btnSalvar").bind("click", Salvar);
		$(".btnEditar").bind("click", Editar);
		$(".btnExcluir").bind("click", Excluir);
	};

	function Excluir(){
			var par = $(this).parent().parent(); //tr
			par.remove();
	};

	$(".btnEditar").bind("click", Editar);
	$(".btnExcluir").bind("click", Excluir);
	$("#btnAdicionar").bind("click", Adicionar); 
	
	$("#enviar").on('click', cliqueBotao);
})