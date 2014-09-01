<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campeonatos
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Campeonatos extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'formNovoCampeonato')
                ->setMethod('post');
        
        // nome_campeonato
        $this->addElement('text', 'nome_campeonato', array(
            'label' => 'Nome Campeonato: ',
            'required' => true,
            'class' => 'form-control'
        ));
        
        // descricao_campeonato
        $this->addElement('text', 'descricao_campeonato', array(
            'label' => 'Descrição Campeonato: ',
            'required' => true,
            'class' => 'form-control'
        ));
        
        // id_reputacao
        $this->addElement('select', 'id_reputacao', array(
            'label' => 'Reputação: ',
            'required' => true,
            'multioptions' => $this->getReputacao(),
            'class' => 'form-control'
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'btn btn-success pull-rigth'
        ));
        
    }
    
    protected function getReputacao() {
        
        $options = array("" => "Selecione...");
        
        $modelReputacao = new Model_Reputacao();        
        $reputacoes = $modelReputacao->fetchAll();
        
        foreach ($reputacoes as $reputacao) {
            $options[$reputacao->id_reputacao] = $reputacao->descricao_reputacao;
        }
        
        return $options;
        
    }
    
}
