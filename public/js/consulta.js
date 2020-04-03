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

$(document).ready(function() {
    $("#enviar").on('click', cliqueBotao);
});