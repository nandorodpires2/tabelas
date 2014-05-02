<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VwTabelaJogadores
 *
 * @author Fernando Rodrigues
 */
class Model_VwTabelaJogadores extends Zend_Db_Table_Abstract {
    
    protected $_name = "vw_tabela_jogadores";
    protected $_primary = "jogador";
    
}
