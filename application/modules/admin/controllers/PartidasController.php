<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartidasController
 *
 * @author Fernando Rodrigues
 */
class Admin_PartidasController extends Zend_Controller_Action {
    
    protected $_id_campeonato;

    public function init() {
        $this->_id_campeonato = null;
    }
    
    public function indexAction() {
        
    }
    
    public function novaPartidaAction() {
        
        $formAdminPartida = new Form_Admin_Partidas();
        
        $formAdminPartida->removeElement('id_campeonato_temporada');
        $formAdminPartida->removeElement('id_fase_campeonato');
        $formAdminPartida->removeElement('id_grupo');
        $formAdminPartida->removeElement('data_partida');
        $formAdminPartida->removeElement('horario_partida');
        $formAdminPartida->removeElement('id_estadio');
        $formAdminPartida->removeElement('rodada_partida');
        $formAdminPartida->removeElement('equipe_mandante');
        $formAdminPartida->removeElement('equipe_visitante');
        $formAdminPartida->removeElement('placar_equipe_mandante');
        $formAdminPartida->removeElement('placar_equipe_visitante');
        $formAdminPartida->removeElement('submit');
        
        $this->view->formAdminPartida = $formAdminPartida;
        
        if ($this->_request->isPost()) {
            $dadosPartida = $this->_request->getPost();
            
            unset($dadosPartida['id_campeonato_temporada']);
            unset($dadosPartida['id_fase_campeonato']);
            unset($dadosPartida['submit']);
            
            $zendDate = new Zend_Date($dadosPartida['data_partida']);            
            $dadosPartida['data_partida'] = $zendDate->toString("YYYY-MM-dd");
                        
            $modelPartida = new Model_Partida();
            try {
                $modelPartida->insert($dadosPartida);
                $this->_redirect("admin/partidas/nova-partida");
            } catch (Zend_Db_Table_Exception $error) {
                echo $error->getMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            
        }
                
    }
    
    public function editarPartidaAction() {
    
        $id_partida = $this->_getParam('id_partida');
        
        $modelPartida = new Model_Partida();
        $dadosPartida = $modelPartida->getPartidaById($id_partida)->toArray();
        $this->view->dadosPartida = $dadosPartida;
        
        $formPartida = new Form_Admin_Partidas();
                
        $formPartida->removeElement('id_campeonato_temporada');
        $formPartida->removeElement('id_fase_campeonato');
        $formPartida->removeElement('id_grupo');
        //$formPartida->removeElement('submit');
        
        $formResultado = new Form_Admin_Resultados();
        $formResultado->removeElement('partida');
        
        $modelEquipe = new Model_Equipe();
        $equipes = $modelEquipe->fetchAll();
        
        $array_equipe = array();
        foreach ($equipes as $equipe) {
            $array_equipe[$equipe->id_equipe] = $equipe->nome_equipe;
        }
        
        $formPartida->equipe_mandante->addMultioptions($array_equipe);
        $formPartida->equipe_visitante->addMultioptions($array_equipe);
        $formPartida->populate($dadosPartida);
        $this->view->formPartida = $formPartida;
        
        $formResultado->populate($dadosPartida);
        $this->view->formResultado = $formResultado;
        
        if ($this->_request->isPost()) {
            $dadosUpdate = $this->_request->getPost();
            
            if ($formPartida->isValid($dadosUpdate)) {
                $dadosUpdate = array_merge($formPartida->getValues(), $formResultado->getValues());
                
                unset($dadosUpdate['id_campeonato']);
                
                $where = "id_partida = " . $id_partida;
                
                try {
                    $modelPartida->update($dadosUpdate, $where);                    
                } catch (Zend_Db_Exception $error) {
                    echo $error->getMessage();
                }
                
                $this->_redirect('admin/partidas/nova-partida');
                
            }
        }
        
    }

    public function buscaDadosCampeonatoAction() {
        
        $this->_helper->layout->disableLayout(true);
        
        $this->_id_campeonato = $this->_request->getParam('id_campeonato');
        
        $formAdminPartida = new Form_Admin_Partidas();
        $formAdminPartida->removeElement('placar_equipe_mandante');
        $formAdminPartida->removeElement('placar_equipe_visitante');
        $formAdminPartida->removeElement('id_campeonato');
        
        // temporada
        $formAdminPartida->id_campeonato_temporada->setMultiOptions($this->getTemporadasCampeonato());
        
        $this->view->formAdminPartida = $formAdminPartida;
        
    }
    
    public function buscaFasesCampeonatoAction() {
        $this->_helper->layout->disableLayout(true);
        $this->_helper->viewRenderer->setNoRender(true);
        
        $id_campeonato_temporada = $this->_request->getParam('id_campeonato_temporada');
        
        // busca as fases do campeonato
        $modelFaseCampeonato = new Model_FaseCampeonato();
        $fases = $modelFaseCampeonato->getFasesCampeonatoByCampeonatoTemporadaId($id_campeonato_temporada);
        
        $multioptions = "<option value=''>Selecione a fase...</option>";
        foreach ($fases as $fase) {
            $multioptions .= "<option value='{$fase->id_fase_campeonato}'>{$fase->descricao_fase}</option>";
        } 
        echo $multioptions;
    }
    
    public function buscaGruposCampeonatoAction() {
        $this->_helper->layout->disableLayout(true);
        $this->_helper->viewRenderer->setNoRender(true);
        
        $id_fase_campeonato = $this->_request->getParam('id_fase_campeonato');
        
        // busca as fases do campeonato
        $modelGrupo = new Model_Grupo();
        $grupos = $modelGrupo->getGruposCampeonatoByFaseCampeonatoId($id_fase_campeonato);
        
        $multioptions = "<option value=''>Selecione a fase...</option>";
        foreach ($grupos as $grupo) {
            $multioptions .= "<option value='{$grupo->id_grupo}'>{$grupo->descricao_grupo}</option>";
        } 
        echo $multioptions;
    }
    
    public function buscaEquipesGrupoAction() {
        $this->_helper->layout->disableLayout(true);
        $this->_helper->viewRenderer->setNoRender(true);
        
        $id_grupo = $this->_request->getParam('id_grupo');
        
        $modelEquipe = new Model_Equipe();
        $equipes = $modelEquipe->getEquipesByGrupoId($id_grupo);
        
        $multioptions = "<option value=''>Selecione a fase...</option>";
        foreach ($equipes as $equipe) {
            $multioptions .= "<option value='{$equipe->id_equipe}'>{$equipe->nome_equipe}</option>";
        } 
        echo $multioptions;
        
    }

    public function buscaPartidasTemporadaAction() {
        $this->_helper->layout->disableLayout(true);
        
        $id_campeonato_temporada = $this->_getParam('id_temporada', null);
        $id_fase_campeonato = $this->_getParam('id_fase_campeonato', null);
        $id_grupo = $this->_getParam('id_grupo', null);
        $rodada = $this->_getParam('rodada', null);
        
        $modelPartida = new Model_Partida();
        $partidas = $modelPartida->getPartidadasByTemporada($id_campeonato_temporada, $id_fase_campeonato, $id_grupo, $rodada);
        $this->view->partidas = $partidas;
        
    }

    /**
     * 
     * @return type array
     */
    protected function getTemporadasCampeonato() {
        $modelCampeonatoTemporada = new Model_CampenatoTemporada();
        $temporadas = $modelCampeonatoTemporada->getTemporadasByCampeonatoId($this->_id_campeonato);
        
        $multiOptions = array('' => 'Selecione a temporada...');
        
        foreach ($temporadas as $temporada) {
            $multiOptions[$temporada->id_campeonato_temporada] = $temporada->ano_temporada;
        }
        
        return $multiOptions;
        
    }
    
}
