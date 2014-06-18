<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CampeonatosController
 *
 * @author Fernando Rodrigues
 */
class Admin_CampeonatosController extends Zend_Controller_Action {
    
    public function init() {
        
    }
    
    public function indexAction() {
        
    }
    
    public function novoCampeonatoAction() {
        
        // busca os campeonatos cadastrados
        $modelCampeonato = new Model_Campeonato();
        $campeonatos = $modelCampeonato->getCampeonatos();
        $this->view->campeonato = $campeonatos;
        
        $formCampeonato = new Form_Admin_Campeonatos();
        $this->view->formCampeonato = $formCampeonato;
        
        if ($this->_request->isPost()) {
            $dadosCampeonato = $this->_request->getPost();
            if ($formCampeonato->isValid($dadosCampeonato)) {
                $dadosCampeonato = $formCampeonato->getValues();
                
                $modelCampeonato->insert($dadosCampeonato);
                
                // busca o id inserido
                $last_id = $modelCampeonato->getLastInsertId();
                
                // redireciona para o proximo passo
                $this->_redirect("admin/campeonatos/novo-campeonato");
                
            }
        }
        
    }
    
    public function novaTemporadaAction() {
     
        $id_campeonato = $this->_getParam('id', null);
     
        $modelCampeonatoTemporada = new Model_CampeonatoTemporada();
        $temporadas = $modelCampeonatoTemporada->getTemporadasByCampeonatoId($id_campeonato);
        $this->view->temporadas = $temporadas;
        
        $formTemporada = new Form_Admin_Temporada();
        $formTemporada->id_campeonato->setValue($id_campeonato);
        
        $this->view->formTemporada = $formTemporada;
        
        if ($this->_request->isPost()) {
            $dadosTemporada = $this->_request->getPost();
            if ($formTemporada->isValid($dadosTemporada)) {
                $dadosTemporada = $formTemporada->getValues();
                
                
                $modelCampeonatoTemporada->insert($dadosTemporada);
                
                $last_id = $modelCampeonatoTemporada->getLastInsertId();
                
                // redireciona para o proximo passo
                $this->_redirect("admin/campeonatos/nova-temporada/id/" . $id_campeonato);
                
            }
        }
        
    }
    
    public function finalizarTemporadaAction() {
    
        
        $this->_helper->layout->disableLayout(true);
        $this->_helper->viewRenderer->setNoRender(true);
        
        $id_campeonato_temporada = $this->_getParam("id");
        
        $modelCampeonatoTemporada = new Model_CampenatoTemporada();
        $dados['finalizado'] = 1;
        $where = "id_campeonato_temporada = " . $id_campeonato_temporada;
        
        $modelCampeonatoTemporada->update($dados, $where);
        $this->_redirect("admin/campeonatos/novo-campeonato");
        
    }

    public function novaFaseCampeonatoAction() {
        
        $id_campeonato = $this->_getParam('id_campeonato', null);
        $id_campeonato_temporada = $this->_getParam('id', null);
        
        $modelFaseCampeonato = new Model_FaseCampeonato();
        // busca as fases do campeonato
        $fasesCampeonato = $modelFaseCampeonato->getFasesCampeonatoByCampeonatoTemporadaId($id_campeonato_temporada);
        $this->view->fasesCampeonato = $fasesCampeonato;
        
        $formFaseCampeonato = new Form_Admin_FaseCampeonato();
        $formFaseCampeonato->id_campeonato->setValue($id_campeonato);
        $formFaseCampeonato->id_campeonato_temporada->setValue($id_campeonato_temporada);
        $this->view->id_campeonato = $id_campeonato;
        $this->view->formFaseCampeonato = $formFaseCampeonato;
        
        if ($this->_request->isPost()) {
            $dadosFaseCampeonato = $this->_request->getPost();
            if ($formFaseCampeonato->isValid($dadosFaseCampeonato)) {
                $dadosFaseCampeonato = $formFaseCampeonato->getValues();
                
                $modelFaseCampeonato->insert($dadosFaseCampeonato);
                
                $last_id = $modelFaseCampeonato->getLastInsertId();
                
                // redireciona para o proximo passo
                $this->_redirect("admin/campeonatos/nova-fase-campeonato/id/" . $id_campeonato_temporada . "/id_campeonato/" . $id_campeonato);                
                
            }
        }
        
    }
    
    public function novoGrupoAction() {
        
        $id_fase_campeonato = $this->_getParam('id', null);
        $id_campeonato = $this->_getParam('id_campeonato', null);
        
        $modelGrupo = new Model_Grupo();
        
        // busca os grupos
        $grupos = $modelGrupo->getGruposCampeonatoByFaseCampeonatoId($id_fase_campeonato);
        $this->view->grupos = $grupos;
        
        $formGrupo = new Form_Admin_Grupo();
        $formGrupo->id_fase_campeonato->setValue($id_fase_campeonato);
        
        $this->view->id_campeonato = $id_campeonato;
        $this->view->id_fase_campeonato = $id_fase_campeonato;
        
        $this->view->formGrupo = $formGrupo;
        
        if ($this->_request->isPost()) {
            $dadosGrupo = $this->_request->getPost();
            if ($formGrupo->isValid($dadosGrupo)) {
                $dadosGrupo = $formGrupo->getValues();
                
                
                $modelGrupo->insert($dadosGrupo);
                
                $last_id = $modelGrupo->getLastInsertId();
                
                // redireciona para o proximo passo
                $this->_redirect("admin/campeonatos/novo-grupo/id/" . $id_fase_campeonato);
                
            }
        }        
        
    }
    
    public function novoGrupoEquipeAction() {
        
        $id_grupo = $this->_getParam('id', null);
        $id_fase_campeonato = $this->_getParam('id_fase_campeonato', null);
        
        $modelGrupoEquipe = new Model_GrupoEquipe();
        // busca as equipes        
        $equipes = $modelGrupoEquipe->getEquipesGrupo($id_grupo, $id_fase_campeonato);
        $this->view->equipes = $equipes;
        
        $formGrupoEquipe = new Form_Admin_GrupoEquipe();
        $formGrupoEquipe->id_grupo->setValue($id_grupo);
        $formGrupoEquipe->id_fase_campeonato->setValue($id_fase_campeonato);
        
        $this->view->formGrupoEquipe = $formGrupoEquipe;
        
        if ($this->_request->isPost()) {
            $dadosGrupoEquipe = $this->_request->getPost();
            if ($formGrupoEquipe->isValid($dadosGrupoEquipe)) {
                $dadosGrupoEquipe = $formGrupoEquipe->getValues();
                
                if ($dadosGrupoEquipe['jogador'] == '') {
                    $dadosGrupoEquipe['jogador'] = null;
                }
                
                $modelGrupoEquipe->insert($dadosGrupoEquipe);
                
                $this->_redirect("admin/campeonatos/novo-grupo-equipe/id/" . $id_grupo . "/id_fase_campeonato/" . $id_fase_campeonato);
                
            }
        }
        
    }
    
}
