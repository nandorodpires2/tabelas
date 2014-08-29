$(document).ready(function(){
    
    buscaEquipesLetra('A');
    
    $(".aba_equipe").click(function(){               
        var letra = $(this).attr('id');
        buscaEquipesLetra(letra);
    });
    
});

function buscaEquipesLetra(letra) {
    $.ajax({
        url: baseUrl() + 'admin/equipes/busca-equipes',
        type: "get",
        data: {
            letra: letra
        },
        dataType: "html",
        beforeSend: function() {                        
            $("#table_equipes").html("Buscando os dados da partida. Aguarde...");
        },
        success: function(dados) { 
            $("#table_equipes").html(dados);
        },
        error: function(error) {
            alert('Houve um erro');
        }
    });
}