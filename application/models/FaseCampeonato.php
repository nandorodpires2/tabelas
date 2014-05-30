<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FaseCampeonato
 *
 * @author Fernando Rodrigues
 */
class Model_FaseCampeonato extends Zend_Db_Table_Abstract {
    
    protected $_name = "fase_campeonato";
    
    protected $_primary = "id_fase_campeonato";
    
    public function getLastInsertId() {
    
        $select = $this->select()
                ->from($this->_name, array(
                    "last_id" => "last_insert_id(id_fase_campeonato)"
                ))
                ->order("id_fase_campeonato desc")
                ->limit(1);
        
        $query = $this->fetchRow($select);
        
        return (int)$query->last_id;
        
    }
    
    public function getFasesCampeonatoByCampeonatoTemporadaId($id_campeonato_temporada) {        
        return $this->fetchAll($this->select()->where("id_campeonato_temporada = ?", $id_campeonato_temporada));
    }
    
    public function getFaseCampeonatoByFaseCampeonatoId($id_fase_campeonato) {
        return $this->fetchRow($this->select()->where("id_fase_campeonato = ?", $id_fase_campeonato));
    }
    
    public function getIdFaseAnterior($id_fase_campeonato, $id_campeonato, $id_temporada) {
        
        $select = $this->select()
                ->from($this->_name, array('*'))
                ->where("id_campeonato = ?", $id_campeonato)
                ->where("id_fase_campeonato < {$id_fase_campeonato}")
                ->where("id_campeonato_temporada = ?", $id_temporada)
                ->order("id_fase_campeonato desc");
        
        $query = $this->fetchRow($select);        
        return $query ? $query->id_fase_campeonato : null;
    }
    
    public function getIdFaseSeguinte($id_fase_campeonato, $id_campeonato, $id_temporada) {
        $query = $this->fetchRow("id_campeonato = {$id_campeonato} and id_fase_campeonato > {$id_fase_campeonato} and id_campeonato_temporada = {$id_temporada}");
        return $query ? $query->id_fase_campeonato : null;
    }
}
