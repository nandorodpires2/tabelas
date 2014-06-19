<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CampenatoTemporada
 *
 * @author Fernando Rodrigues
 */
class Model_CampenatoTemporada extends Zend_Db_Table_Abstract {

    protected $_name = "campeonato_temporada";
    
    protected $_primary = "id_campeonato_temporada";
        
    /**
     * busca os campeonatos da temporada de acordo com a reputacao
     */
    public function getCampeonatosTemporadaReputacao($id_reputacao) {
        
        $limit = (int)Zend_Registry::get('config')->list->campeonato->limit;
                
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('ct' => $this->_name), array('*'))
                ->joinInner(array('c' => 'campeonato'), 'ct.id_campeonato = c.id_campeonato', array('*'))                
                ->where("c.id_reputacao = ?", $id_reputacao)
                ->order("ct.finalizado asc")
                ->order("ct.ano_temporada desc")
                ->order("c.descricao_campeonato asc")
                ->limit($limit);
        
        return $this->fetchAll($select);
        
    }
    
    public function getTemporadasByCampeonatoId($id_campeonato) {
        
        $select = $this->select()
                ->from($this->_name, array(
                    'id_campeonato_temporada',
                    'ano_temporada'
                ))
                ->where("id_campeonato = ?", $id_campeonato);
        
        return $this->fetchAll($select);
        
    }
    
    
}
