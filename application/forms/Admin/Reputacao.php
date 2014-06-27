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
class Form_Admin_Reputacao extends Zend_Form {
    
    public function init() {
        
        // descricao_reputacao
        $this->addElement('text', 'descricao_reputacao', array(
            'label' => 'Reputação: ',
            'required' => true
        ));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));        
        
    }
    
}
