<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CampeonatoTemporada
 *
 * @author Fernando Rodrigues
 */
class Model_CampeonatoTemporada extends Zend_Db_Table {
    
    protected $_name = "campeonato_temporada";
    
    protected $_primary = "id_campeonato_temporada";
    
    public function getLastInsertId() {
    
        $select = $this->select()
                ->from($this->_name, array(
                    "last_id" => "last_insert_id(id_campeonato_temporada)"
                ))
                ->order("id_campeonato_temporada desc")
                ->limit(1);
        
        $query = $this->fetchRow($select);
        
        return (int)$query->last_id;
        
    }
    
    public function getTemporadasByCampeonatoId($id_campeonato) {
        return $this->fetchAll("id_campeonato = {$id_campeonato}");
    }
    
}
