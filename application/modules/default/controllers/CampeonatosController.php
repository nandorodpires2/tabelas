<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CampeonatosController
 *
 * @author Fernando Rodrigues
 */
class Default_CampeonatosController extends Zend_Controller_Action {
    
    protected $_id_campeonato;    
    protected $_id_temporada;
    protected $_id_fase_campeonato;

    public function init() {
        $this->_id_campeonato = $this->_getParam('campeonato');
        $this->_id_temporada = $this->_getParam('temporada');
        $this->_id_fase_campeonato = $this->_getParam("id_fase_campeonato", null);
        
        // busca o titulo do campeonato
        $modelCampeonato = new Model_Campeonato();
        $this->view->nome_campeonato = $modelCampeonato->getNomeCampeonato($this->_id_campeonato);
        
    }
    
    public function indexAction() {
        
        // busca a tabela do campeonato
        $modelVwTabela = new Model_VwTabela();
        $tabelaCampeonato = $modelVwTabela->getTabelaCampeonatoTemporada($this->_id_campeonato, $this->_id_temporada);
        
        $modelPartida = new Model_Partida();
        $this->view->partidas = $modelPartida->getPartidas($this->_id_campeonato, $this->_id_temporada);
        
        //Zend_Debug::dump($this->view->partidas); die();
        $this->view->tabelaCampeonato = $tabelaCampeonato;
        $this->view->pos = 1;
        
    }
    
}
