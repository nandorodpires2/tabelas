
$(document).ready(function(){
   
    $("#id_campeonato").change(function (){
        var id_campeonato = $(this).val();
        buscaDadosCampeonato(id_campeonato);         
        
    });
    
});


function buscaDadosCampeonato(id_campeonato) {
    $.ajax({
        url: baseUrl() + 'admin/campeoes/busca-temporadas-campeonato',
        type: "get",
        data: {
            id_campeonato: id_campeonato
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#id_campeonato_temporada").html("Carregando...");
        },
        success: function(dados) { 
            $("#id_campeonato_temporada").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}
