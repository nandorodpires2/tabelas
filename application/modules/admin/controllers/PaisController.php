<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaisController
 *
 * @author Fernando Rodrigues
 */
class Admin_PaisController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function novoPaisAction() {
        
        $modelPais = new Model_Pais();
        
        $paises = $modelPais->fetchAll(null, "nome_pais asc");
        $this->view->paises = $paises;
        
        $formPais = new Form_Admin_Pais();
        $this->view->formPais = $formPais;
        
        if ($this->_request->isPost()) {
            $dadosPais = $this->_request->getPost();
            if ($formPais->isValid($dadosPais)) {
                $dadosPais = $formPais->getValues();
                
                $modelPais->insert($dadosPais);
                $this->_redirect("admin/pais/novo-pais");
                
            }
        }
        
    }
    
}
