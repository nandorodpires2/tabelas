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
        
        $modelVwTabela = new Model_VwTabela();
        $where = " 
            id_fase_campeonato = {$id_fase_campeonato} 
            and id_grupo = {$id_grupo}
        ";
        $order = " 
            (vitorias * 3) + empates desc,
            (gols_pro - gols_contra) desc,
            vitorias desc
        ";
        
        $tabela = $modelVwTabela->fetchAll($where, $order);
        
        return $tabela;
        
    }
    
    public static function getJogosMataMata($id_grupo, $id_fase_campeonato) {
        
        $modelPartida = new Model_Partida();
        $jogo = $modelPartida->getPartidasByFaseCampeonato($id_fase_campeonato, $id_grupo);
        
        return $jogo;
        
    }
    
}
