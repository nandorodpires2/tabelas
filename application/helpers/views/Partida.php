<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Partida
 *
 * @author Fernando Rodrigues
 */
class View_Helper_Partida extends Zend_View_Helper_Abstract {
    
    public static function getRodadas($id_campeonato, $id_temporada, $id_grupo) {
        
        $modelPartida = new Model_Partida();
        $partidas = $modelPartida->getPartidas($id_campeonato, $id_temporada, $id_grupo);
        return $partidas;
        
    }
    
}
