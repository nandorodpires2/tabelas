<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reputacao
 *
 * @author Fernando Rodrigues
 */
class Model_Reputacao extends Zend_Db_Table_Abstract {
    
    protected $_name = "reputacao";
    
    protected $_primary = "id_reputacao";
    
    public function __destruct() {
        $this->getAdapter()->closeConnection();
    }
    
}
