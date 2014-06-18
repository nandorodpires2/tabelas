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
            'multioptions' => $this->getPartidasPendentes()
        ));
        
        $this->addElement('text', 'placar_equipe_mandante', array(
            'required' => true,
            'size' => 2,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
            )
        ));
        $this->addElement('text', 'placar_equipe_visitante', array(
            'required' => true,
            'size' => 2,
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'td')),
                array('Label', array('tag' => 'td')),
            )
        ));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'submit',
            'decorators' => array(
                'ViewHelper',
                'Description',
                'Errors',
                array(array('td' => 'HtmlTag'), array('tag' => 'td'))
            )
        ));
        
    }
    
    protected function getPartidasPendentes() {
        
        
        
        $modelPartida = new Model_Partida();
        $partidasPendentes = $modelPartida->getPartidasPendentes();
        
        if ($partidasPendentes->count() > 0) {
            $multiOptions = array('' => 'Selecione a partida...');
        
            foreach ($partidasPendentes as $partida) {

                $descricao = $partida->mandante . ' X ' . $partida->visitante . ' - ' . $partida->apelido_estadio;

                $multiOptions[$partida->id_partida] = $descricao;
            }
        } else {
            $multiOptions = array("Nenhuma partida disponível");
        }
        
        return $multiOptions;
        
    }
    
}
