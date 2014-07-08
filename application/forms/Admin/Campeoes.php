<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campeoes
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Campeoes extends Zend_Form {
    
    
    public function init() {
        
        $this->setAttrib('id', 'formCampeoes')
                ->setMethod('post');        
        
        // id_campeonato
        $this->addElement('select', 'id_campeonato', array(
            'label' => 'Campeonato: ',
            'multioptions' => $this->getCampeonatosFinalizadosSemCampeao()
        ));
        
        // id_temporada
        $this->addElement('select', 'id_campeonato_temporada', array(
            'label' => 'Temporada: ',
            'multioptions' => array()
        ));
        
        // id_equipe
        $this->addElement('select', 'id_equipe', array(
            'label' => 'Campeão: ',
            'multioptions' => array()
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));
        
    }
    
    protected function getCampeonatosFinalizadosSemCampeao() {
        
        $options = array('Selecione...');
        
        $modelCampeonato = new Model_Campeonato();
        $campeonatos = $modelCampeonato->getCampeonatosFinalizados();
        foreach ($campeonatos as $campeonato) {
            $options[$campeonato->id_campeonato] = $campeonato->descricao_campeonato;
        }
        
        return $options;
        
    }
    
}
