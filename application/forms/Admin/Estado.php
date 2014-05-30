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
class Form_Admin_Estado extends Zend_Form {
    
    public function init() {
        
        // nome_estado
        $this->addElement('text', 'nome_estado', array(
            'label' => 'Estado: '
        ));
        
        // sigla_estado
        $this->addElement('text', 'sigla_estado', array(
            'label' => 'Sigla: '
        ));
        
        // id_pais
        $this->addElement('select', 'id_pais', array(
            'label' => 'País: ',
            'multioptions' => $this->getPaises()
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));        
        
    }
    
    protected function getPaises() {
        
        $options = array(0 => 'Nenhum');
        
        $modelPais = new Model_Pais();
        $paises = $modelPais->fetchAll(null, "nome_pais asc");
        
        foreach ($paises as $pais) {
            $options[$pais->id_pais] = $pais->nome_pais;
        }
        
        return $options;
        
    }
    
}
