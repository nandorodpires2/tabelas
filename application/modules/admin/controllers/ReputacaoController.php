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
        $this->view->reputacoes = $modelReputacao->fetchAll(null, 'ordem asc');
        
        if ($this->_request->isPost()) {
            $dadosReputacao = $this->_request->getPost();
            if ($formReputacao->isValid($dadosReputacao)) {
                $dadosReputacao = $formReputacao->getValues();
                
                $modelReputacao->insert($dadosReputacao);                
                $this->_redirect("admin/reputacao/nova-reputacao");
                
            }
        }
        
    }
    
    public function editarReputacaoAction() {
        
    }
    
    public function excluirReputacaoAction() {
        
        $this->_helper->viewRenderer->setNoRender(true);
        
        $id_reputacao = $this->_getParam('id_reputacao');
        
        $modelCampeonato = new Model_Campeonato();
        $campeonatosReputacao = $modelCampeonato->fetchAll("id_reputacao = " . $id_reputacao);
        
        if ($campeonatosReputacao->count() == 0) {            
            $modelReputacao = new Model_Reputacao();
            $where = "id_reputacao = " . $id_reputacao;
            $modelReputacao->delete($where);
            
            $this->_redirect('admin/reputacao/nova-reputacao');
            
        } else {
            echo "Existe(m) campeonatos cadastrados para esta reputação";
        }

    }
    
}
