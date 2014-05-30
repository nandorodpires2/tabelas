<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pais
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Pais extends Zend_Form {
    
    public function init() {
        
        // nome_pais
        $this->addElement('text', 'nome_pais', array(
            'label' => 'País: '
        ));
        
        // continente_pais
        $this->addElement('select', 'continente_pais', array(
            'label' => 'Continente: ',
            'multioptions' => array(
                'América Cental' => 'América Cental',
                'América do Note' => 'América do Note',
                'América do Sul' => 'América do Sul',
                'África' => 'África',
                'Ásia' => 'Ásia',
                'Europa' => 'Europa'
            )
        ));
        
        // federacao
        $this->addElement('select', 'federacao', array(
            'label' => 'Confederação: ',
            'multioptions' => array(
                'Concacaf' => 'Concacaf',
                'Commebol' => 'Commebol',
                'CAF' => 'CAF',
                'AFC' => 'AFC',
                'UEFA' => 'UEFA'
            )
        ));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));
        
    }
    
}
