<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VwRetrospecto
 *
 * @author Fernando Rodrigues
 */
class Model_VwRetrospecto extends Zend_Db_Table_Abstract {
    
    protected $_name = "vw_retrospecto";
    protected $_primary = "data_partida";
    
    public function getRetrospectos($jogador_1, $jogador_2) {
        
        $where = " 
            (jogador_1 = '{$jogador_1}' and jogador_2 = '{$jogador_2}')
            or (jogador_1 = '{$jogador_2}' and jogador_2 = '{$jogador_1}')
        ";
                        
        return $this->fetchAll($where, "data_partida asc");
        
    }
    
}
