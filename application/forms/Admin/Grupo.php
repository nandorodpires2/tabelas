<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grupo
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Grupo extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'formGrupo')
                ->setMethod('post');
        
        // id_fase_campeonato
        $this->addElement('hidden', 'id_fase_campeonato');
        
        // descricao_grupo
        $this->addElement('text', 'descricao_grupo', array(
            'label' => 'Descrição Grupo: '
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));
                
        
    }
    
}
