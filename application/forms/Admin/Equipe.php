<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipe
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Equipe extends Zend_Form {
    
    public function init() {
        
        // nome_completo_equipe
        $this->addElement('text', 'nome_completo_equipe', array(
            'label' => 'Nome Completo: ',
            'class' => 'form-control'
        ));
        
        // nome_equipe
        $this->addElement('text', 'nome_equipe', array(
            'label' => 'Nome Equipe: ',
            'class' => 'form-control'
        ));
        
        // selecao
        $this->addElement('select', 'selecao', array(
            'label' => 'Seleção: ',
            'multioptions' => array(
                '' => 'Selecione...',
                1 => 'Sim',
                0 => 'Não'
            ),
            'required' => true,
            'class' => 'form-control' 
        ));
        
        // upload
        /*
        $this->addElement('file', 'escudo', array(
            'label' => 'Escudo Equipe: '
        ));
        */
        
        // id_estadio
        $this->addElement('select', 'id_estadio', array(
            'label' => 'Estádio: ',
            'multioptions' => $this->getEstadios(),
            'class' => 'form-control'
        ));
        
        // id_pais
        $this->addElement('select', 'id_pais', array(
            'label' => 'País: ',
            'multioptions' => $this->getPaises(),
            'class' => 'form-control'
        ));

        // id_estado
        $this->addElement('select', 'id_estado', array(
            'label' => 'Estado: ',
            'multioptions' => $this->getEstados(),
            'class' => 'form-control'
        ));
        
        // id_cidade
        $this->addElement('select', 'id_cidade', array(
            'label' => 'Cidade: ',
            'multioptions' => $this->getCidades(),
            'class' => 'form-control'
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'btn btn-success pull-rigth'
        )); 
        
        
    }
    
    protected function getEstadios() {
        
        $options = array(0 => 'Nenhum');
        
        $modelEstadio = new Model_Estadio();
        $estadios = $modelEstadio->fetchAll();
        
        foreach ($estadios as $estadio) {            
            $options[$estadio->id_estadio] = $estadio->nome_estadio;            
        }
        
        return $options;
        
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
