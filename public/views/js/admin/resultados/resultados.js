/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function (){    
    $("#partida").change(function (){
        var id_partida = $(this).val();
        
        $.ajax({
            url: baseUrl() + 'admin/resultados/busca-partida',
            type: "get",
            data: {
                id_partida: id_partida
            },
            dataType: "html",
            beforeSend: function() {            
                $("#dados-campeonato").html("Buscando os dados do campeonato. Aguarde...");
            },
            success: function(dados) { 
                $("#dados-campeonato").html(dados);
            },
            error: function(error) {
                alert('Houve um erro');
            }
        }); 
        
    });
});
