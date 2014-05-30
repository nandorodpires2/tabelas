<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FaseCampeonato
 *
 * @author Fernando Rodrigues
 */
class Form_Admin_FaseCampeonato extends Zend_Form {
    
    public function init() {
        
        $this->setAttrib('id', 'formFaseCampeonato')
                ->setMethod('post');
        
        // descricao_fase
        $this->addElement('text', 'descricao_fase', array(
            'label' => 'Descrição Fase: '
        ));
                
        // qtde_grupos
        $this->addElement('text', 'qtde_grupos', array(
            'label' => 'Quantidade de Grupos: '
        ));
        
        // classificados_prox_fase_grupo
        $this->addElement('text', 'classificados_prox_fase_grupo', array(
            'label' => 'Classificam p/ prox. fase: '
        ));
        
        // qtde_equipes_grupo
        $this->addElement('text', 'qtde_equipes_grupo', array(
            'label' => 'Equipes por grupo: '
        ));
        
        // tipo_fase
        $this->addElement('select', 'tipo_fase', array(
            'label' => 'Tipo Fase: ',
            'multioptions' => array(
                1 => 'Grupos',
                2 => 'Mata-mata'
            )
        ));
        
        // id_campeonato_temporada
        $this->addElement('hidden', 'id_campeonato_temporada');
        
        // id_campeonato
        $this->addElement('hidden', 'id_campeonato');
        
        // submit
        $this->addElement('submit', 'submit', array(
            'label' => 'Cadastrar'
        ));
        
    }
    
}
