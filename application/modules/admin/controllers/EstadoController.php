<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoController
 *
 * @author Fernando Rodrigues
 */
class Admin_EstadoController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function novoEstadoAction() {
        
        $modelEstado = new Model_Estado();
        $estados = $modelEstado->getEstados();
        $this->view->estados = $estados;
        
        $formEstado = new Form_Admin_Estado();
        $this->view->formEstado = $formEstado;
        
        if ($this->_request->isPost()) {
            $dadosEstado = $this->_request->getPost();
            if ($formEstado->isValid($dadosEstado)) {
                $dadosEstado = $formEstado->getValues();
                
                $modelEstado->insert($dadosEstado);
                $this->_redirect("admin/estado/novo-estado");
                
            }
        }
        
    }
    
}
