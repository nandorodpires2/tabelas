<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Date
 *
 * @author Fernando Rodrigues
 */
class View_Helper_Date extends Zend_View_Helper_Abstract {
    
    public static function date($date = null, $date_format = null, $locale = null) {
        
        $zendDate = $date ? new Zend_Date($date) : new Zend_Date();       
        
        if ($locale) {
            $zendDate->setLocale($locale);
        }
        
        if (!$date_format) {
            $date_format = Zend_Date::DATETIME_MEDIUM;
        }
        
        return $zendDate->get($date_format);        
        
    }
    
}
