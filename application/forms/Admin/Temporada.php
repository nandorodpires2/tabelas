<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Temporada
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Temporada extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'formTemporada')
                ->setMethod('post');
        
        // ano_temporada
        $this->addElement('text', 'ano_temporada', array(
            'label' => 'Ano Temporada: ',
            'required' => true
        ));
        
        // id_campeonato
        $this->addElement('hidden', 'id_campeonato');
        
        // finalizado
        $this->addElement('hidden', 'finalizado', array('value' => 0));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));
        
    }
    
}
