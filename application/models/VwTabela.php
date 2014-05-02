<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VwTabela
 *
 * @author Fernando Rodrigues
 */
class Model_VwTabela extends Zend_Db_Table_Abstract {
    
    protected $_name = "vw_tabela";
    protected $_primary = "id_campeonato_temporada";
    
    /**
     * retorna a tabela do campeonato
     */
    public function getTabelaCampeonatoTemporada($id_campeonato, $id_campeonato_temporada) {
        
        $select = $this->select()
                ->from($this->_name, array(
                    '*',
                    'pontos' => "((vitorias * 3) + empates)",
                    'saldo_gols' => '(gols_pro - gols_contra)',
                    'aproveitamento' => 'ifnull((((vitorias * 3) + empates) * 100)/(jogos * 3), 0)'
                ))
                ->where("id_campeonato = ?", $id_campeonato)
                ->where("id_campeonato_temporada = ?", $id_campeonato_temporada)
                ->order("((vitorias * 3) + empates) desc")
                ->order("(gols_pro - gols_contra) desc")
                ->order("gols_pro desc")
                ->order("gols_contra desc")
                ->order("vitorias desc")
                ->order("nome_equipe asc");
        
        return $this->fetchAll($select);              
        
    }
    
}
