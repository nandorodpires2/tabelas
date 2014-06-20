<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReputacaoController
 *
 * @author Fernando Rodrigues
 */
class Admin_ReputacaoController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function indexAction() {
        
    }
    
    public function novaReputacaoAction() {
        
        $formReputacao = new Form_Admin_Reputacao();        
        $this->view->formReputacao = $formReputacao;
        
        $modelReputacao = new Model_Reputacao();
        $this->view->reputacoes = $modelReputacao->fetchAll();
        
        if ($this->_request->isPost()) {
            $dadosReputacao = $this->_request->getPost();
            if ($formReputacao->isValid($dadosReputacao)) {
                $dadosReputacao = $formReputacao->getValues();
                
                $modelReputacao->insert($dadosReputacao);
                $this->redirect("admin/reputacao/nova-reputacao");
                
            }
        }
        
    }
    
}
