/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function (){
   
    $("#id_campeonato").change(function (){
        var id_campeonato = $(this).val();
        buscaDadosCampeonato(id_campeonato);         
    });
    
    $("#id_campeonato_temporada").change(function (){
        var id_campeonato_temporada = $(this).val();
        buscaFasesCampeonato(id_campeonato_temporada);         
    });
    
    $("#id_fase_campeonato").change(function (){
        var id_fase_campeonato = $(this).val();
        buscaGruposFaseCampeonato(id_fase_campeonato);         
    });
    
    $("#id_grupo").change(function (){
        var id_grupo = $(this).val();
        buscaEquipesGrupo(id_grupo);        
    });
    
    //$("#data_partida").datepicker();
    $("#data_partida").mask("99/99/9999");
    $("#horario_partida").mask("99:99");
    
});

function buscaDadosCampeonato(id_campeonato) {
    $.ajax({
        url: baseUrl() + 'admin/partidas/busca-dados-campeonato',
        type: "get",
        data: {
            id_campeonato: id_campeonato
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#dados-campeonato").html("Buscando os dados da partida. Aguarde...");
        },
        success: function(dados) { 
            $("#dados-campeonato").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}

function buscaFasesCampeonato(id_campeonato_temporada) {
    $.ajax({
        url: baseUrl() + 'admin/partidas/busca-fases-campeonato',
        type: "get",
        data: {
            id_campeonato_temporada: id_campeonato_temporada
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#id_fase_campeonato").html("Carregando...");
        },
        success: function(dados) { 
            $("#id_fase_campeonato").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}

function buscaGruposFaseCampeonato(id_fase_campeonato) {
    $.ajax({
        url: baseUrl() + 'admin/partidas/busca-grupos-campeonato',
        type: "get",
        data: {
            id_fase_campeonato: id_fase_campeonato
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#id_grupo").html("Carregando...");
        },
        success: function(dados) { 
            $("#id_grupo").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}

function buscaEquipesGrupo(id_grupo) {
    $.ajax({
        url: baseUrl() + 'admin/partidas/busca-equipes-grupo',
        type: "get",
        data: {
            id_grupo: id_grupo
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#equipe_mandante").html("Carregando...");
            $("#equipe_visitante").html("Carregando...");
        },
        success: function(dados) { 
            $("#equipe_mandante").html(dados);
            $("#equipe_visitante").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}

