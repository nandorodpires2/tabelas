<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CampeoesController
 *
 * @author Fernando Rodrigues
 */
class Admin_CampeoesController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function indexAction() {
        
        $formCampeoes = new Form_Admin_Campeoes();
        $this->view->formCampeoes = $formCampeoes;
        
        $modelCampeao = new Model_Campeao();
        $campeoes = $modelCampeao->getCampeoes();        
        $this->view->campeoes = $campeoes;
        
        if ($this->_request->isPost()) {
            $dadosCampeao = $this->_request->getPost();
            if ($formCampeoes->isValid($dadosCampeao)) {
                $dadosCampeao = $formCampeoes->getValues();
                
                $modelCampeao->insert($dadosCampeao);
                
                $this->_redirect('admin/campeoes');
            }
        }
        
    }
    
    public function buscaTemporadasCampeonatoAction() {
        
        $this->_helper->layout->disableLayout(true);
        
        $id_campeonato = $this->_getParam('id_campeonato'); 
        
        $formCampeao = new Form_Admin_Campeoes();        
        $modelCampeoantoTemporada = new Model_CampenatoTemporada();
        $temporadas = $modelCampeoantoTemporada->getTemporadasByCampeonatoId($id_campeonato);
        
        $options = array('' => 'Selecione...');
        foreach ($temporadas as $temporada) {
            $options[$temporada->id_campeonato_temporada] = $temporada->ano_temporada;
        }
        
        $campeoantoTemporada = $formCampeao->id_campeonato_temporada;        
        $campeoantoTemporada->setMultiOptions($options);        
        $this->view->campeonatoTemporada = $campeoantoTemporada;
    }
    
    public function buscaEquipesTemporadaAction() {
        
        $this->_helper->layout->disableLayout(true);
        
        $id_campeonato_temporada = $this->_getParam('id_campeonato_temporada'); 
        
        $formCampeao = new Form_Admin_Campeoes();        
        $modelGrupoEquipe = new Model_GrupoEquipe();
        $equipes = $modelGrupoEquipe->getEquipesTemporada($id_campeonato_temporada);
        
        $options = array('' => 'Selecione...');
        foreach ($equipes as $equipe) {
            $options[$equipe->id_equipe] = $equipe->nome_equipe;
        }
        
        $equipesTemporada = $formCampeao->id_equipe;
        $equipesTemporada->setMultiOptions($options);  
        $this->view->equipesTemporada = $equipesTemporada;
        
    }
    
}
