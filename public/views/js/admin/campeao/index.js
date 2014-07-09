
$(document).ready(function(){
   
    $("#id_campeonato").change(function (){
        var id_campeonato = $(this).val();
        buscaDadosCampeonato(id_campeonato);         
        
    });
    
    $("#id_campeonato_temporada").change(function (){
        var id_campeonato_temporada = $(this).val();
        buscaEquipesTemporada(id_campeonato_temporada);         
        
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

function buscaEquipesTemporada(id_campeonato_temporada) {
    $.ajax({
        url: baseUrl() + 'admin/campeoes/busca-equipes-temporada',
        type: "get",
        data: {
            id_campeonato_temporada: id_campeonato_temporada
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#id_equipe").html("Carregando...");
        },
        success: function(dados) { 
            $("#id_equipe").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}
