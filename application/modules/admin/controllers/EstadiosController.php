<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadiosController
 *
 * @author Fernando Rodrigues
 */
class Admin_EstadiosController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function novoEstadioAction() {
        
        $formEstadio = new Form_Admin_Estadio();
        $this->view->formEstadio = $formEstadio;
        
        $modelEstadio = new Model_Estadio();
        $estadios = $modelEstadio->fetchAll();
        $this->view->estadios = $estadios;
        
        if ($this->_request->isPost()) {
            $dadosEstadios = $this->_request->getPost();
            if ($formEstadio->isValid($dadosEstadios)) {
                $dadosEstadios = $formEstadio->getValues();
                
                $modelEstadio->insert($dadosEstadios);
                $this->_redirect("admin/estadios/novo-estadio");
                
            }
        }
        
    }
    
}
