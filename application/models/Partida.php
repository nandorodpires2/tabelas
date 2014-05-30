<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Partida
 *
 * @author Fernando Rodrigues
 */
class Model_Partida extends Zend_Db_Table_Abstract {
    
    protected $_name = "partida";
    
    protected $_primary = "id_partida";
    
    // busca as rodadas
    public function getRodadasCampeonatoTemporada($id_campeonato, $id_temporada) {
        
    }
    
    /**
     * busca uma partida pelo id
     */
    public function getPartidaById($id_partida) {
        $select = $this->select()
                ->from(array('p' => $this->_name), array(
                    '*'
                ))
                ->setIntegrityCheck(false)
                ->joinInner(array('g' => 'grupo'), 'p.id_grupo = g.id_grupo', array(
                    '*'
                ))
                ->joinInner(array('fc' => 'fase_campeonato'), 'g.id_fase_campeonato = fc.id_fase_campeonato', array(
                    '*'
                ))
                ->joinInner(array('e1' => 'equipe'), 'p.equipe_mandante = e1.id_equipe', array(
                    'mandante' => 'e1.nome_equipe'
                ))
                ->joinInner(array('e2' => 'equipe'), 'p.equipe_visitante = e2.id_equipe', array(
                    'visitante' => 'e2.nome_equipe'
                ))
                ->joinInner(array('e' => 'estadio'), 'p.id_estadio = e.id_estadio', array(
                    'e.apelido_estadio'
                ))
                ->where('p.id_partida = ?', $id_partida);
        
        return $this->fetchRow($select);
    }

    // busca as partidas
    public function getPartidas($id_campeonato, $id_temporada, $id_grupo = null) {
        
        $select = $this->select()
                ->from(array('p' => $this->_name), array(
                    '*'
                ))
                ->setIntegrityCheck(false)
                ->joinInner(array('g' => 'grupo'), 'p.id_grupo = g.id_grupo', array(
                    '*'
                ))
                ->joinInner(array('fc' => 'fase_campeonato'), 'g.id_fase_campeonato = fc.id_fase_campeonato', array(
                    '*'
                ))
                ->joinInner(array('e1' => 'equipe'), 'p.equipe_mandante = e1.id_equipe', array(
                    'mandante' => 'e1.nome_equipe',
                    'escudo_mandante' => 'e1.escudo_equipe'
                ))
                ->joinInner(array('e2' => 'equipe'), 'p.equipe_visitante = e2.id_equipe', array(
                    'visitante' => 'e2.nome_equipe',
                    'escudo_visitante' => 'e2.escudo_equipe'
                ))
                ->joinInner(array('e' => 'estadio'), 'p.id_estadio = e.id_estadio', array(
                    'e.apelido_estadio'
                ))
                ->where('fc.id_campeonato_temporada = ?', $id_temporada)
                ->where('fc.id_campeonato = ?', $id_campeonato)
                ->order('p.rodada_partida desc');
        
        if ($id_grupo) {
            $select->where("p.id_grupo = ?", $id_grupo);
        }
        
        return $this->fetchAll($select);
        
    }
    
    /**
     * retorna as partidas pendentes de setar resultado
     */
    public function getPartidasPendentes() {
        
        $select = $this->select()
                ->from(array('p' => $this->_name), array(
                    '*'
                ))
                ->setIntegrityCheck(false)
                ->joinInner(array('g' => 'grupo'), 'p.id_grupo = g.id_grupo', array(
                    '*'
                ))
                ->joinInner(array('fc' => 'fase_campeonato'), 'g.id_fase_campeonato = fc.id_fase_campeonato', array(
                    '*'
                ))
                ->joinInner(array('e1' => 'equipe'), 'p.equipe_mandante = e1.id_equipe', array(
                    'mandante' => 'e1.nome_equipe'
                ))
                ->joinInner(array('e2' => 'equipe'), 'p.equipe_visitante = e2.id_equipe', array(
                    'visitante' => 'e2.nome_equipe'
                ))
                ->joinInner(array('e' => 'estadio'), 'p.id_estadio = e.id_estadio', array(
                    'e.apelido_estadio'
                ))
                ->where("p.realizada = 0 or p.data_partida = '0000-00-00'")
                ->where("p.data_partida <= now()");
                
        return $this->fetchAll($select);
        
    }
    
}
