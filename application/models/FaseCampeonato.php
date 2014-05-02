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
    
    public function getFasesCampeonatoByCampeonatoTemporadaId($id_campeonato_temporada) {
        return $this->fetchAll($this->select()->where("id_campeonato_temporada = ?", $id_campeonato_temporada));
    }
    
}
