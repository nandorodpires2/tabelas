<?php

class Default_IndexController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {

        $modelPartida = new Model_Partida();
        
        $data_ontem = date('Y-m-d', strtotime("-1 days"));
        $data_hoje = date('Y-m-d');
        $data_amanha = date('Y-m-d', strtotime("+1 days"));
        
        $partidasOntem = $modelPartida->getPartidadasByDate($data_ontem);
        $partidasHoje = $modelPartida->getPartidadasByDate($data_hoje);
        $partidasAmanha = $modelPartida->getPartidadasByDate($data_amanha);
        
        $this->view->partidasOntem = $partidasOntem;
        $this->view->partidasHoje = $partidasHoje;
        $this->view->partidasAmanha = $partidasAmanha;
        
    }

}

