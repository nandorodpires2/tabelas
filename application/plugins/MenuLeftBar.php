<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuLeftBar
 *
 * @author Fernando Rodrigues
 */
class Plugin_MenuLeftBar extends Zend_Controller_Plugin_Abstract {
    
    public function preDispatch(\Zend_Controller_Request_Abstract $request) {
        
        $modelReputacao = new Model_Reputacao();        
        $modelCampeonatoTemporada = new Model_CampenatoTemporada();
        
        $reputacoes = $modelReputacao->fetchAll(null, 'ordem asc')->toArray();
        $campeonatos = array();
        foreach ($reputacoes as $key => $reputacao) {
            $campeonatos[$key]['descricao_reputacao'] = $reputacao['descricao_reputacao']; 
            $campeonatos[$key]['campeonatos'] = $modelCampeonatoTemporada->getCampeonatosTemporadaReputacao($reputacao['id_reputacao'])->toArray();
        }   
        
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();        
        $view->campeonatos = $campeonatos;
        
        
    }
    
}
