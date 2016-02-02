<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace PluginCore;

class Render{
    
    protected $template;

    public function __construct(){
       
    }
    
    public function view($template, $data = array(), $url = ""){
        
        
        global $variable;
        
        $variable = $data;
        
        if($url == ""){
            $url = $this->template;
        }
        
        ob_start();        
        $template = $url."/".$template.".tpl.php";
        require $template;
        $content = ob_get_clean();
        
        echo $content;
        
    }
}