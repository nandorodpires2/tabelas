<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Retrospecto
 *
 * @author Fernando Rodrigues
 */
class Form_Default_Retrospecto extends Zend_Form {
    
    public function init() {
        
        $modelGrupoEquipe = new Model_GrupoEquipe();
        
        $this->setAttrib('id', 'formDefaultRetrospecto')
                ->setMethod('post');
        
        // jogador A
        $this->addElement('select', 'jogador_1', array(
            'label' => 'Jogador A',
            'required' => true,
            'multioptions' => $modelGrupoEquipe->populaComboJogadores()
        ));
        
        // jogador B
        $this->addElement('select', 'jogador_2', array(
            'label' => 'Jogador B',
            'required' => true,
            'multioptions' => $modelGrupoEquipe->populaComboJogadores()
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Buscar'
        ));
        
    }
    
}
