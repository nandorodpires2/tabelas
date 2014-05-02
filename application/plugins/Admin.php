<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author Fernando Rodrigues
 */
class Plugin_Admin extends Zend_Controller_Plugin_Abstract {
    
    public function preDispatch(\Zend_Controller_Request_Abstract $request) {
        
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();
        
        $admin = false;
        
        $remoteAddr = $request->getServer('REMOTE_ADDR');
        echo $remoteAddr;
        if ($remoteAddr == '127.0.0.1') {                
            $admin = true;            
        }
        
        if ($request->getModuleName() == 'admin' && !$admin) {
            die('erro');
        }
        
        $view->admin = $admin;
    }
    
}
