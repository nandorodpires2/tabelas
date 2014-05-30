<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipesController
 *
 * @author Fernando Rodrigues
 */
class Admin_EquipesController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function novaEquipeAction() {
        
        $formEquipe = new Form_Admin_Equipe();
        $this->view->formEquipe = $formEquipe;
        
        if ($this->_request->isPost()) {
            $dadosEquipe = $this->_request->getPost();
            if ($formEquipe->isValid($dadosEquipe)) {
                $dadosEquipe = $formEquipe->getValues();
                
                Zend_Debug::dump($dadosEquipe);
                Zend_Debug::dump($_FILES);
            }
        }
        
    }
    
}
