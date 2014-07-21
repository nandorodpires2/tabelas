<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipes
 *
 * @author Fernando Rodrigues
 */
class View_Helper_Tabela extends Zend_View_Helper_Abstract {
    
    public static function getTabelaGrupo($id_grupo, $id_fase_campeonato) {
        
        $modelFaseCampeonato = new Model_FaseCampeonato();
        $dadosFaseCampeonato = $modelFaseCampeonato->find($id_fase_campeonato);
        
        $modelVwTabela = new Model_VwTabela();
        $tabela = $modelVwTabela->getTabelaCampeonatoTemporada($dadosFaseCampeonato[0]->id_campeonato, $dadosFaseCampeonato[0]->id_campeonato_temporada, $id_grupo, $id_fase_campeonato);
                
        return $tabela;
        
    }
    
    public static function getJogosMataMata($id_grupo, $id_fase_campeonato) {
        
        $modelPartida = new Model_Partida();
        $jogo = $modelPartida->getPartidasByFaseCampeonato($id_fase_campeonato, $id_grupo);
        
        return $jogo;
        
    }
    
}
