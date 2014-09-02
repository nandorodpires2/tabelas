<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VwRodadaFinalizar
 *
 * @author Fernando Rodrigues
 */
class Model_VwRodadaFinalizar extends Zend_Db_Table {
    
    protected $_name = "vw_rodadas_finalizar";

    protected $_primary = array(
        'id_grupo',
        'id_campeonato_temporada',
        'id_fase_campeonato'
    );
    
}
