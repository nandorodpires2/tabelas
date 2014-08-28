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
            'multioptions' => $this->getCampeonatos(),
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'id_campeonato_temporada', array(
            'label' => 'Temporada: ',
            'required' => true,
            'multioptions' => array('' => 'Selecione a temporada'),
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'id_fase_campeonato', array(
            'label' => 'Fase Campeonato: ',
            'required' => true,
            'multioptions' => array('' => 'Selecione a fase'),
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'id_grupo', array(
            'label' => 'Grupo: ',
            'required' => true,
            'multioptions' => array('' => 'Selecione o grupo'),
            'class' => 'form-control'
        ));
        
        $this->addElement('text', 'rodada_partida', array(
            'label' => 'Rodada:',
            'required' => true,
            'class' => 'form-control'
        ));
        
        $this->addElement('text', 'data_partida', array(
            'label' => 'Data:',
            'required' => true,
            'class' => 'form-control'
        ));
        
        $this->addElement('text', 'horario_partida', array(
            'label' => 'Horário:',
            'required' => true,
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'tipo_partida', array(
            'label' => 'Tipo de Partida:',
            'required' => true,
            'multioptions' => array(
                'ida' => 'Ida',
                'volta' => 'Volta'
            ),
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'id_estadio', array(
            'label' => 'Estádio: ',
            'required' => true,
            'multioptions' => $this->getEstadios(),
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'equipe_mandante', array(
            'label' => 'Mandante: ',
            'required' => true,
            'multioptions' => array('' => 'selecione o mandante...'),
            'class' => 'form-control'
        ));
        
        $this->addElement('text', 'placar_equipe_mandante', array(
            'label' => 'Placar Mandante: ',
            'class' => 'form-control'
        ));
        
        $this->addElement('select', 'equipe_visitante', array(
            'label' => 'Visitante: ',
            'required' => true,
            'multioptions' => array('' => 'selecione o visitante...'),
            'class' => 'form-control'
        ));
        
        $this->addElement('text', 'placar_equipe_visitante', array(
            'label' => 'Placar Visitante: ',
            'class' => 'form-control'
        ));
        
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar',
            'class' => 'submit',
            'class' => 'btn btn-success pull-rigth'
        ));
                        
    }
    
    protected function getCampeonatos() {
        
        $multioptions = array('' => 'selecione o campeonato...');
        
        $modelCampeonato = new Model_Campeonato();
        $campeonatos = $modelCampeonato->getCampeonatosNaoFinalizados();
        
        foreach ($campeonatos as $campeonato) {
            $multioptions[$campeonato->id_campeonato] = $campeonato->descricao_campeonato;
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
