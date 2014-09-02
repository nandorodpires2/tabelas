<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resultados
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Resultados extends Zend_Form {
    
    public function init() {
        
        $this->addElement('hidden', 'id_partida');
        
        $this->setAttrib('id', 'formResultados')
                ->setMethod('post');
        
        $this->addElement('select', 'partida', array(
            'label' => 'Partida: ',
            'required' => true,
            'multioptions' => $this->getPartidasPendentes(),
            'class' => 'form-control'
        ));
        
        $this->addElement('text', 'placar_equipe_mandante', array(
            'required' => true,
            'size' => 1,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div')),
                
            ),
            'class' => 'form-control text-center'
        ));
        
        $this->addElement('text', 'placar_equipe_visitante', array(
            'required' => true,
            'size' => 1,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div')),
                
            ),
            'class' => 'form-control text-center'
        ));
        
        $this->addElement('text', 'placar_pr_mandante', array(
            'required' => true,
            'size' => 1,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div')),
                array('Label', array('tag' => 'div')),
            ),
            'class' => 'form-control text-center'
        ));
        
        $this->addElement('text', 'placar_pr_visitante', array(
            'required' => true,
            'size' => 1,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div')),
                array('Label', array('tag' => 'div')),
            ),
            'class' => 'form-control text-center'
        ));
        
        $this->addElement('text', 'placar_pk_mandante', array(
            'required' => true,
            'size' => 1,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div')),
                array('Label', array('tag' => 'div')),
            ),
            'class' => 'form-control text-center'
        ));
        
        $this->addElement('text', 'placar_pk_visitante', array(
            'required' => true,
            'size' => 1,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div')),
                array('Label', array('tag' => 'div')),
            ),
            'class' => 'form-control text-center'
        ));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'submit',
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'div'))
            ),
            'class' => 'btn btn-success'
        ));
        
    }
    
    protected function getPartidasPendentes() {
        
        $modelPartida = new Model_Partida();
        $partidasPendentes = $modelPartida->getPartidasPendentes();
        
        if ($partidasPendentes->count() > 0) {
            $multiOptions = array('' => 'selectione...');            
            foreach ($partidasPendentes as $partida) {                
                $descricao = $partida->nome_campeonato . ' - Rodada ' . $partida->rodada_partida . ' | ' . $partida->mandante . ' X ' . $partida->visitante . ' (' . $partida->apelido_estadio . ')';
                $multiOptions[$partida->id_partida] = $descricao;
            }
        } else {
            $multiOptions = array("Nenhuma partida disponível");
        }
        
        return $multiOptions;
        
    }
    
}
