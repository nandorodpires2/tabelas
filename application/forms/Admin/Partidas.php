<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Partidas
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_Partidas extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'formAdminPartida')
                ->setMethod('post');
        
        $this->addElement('select', 'id_campeonato', array(
            'label' => 'Campeonato: ',
            'multioptions' => $this->getCampeonatos() 
        ));
        
        $this->addElement('select', 'id_campeonato_temporada', array(
            'label' => 'Temporada: ',
            'required' => true,
            'multioptions' => array('' => 'Selecione a temporada')
        ));
        
        $this->addElement('select', 'id_fase_campeonato', array(
            'label' => 'Fase Campeonato: ',
            'required' => true,
            'multioptions' => array('' => 'Selecione a fase')
        ));
        
        $this->addElement('select', 'id_grupo', array(
            'label' => 'Grupo: ',
            'required' => true,
            'multioptions' => array('' => 'Selecione o grupo')
        ));
        
        $this->addElement('text', 'rodada_partida', array(
            'label' => 'Rodada:',
            'required' => true
        ));
        
        $this->addElement('text', 'data_partida', array(
            'label' => 'Data:',
            'required' => true
        ));
        
        $this->addElement('text', 'horario_partida', array(
            'label' => 'Horário:',
            'required' => true
        ));
        
        $this->addElement('select', 'id_estadio', array(
            'label' => 'Estádio: ',
            'required' => true,
            'multioptions' => $this->getEstadios()
        ));
        
        $this->addElement('select', 'equipe_mandante', array(
            'label' => 'Mandante: ',
            'required' => true,
            'multioptions' => array('' => 'selecione o mandante...')
        ));
        
        $this->addElement('select', 'equipe_visitante', array(
            'label' => 'Visitante: ',
            'required' => true,
            'multioptions' => array('' => 'selecione o visitante...')
        ));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'submit'
        ));
                        
    }
    
    protected function getCampeonatos() {
        
        $multioptions = array('' => 'selecione o campeonato...');
        
        $modelCampeonato = new Model_Campeonato();
        $campeonatos = $modelCampeonato->getCampeonatosNaoFinalizados();
        
        foreach ($campeonatos as $campeonato) {
            $multioptions[$campeonato->id_campeonato] = $campeonato->nome_campeonato;
        }
        
        return $multioptions;
        
    }
    
    protected function getEstadios() {
        
        $multiOptions = array('' => 'Selecione o estádio...');
        
        $modelEstadio = new Model_Estadio();
        $estadios = $modelEstadio->fetchAll(null, "apelido_estadio asc");
        
        foreach ($estadios as $estadio) {
            $multiOptions[$estadio->id_estadio] = $estadio->apelido_estadio;
        }
        
        return $multiOptions;
        
    }
    
}
