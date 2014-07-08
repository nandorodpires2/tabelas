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
    
}
