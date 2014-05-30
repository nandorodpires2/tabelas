<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estadio
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Estadio extends Zend_Form {
    
    public function init() {
        
        // nome_estadio
        $this->addElement('text', 'nome_estadio', array(
            'label' => 'Nome Estádio: '
        ));
        
        // apelido_estadio
        $this->addElement('text', 'apelido_estadio', array(
            'label' => 'Apelido Estádio: '
        ));
        
        // capacidade_estadio
        $this->addElement('text', 'capacidade_estadio', array(
            'label' => 'Capacidade Estádio: '
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
        
        // id_cidade
        $this->addElement('select', 'id_cidade', array(
            'label' => 'Cidade: ',
            'multioptions' => $this->getCidades()
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
    
    protected function getCidades() {
        
        $options = array(0 => 'Nenhuma');
        
        $modelCidade = new Model_Cidade();
        $cidades = $modelCidade->getCidades();
        
        foreach ($cidades as $cidade) {
            $options[$cidade->id_cidade] = $cidade->nome_cidade;
        }
        
        return $options;
        
    }
    
}
