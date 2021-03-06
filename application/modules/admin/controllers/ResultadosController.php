<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultadosController
 *
 * @author Fernando Rodrigues
 */
class Admin_ResultadosController extends Zend_Controller_Action {
    
    public function init() {
     
    }
    
    public function indexAction() {
        
        $formAdminResultados = new Form_Admin_Resultados();
        $formAdminResultados->removeElement('placar_equipe_mandante');
        $formAdminResultados->removeElement('placar_equipe_visitante');
        $formAdminResultados->removeElement('placar_pr_mandante');
        $formAdminResultados->removeElement('placar_pr_visitante');
        $formAdminResultados->removeElement('placar_pk_mandante');
        $formAdminResultados->removeElement('placar_pk_visitante');
        $formAdminResultados->removeElement('submit');
        $this->view->formResultados = $formAdminResultados;
        
        $modelPartida = new Model_Partida();
        $partidasPendentes = $modelPartida->getPartidasPendentes();
        $this->view->partidasPendentes = $partidasPendentes->count();
        
    }    
    
    public function buscaPartidaAction() {        
        
        $this->_helper->layout->disableLayout(true);        
        
        $id_partida = $this->_request->getParam('id_partida');
        
        // busca os dados da partida
        $modelPartida = new Model_Partida();
        $dadosPartida = $modelPartida->getPartidaById($id_partida);
        $this->view->dadosPartida = $dadosPartida;   
        
        $formAdminResultados = new Form_Admin_Resultados();
        $formAdminResultados->setAction('resultados/resultado');
        $formAdminResultados->removeElement('partida');
        $formAdminResultados->getElement('id_partida')->setValue($id_partida);
        $this->view->formResultados = $formAdminResultados;
        
    }
    
    public function resultadoAction() {        
        
        $this->_helper->viewRenderer->setNoRender(true);
        
        if ($this->_request->isPost()) {  
            
            $dadosResultado = $this->_request->getPost();
            unset($dadosResultado['submit']);
            $dadosResultado['realizada'] = 1;
            $where = "id_partida = " . $dadosResultado['id_partida'];
            
            $modelPartida = new Model_Partida();
            
            try {
                $modelPartida->update($dadosResultado, $where);
                $this->_redirect('admin/resultados');
            } catch (Exception $exc) {
                echo $exc->getTraceAsString(); die();
            }
            
        }
        
    }
    
}
