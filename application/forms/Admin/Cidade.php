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
class Form_Admin_Cidade extends Zend_Form {
    
    public function init() {

        // nome_cidade
        $this->addElement('text', 'nome_cidade', array(
            'label' => 'Cidade: '            
        ));
        
        // id_pais
        $this->addElement('select', 'id_pais', array(
            'label' => 'País: ',
            'multioptions' => $this->getPaises()
        ));

        // id_estado
        $this->addElement('select', 'id_estado', array(
            'label' => 'Estado: ',
            'multioptions' => $this->getEstados()
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
    
    protected function getEstados() {
        
        $options = array(0 => 'Nenhum');
        
        $modelEstado = new Model_Estado();
        $estados = $modelEstado->fetchAll(null, "nome_estado asc");
        
        foreach ($estados as $estado) {
            $options[$estado->id_estado] = $estado->nome_estado;
        }
        
        return $options;
        
    }
    
}
