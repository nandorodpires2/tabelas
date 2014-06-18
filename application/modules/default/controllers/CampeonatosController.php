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

    public function init() {
        $this->_id_campeonato = $this->_getParam('campeonato', $this->_getParam('id_campeonato'));
        $this->_id_temporada = $this->_getParam('temporada', $this->_getParam('id_temporada'));        
        
        // busca o titulo do campeonato
        $modelCampeonato = new Model_Campeonato();
        $this->view->nome_campeonato = $modelCampeonato->getNomeCampeonato($this->_id_campeonato);
        
    }
    
    public function indexAction() {
        
        $modelFaseCampeonato = new Model_FaseCampeonato();      
        $modelGrupo = new Model_Grupo();
        
        $fases = $modelFaseCampeonato->getFasesCampeonatoByCampeonatoTemporadaId($this->_id_temporada);          
        $id_fase_campeonato = $this->_getParam("id_fase_campeonato", $fases[0]->id_fase_campeonato);             
        
        $this->view->fase_anterior = $modelFaseCampeonato->getIdFaseAnterior($id_fase_campeonato, $this->_id_campeonato, $this->_id_temporada);
        $this->view->fase_seguinte = $modelFaseCampeonato->getIdFaseSeguinte($id_fase_campeonato, $this->_id_campeonato, $this->_id_temporada);
        
        $this->view->id_campeonato = $this->_id_campeonato;
        $this->view->id_temporada = $this->_id_temporada;
                                          
        $faseCampeonato = $modelFaseCampeonato->getFaseCampeonatoByFaseCampeonatoId($id_fase_campeonato);               
        
        $this->view->faseCampeonato = $faseCampeonato;
        
        // grupos
        $grupos = $modelGrupo->getGruposCampeonatoByFaseCampeonatoId($id_fase_campeonato);
        $this->view->grupos = $grupos;
        
        
    }
    
    public function buscaRodadaAction() {
        
        $this->_helper->layout->disableLayout(true);
        
        $id_campeonato = $this->_getParam("id_campeonato");
        $id_temporada = $this->_getParam("id_temporada");
        $id_grupo = $this->_getParam("id_grupo");
        $rodada = $this->_getParam("rodada");
        
        $modelPartida = new Model_Partida();
        $partidas = $modelPartida->getPartidas($id_campeonato, $id_temporada, $id_grupo, $rodada);
        $this->view->partidas = $partidas;
        $this->view->id_grupo = $id_grupo;
        $this->view->id_temporada = $id_temporada;
        $this->view->id_campeonato = $id_campeonato;
        
        $modelGrupo = new Model_Grupo();
        $this->view->dadosGrupo = $modelGrupo->fetchRow("id_grupo = {$id_grupo}");
        
    }
    
}
