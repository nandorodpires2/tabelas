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
        
        $modelEquipe = new Model_Equipe();
        
        $letras = $modelEquipe->getLetrasEquipe();
        $this->view->letras = $letras;
        
        if ($this->_request->isPost()) {
            $dadosEquipe = $this->_request->getPost();
            if ($formEquipe->isValid($dadosEquipe)) {
                $dadosEquipe = $formEquipe->getValues();
                
                // faz o dowonload
                if ($_FILES['escudo']['name'] != '') {                    
                    $path = PUBLIC_PATH . '/views/img/escudos/';                    
                    if (move_uploaded_file($_FILES['escudo']['tmp_name'], $path . '/' . $_FILES['escudo']['name'])) {
                        $dadosEquipe['escudo_equipe'] = $_FILES['escudo']['name'];
                    }                 
                    unset($dadosEquipe['escudo']);
                }                
                
                // gravando os dados
                $modelEquipe->insert($dadosEquipe);
                $this->_redirect("admin/equipes/nova-equipe");
                
            }
        }
        
    }
    
    public function editarEquipeAction() {
        
        $id_equipe = $this->_getParam('id_equipe');
        
        $modelEquipe = new Model_Equipe();
        $dadosEquipe = $modelEquipe->find($id_equipe)->toArray();
        $dadosEquipe = $dadosEquipe[0];
        
        $formEquipe = new Form_Admin_Equipe();
        $formEquipe->populate($dadosEquipe);
        $formEquipe->submit->setLabel('Editar');
             
        $this->view->formEquipe = $formEquipe;
        
        if ($this->_request->isPost()) {
            $dadosUpdateEquipe = $this->_request->getPost();
            if ($formEquipe->isValid($dadosUpdateEquipe)) {
                $dadosUpdateEquipe = $formEquipe->getValues();
                                
                $where = "id_equipe = " . $id_equipe;
                $modelEquipe->update($dadosUpdateEquipe, $where);
                
                $this->_redirect('admin/equipes/nova-equipe');
                
            }
        }        
        
    }
    
    public function buscaEquipesAction() {
        
        $this->_helper->layout->disableLayout(true);
        
        $letra = $this->_getParam('letra', null);
        
        if ($letra) {
            
            $modelEquipe = new Model_Equipe();
            $equipes = $modelEquipe->getEquipes($letra);
            $this->view->equipes = $equipes;
            
        }
        
    }
    
}
