<?php

class Admin_IndexController extends Zend_Controller_Action {

    public function init() {
        
        $modelRodadaGrupo = new Model_RodadaGrupo();
        
        // finalzar rodadas pendentes
        $modelVwRodadaFinalizar = new Model_VwRodadaFinalizar();
        $rodadas = $modelVwRodadaFinalizar->fetchAll();
        
        foreach ($rodadas as $rodada) {
            if ($rodada->jogos_grupo == $rodada->jogos_realizados) {
                
                $update['finalizado'] = 1;
                $where = "id_rodada_grupo = " . $rodada->id_rodada_grupo;
                
                $modelRodadaGrupo->update($update, $where);
                
            }
        }
        
    }

    public function indexAction() {
        
    }

}

