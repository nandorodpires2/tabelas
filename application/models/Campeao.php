<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campeao
 *
 * @author Fernando Rodrigues
 */
class Model_Campeao extends Zend_Db_Table_Abstract {
    
    protected $_name = "campeao";
    
    protected $_primary = "id_campeao";
    
    public function getCampeoes() {
        
        $select = $this->select()
                ->from(array('c' => $this->_name), array('*'))
                ->setIntegrityCheck(false)
                ->joinInner(array('cp' => 'campeonato'), 'c.id_campeonato = cp.id_campeonato', array('*'))
                ->joinInner(array('ct' => 'campeonato_temporada'), 'c.id_campeonato_temporada = ct.id_campeonato_temporada', array('*'))
                ->joinInner(array('e' => 'equipe'), 'c.id_equipe = e.id_equipe', array('*'));
        
        return $this->fetchAll($select);
        
    }
    
}
