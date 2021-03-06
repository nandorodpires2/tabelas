<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grupo
 *
 * @author Fernando Rodrigues
 */
class Model_Grupo extends Zend_Db_Table_Abstract {
    
    protected $_name = "grupo";
    
    protected $_primary = "id_grupo";
    
    public function getLastInsertId() {
    
        $select = $this->select()
                ->from($this->_name, array(
                    "last_id" => "last_insert_id(id_grupo)"
                ))
                ->order("id_grupo desc")
                ->limit(1);
        
        $query = $this->fetchRow($select);
        
        return (int)$query->last_id;
        
    }    
    
    public function getGruposCampeonatoByFaseCampeonatoId($id_fase_campeonato) {
        return $this->fetchAll(
            $this->select()
                ->where("id_fase_campeonato = ?", $id_fase_campeonato)
                ->order("descricao_grupo asc")                
        );
    }
    
    
    
}
