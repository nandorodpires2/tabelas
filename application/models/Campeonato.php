<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campeoato
 *
 * @author Fernando Rodrigues
 */
class Model_Campeonato extends Zend_Db_Table_Abstract {
    
    protected $_name = "campeonato";
    
    protected $_primary = "id_campeonato";
    
    /**
     * retorna o nome do campeonato
     */
    public function getNomeCampeonato($id_campeonato) {        
        $row = $this->fetchRow("id_campeonato = {$id_campeonato}");
        return $row->descricao_campeonato;        
    }
    
    /**
     * retorna os campeonatos
     */
    public function getCampeonatos($where = null) {
        
        $select = $this->select()
                ->from(array('c' => $this->_name), '*')
                ->setIntegrityCheck(false)
                ->joinInner(array('ct' => 'campeonato_temporada'), 'c.id_campeonato = ct.id_campeonato', array('*'))
                ->order('c.nome_campeonato asc');
        
        if ($where) {
            $select->where($where);
        }
        
        return $this->fetchAll($select);
        
    }
    
}
