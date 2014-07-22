<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GrupoEquipe
 *
 * @author Fernando Rodrigues
 */
class Model_GrupoEquipe extends Zend_Db_Table_Abstract {
    
    protected $_name = "grupo_equipe";
    protected $_primary = "id_grupo";
    
    
    public function getEquipesGrupo($id_grupo, $id_fase_campeonato) {
        
        $select = $this->select()
                ->from(array('ge' => $this->_name), array('*'))
                ->setIntegrityCheck(false)
                ->joinInner(array('e' => 'equipe'), 'ge.id_equipe = e.id_equipe', array('*'))
                ->joinLeft(array('p' => 'pais'), 'e.id_pais = p.id_pais', array('*'))        
                ->joinLeft(array('es' => 'estadio'), 'e.id_estadio = es.id_estadio', array('*'))
                ->where("ge.id_grupo = ?", $id_grupo)
                ->where("ge.id_fase_campeonato = ?", $id_fase_campeonato);
        
        return $this->fetchAll($select);
        
    }
    
    public function getEquipesTemporada($id_campeonato_temporada) {
        $select = $this->select()
                ->from(array('ge' => 'grupo_equipe'), array('*'))
                ->setIntegrityCheck(false)
                ->joinInner(array('fc' => 'fase_campeonato'), 'ge.id_fase_campeonato = fc.id_fase_campeonato', array('*'))
                ->joinInner(array('e' => 'equipe'), 'ge.id_equipe = e.id_equipe', array('*'))
                ->where("fc.id_campeonato_temporada = ?", $id_campeonato_temporada)
                ->order("e.nome_equipe asc");
        
        return $this->fetchAll($select);
    }

    public function getJogadores() {
        
        $select = $this->select()
                ->from($this->_name, array('*'))
                ->where("jogador is not null")
                ->group("jogador")
                ->order("jogador asc");
        
        return $this->fetchAll($select);
        
    }
    
    public function populaComboJogadores() {
        $multiOptions = array("" => "Selecione...");
        $jogadores = $this->getJogadores();
        foreach ($jogadores as $jogador) {
            $multiOptions[$jogador->jogador] = $jogador->jogador;
        }
        return $multiOptions;
    }
    
}
