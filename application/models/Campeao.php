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
        
    }
    
}
