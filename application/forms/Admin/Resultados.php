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
        
        $this->addElement('text', 'placar_equipe_mandante', array('required' => true));
        $this->addElement('text', 'placar_equipe_visitante', array('required' => true));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'submit'
        ));
        
    }
    
    protected function getPartidasPendentes() {
        
        $multiOptions = array('' => 'Selecione a partida...');
        
        $modelPartida = new Model_Partida();
        $partidasPendentes = $modelPartida->getPartidasPendentes();
        
        foreach ($partidasPendentes as $partida) {
            
            $descricao = $partida->mandante . ' X ' . $partida->visitante . ' - ' . $partida->apelido_estadio;
            
            $multiOptions[$partida->id_partida] = $descricao;
        }
        
        return $multiOptions;
        
    }
    
}
