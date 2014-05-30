<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author Fernando Rodrigues
 */
class Model_Cidade extends Zend_Db_Table {
    
    protected $_name = "cidade";
    protected $_primary = "id_cidade";
    
    public function getCidades() {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('cid' => $this->_name), array('*'))
                ->joinLeft(array('p' => 'pais'), 'cid.id_pais = p.id_pais', array('*'))
                ->joinLeft(array('e' => 'estado'), 'cid.id_estado = e.id_estado', array('*'))
                ->order('p.nome_pais asc')
                ->order('e.nome_estado asc')
                ->order('cid.nome_cidade asc');
        
        return $this->fetchAll($select);
    }
    
}
