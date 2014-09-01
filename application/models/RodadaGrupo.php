<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RodadaGrupo
 *
 * @author Fernando Rodrigues
 */
class Model_RodadaGrupo extends Zend_Db_Table_Abstract {
    
    protected $_name = "rodada_grupo";
    
    protected $_primary = "id_rodada_grupo";
    
    public function getRodadaAtualGrupo($id_grupo) {
        
        $select = $this->select()
                ->from(array('rg' => $this->_name), array(
                    "rodada" => "min(rg.rodada)"
                ))
                ->where("rg.id_grupo = ?", $id_grupo)
                ->where("rg.finalizado = ?", 0);
        
        return $this->fetchRow($select);
        
    }
    
}
