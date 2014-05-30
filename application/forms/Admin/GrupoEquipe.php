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
class Form_Admin_GrupoEquipe extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'formGrupoEquipe')
                ->setMethod('post');
        
        // id_grupo
        $this->addElement('hidden', 'id_grupo');
        
        // id_fase_campeonato
        $this->addElement('hidden', 'id_fase_campeonato');
        
        // id_equipe
        $this->addElement('select', 'id_equipe', array(
            'label' => 'Equipe: ',
            'multioptions' => $this->getEquipe()
        ));
        
        // jogado
        $this->addElement('text', 'jogador', array(
            'label' => 'Jogador: '
        ));
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));
        
    }
    
    protected function getEquipe() {
        
        $options = array("" => "Selecione...");
        
        $modelEquipe = new Model_Equipe();
        $equipes = $modelEquipe->fetchAll(null, "nome_equipe asc");
        
        foreach ($equipes as $equipe) {
            $options[$equipe->id_equipe] = $equipe->nome_equipe;
        }
         
        return $options;
        
    }
    
}
