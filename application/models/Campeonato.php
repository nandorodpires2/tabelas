<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Campeoato
 *
 * @author Fernando Rodrigues
 */
class Model_Campeonato extends Zend_Db_Table_Abstract {
    
    protected $_name = "campeonato";
    
    protected $_primary = "id_campeonato";
    
    public function getLastInsertId() {
    
        $select = $this->select()
                ->from($this->_name, array(
                    "last_id" => "last_insert_id(id_campeonato)"
                ))
                ->order("id_campeonato desc")
                ->limit(1);
        
        $query = $this->fetchRow($select);
        
        return (int)$query->last_id;
        
    }

    /**
     * retorna o nome do campeonato
     */
    public function getNomeCampeonato($id_temporada) {        
        
        $select = $this->select()
                ->from(array('c' => 'campeonato'), array('c.descricao_campeonato'))
                ->setIntegrityCheck(false)
                ->joinInner(array('ct' => 'campeonato_temporada'), 'c.id_campeonato = ct.id_campeonato', array('ct.ano_temporada'))
                ->where("ct.id_campeonato_temporada = ?", $id_temporada);
        
        $query = $this->fetchRow($select);
        return $query->descricao_campeonato . ' ' . $query->ano_temporada;
        
    }
    
    /**
     * retorna os campeonatos
     */
    public function getCampeonatos($where = null) {
        
        $select = $this->select()
                ->from(array('c' => $this->_name), '*')
                ->setIntegrityCheck(false)                
                ->joinInner(array('rep' => 'reputacao'), 'c.id_reputacao = rep.id_reputacao', array('*'))
                ->order('rep.ordem asc')
                ->order('c.nome_campeonato asc');
        
        if ($where) {
            $select->where($where);
        }
        
        return $this->fetchAll($select);
        
    }
    
    public function getCampeonatosNaoFinalizados() {
        
        $select = $this->select()
                ->from(array('c' => $this->_name), '*')
                ->setIntegrityCheck(false)                
                ->joinInner(array('rep' => 'reputacao'), 'c.id_reputacao = rep.id_reputacao', array('*'))
                ->joinInner(array('ct' => 'campeonato_temporada'), 'c.id_campeonato = ct.id_campeonato', array('*'))
                ->where("ct.finalizado = ?", 0)
                ->order('c.descricao_campeonato asc');
                
        return $this->fetchAll($select);
        
    }
    
    public function getCampeonatosFinalizados() {
        
        $select = $this->select()
                ->from(array('c' => $this->_name), '*')
                ->setIntegrityCheck(false)                                
                ->joinInner(array('ct' => 'campeonato_temporada'), 'c.id_campeonato = ct.id_campeonato', array())
                ->joinLeft(array('cp' => 'campeao'), 'ct.id_campeonato = cp.id_campeonato', array())
                ->where("ct.finalizado = ?", 1)
                ->where("c.id_reputacao <> ?", 5)
                ->where("cp.id_equipe is null")
                ->order('c.nome_campeonato asc');
        
        //echo $select->__toString();
        return $this->fetchAll($select);
        
    }
    
}
