<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
    
    const LAYOUT_DEFAULT = "index";

    protected function _initRegistry() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        Zend_Registry::set('config', $config);
    }
    
    /**
     * Cria uma instancia do Autoloader
     */
    protected function _initAutoloader() {
     
        $autoloader = new Zend_Application_Module_Autoloader(array(
           'namespace'  => '',
           'basePath'   => APPLICATION_PATH
        ));
        
        $autoloader->addResourceTypes(array(
            'actionhelper' => array(
                'path' => 'helpers/actions',
                'namespace' => 'Controller_Helper'
            ),
            'viewhelper' => array(
                'path' => 'helpers/views',
                'namespace' => 'View_Helper'
            )
        ));
        
    }
    
    /**
     * _initController
     * 
     * Configura o controller
     */
    protected function _initController() {
    	$controller = Zend_Controller_Front::getInstance();
        $controller->registerPlugin(new Plugin_MenuLeftBar());        
        //$controller->registerPlugin(new Plugin_Admin());
    }
       
    public function _initCache() { 

        mb_internal_encoding("UTF-8");

        $frontend = array('lifetime' => 7200, 'automatic_serialization' => true);
        $cachedir = realpath(APPLICATION_PATH . '/data/cache');

        $backend = array('cache_dir' => $cachedir);
        $cache = Zend_Cache::factory('Core', 'File', $frontend, $backend);

        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
        Zend_Registry::set('cache', $cache);

        // Cache dos Objetos Date. Utilize sempre. A não utilizaçao causa erros no zend cache.
        Zend_Locale::setCache($cache);

    }
    
    /**
     * Definindo a configuracao de Layout
     */
    protected function _initLayout() {
        
        $configs = array(
            'layout' => self::LAYOUT_DEFAULT,
            'layoutPath' => APPLICATION_PATH . '/layouts'
        );
        // inicia o componente
        Zend_Layout::startMvc($configs);
        
    }
    
    /**
     * Zend Locale
     */
    public function _initLocale() {
        //instancia o componente usando  pt-BR como padr�o
        $locale = new Zend_Locale('pt_BR');
        //salva o memso no Zend_Registry
        Zend_Registry::set('Zend_Locale', $locale);
    }    

    /**
     * 
     * @return \Zend_View
     */
    protected function _initView() {
        //Initialize view
        $view = new Zend_View();  
        
        $view->headLink()->appendStylesheet(PUBLIC_PATH . '/views/css/bootstrap/bootstrap.css');
        $view->headLink()->appendStylesheet(PUBLIC_PATH . '/views/css/bootstrap/bootstrap-theme.css');
        
        $view->addHelperPath('Helper/View', 'Helper_View');
        
        
        return $view;
    }
    

}

