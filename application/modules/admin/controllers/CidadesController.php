<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidadesController
 *
 * @author Fernando Rodrigues
 */
class Admin_CidadesController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function novaCidadeAction() {
        
        $modelCidade = new Model_Cidade();
        $cidades = $modelCidade->getCidades();
        $this->view->cidades = $cidades;
        
        $formCidade = new Form_Admin_Cidade();
        $this->view->formCidade = $formCidade;
        
        if ($this->_request->isPost()) {
            $dadosCidades = $this->_request->getPost();
            if ($formCidade->isValid($dadosCidades)) {
                $dadosCidades = $formCidade->getValues();
                
                $modelCidade->insert($dadosCidades);
                $this->_redirect("admin/cidades/nova-cidade");
                
            }
        }
        
    }
    
}
