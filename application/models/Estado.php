<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estado
 *
 * @author Fernando Rodrigues
 */
class Model_Estado extends Zend_Db_Table {
    
    protected $_name = "estado";
    protected $_primary = "id_estado";
    
    public function getEstados() {
        
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('est' => $this->_name), array('*'))
                ->joinInner(array('pa' => 'pais'), 'est.id_pais = pa.id_pais', array('*'))
                ->order('pa.nome_pais asc');
        
        return $this->fetchAll($select);
        
    }
    
}
