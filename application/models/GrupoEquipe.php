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
