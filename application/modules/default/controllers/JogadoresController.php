<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JogadoresController
 *
 * @author Fernando Rodrigues
 */
class Default_JogadoresController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function indexAction() {
        
        $modelVwTabelaJogadores = new Model_VwTabelaJogadores();        
        $tabelaJogadores = $modelVwTabelaJogadores->fetchAll();
        $this->view->tabelaJogadores = $tabelaJogadores;
        
        $formDefaultRetrospecto = new Form_Default_Retrospecto();
        $this->view->formDefaultRetrospecto = $formDefaultRetrospecto;
        
        if ($this->_request->isPost()) {
            $dadosRetrospecto = $this->_request->getPost();
            if ($formDefaultRetrospecto->isValid($dadosRetrospecto)) {
                $dadosRetrospecto = $formDefaultRetrospecto->getValues();                
                if ($dadosRetrospecto['jogador_1'] !== $dadosRetrospecto['jogador_2']) {                    
                    $modelVwRetrospecto = new Model_VwRetrospecto();
                    $retrospectos = $modelVwRetrospecto->getRetrospectos($dadosRetrospecto['jogador_1'], $dadosRetrospecto['jogador_2']);                    
                    $this->view->retrospectos = $retrospectos;                    
                } else {
                    echo "Escolha jogadores diferentes";
                }                
            }
        }
        
    }
    
}
