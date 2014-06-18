/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   
    $("#rodada_select").change(function(){
        var id_campeonato = $("#id_campeonato").val();
        var id_temporada = $("#id_temporada").val();
        var id_grupo = $("#id_grupo").val();
        var rodada = $(this).val();
        
        buscaRodada(id_campeonato, id_temporada, id_grupo, rodada);
        
    });
    
});

function buscaRodada(id_campeonato, id_temporada, id_grupo, rodada) {    
    $.ajax({
        url: baseUrl() + 'campeonatos/busca-rodada',
        type: "get",
        data: {
            id_campeonato: id_campeonato,
            id_temporada: id_temporada,
            id_grupo: id_grupo,
            rodada: rodada
        },
        dataType: "html",
        beforeSend: function() {   
            
        },
        success: function(dados) { 
            $("#rodada_grupo_" + id_grupo).empty();
            $("#rodada_grupo_" + id_grupo).html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}