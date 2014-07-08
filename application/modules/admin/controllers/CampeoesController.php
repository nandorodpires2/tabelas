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
    
}
