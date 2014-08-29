<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipe
 *
 * @author Fernando Rodrigues
 */
class Model_Equipe extends Zend_Db_Table_Abstract {
    
    protected $_name = "equipe";
    
    protected $_primary = "id_equipe";
    
    public function getEquipesByGrupoId($id_grupo) {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from(array('e' => $this->_name), array('*'))
                ->joinInner(array('ge' => 'grupo_equipe'), 'e.id_equipe = ge.id_equipe', array('*'))
                ->where('id_grupo = ?', $id_grupo)
                ->order('e.nome_equipe asc');
        
        return $this->fetchAll($select);
    }
    
    /**
     * busca as iniciais das letras das equipes
     */
    public function getLetrasEquipe() {

        $select = $this->select()
                ->from($this->_name, array(
                    'letras' => 'substring(nome_equipe, 1, 1)',
                    'equipes' => 'count(id_equipe)'
                ))
                ->where("substring(nome_equipe, 1, 1) not in ('1','2')")
                ->group("substring(nome_equipe, 1, 1)")
                ->order("substring(nome_equipe, 1, 1) asc");        
        
        return $this->fetchAll($select);
        
    }

    /**
     * busca as equipes
     */
    public function getEquipes($letra = null) {
        
        $select = $this->select()
                ->from(array('e' => $this->_name), array('*'))
                ->setIntegrityCheck(false)
                ->joinLeft(array('p' => 'pais'), 'e.id_pais = p.id_pais', array('*'))
                ->joinLeft(array('est' => 'estado'), 'e.id_estado = est.id_estado', array('*'))
                ->joinLeft(array('cid' => 'cidade'), 'e.id_cidade = cid.id_cidade', array('*'))
                ->joinLeft(array('esd' => 'estadio'), 'e.id_estadio = esd.id_estadio', array('*'))
                ->order('e.nome_equipe asc');
        
        if ($letra) {
            $select->where("substring(nome_equipe, 1, 1) = ?", $letra);
        }
        
        return $this->fetchAll($select);
        
    }
    
}
