<?php

namespace PluginCore;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autoloader
 *
 * @author Damien Guesdon
 */
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
        add_action("save_post",array(new Banner(), "save_banner"));
    }

   
    
    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
         if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
             try{
                 if(!file_exists(plugin_dir_path(__FILE__) . $class . '.php')){
                     throw new \Exception("$class.php not exist");
                 }else{
                     require plugin_dir_path(__FILE__) . $class . '.php';
                 }

             }catch (\Exception $e){
                
             }

         }
    }

}