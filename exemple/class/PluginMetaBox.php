<?php

/**
 * Description of PluginMetaBox
 * 
 */

namespace PluginCore;

abstract class PluginMetaBox {
    //put your code here
    protected $meta_boxes;
    protected $template_url;
    protected $input;
    protected $render;


    public function __construct($args = array()){
        
        $this->meta_boxes = $args;
        
        $this->template_url = plugin_dir_path(__FILE__)."../views/admin";
        
        $this->render = new Render($this->template_url );

        // add action save post
        add_action("save_post", array($this, "save_post"));
        
   }

    /**
     * Load Css
     */
   protected function load_style(){
        wp_enqueue_style("input.text", plugin_dir_url(__FILE__)."../public/css/input.text.css");
    }


    /**
     * Load Script
     */
   protected function load_script(){
        //wp_enqueue_media();        
        wp_enqueue_script("input.photo", plugin_dir_url(__FILE__)."../public/js/photo.js");
   }

   public function create_meta_box(){
        
        add_action("load-post.php", array($this, "meta_box"));
        add_action("load-post-new.php", array($this, "meta_box"));        
   }


   public function meta_box(){
        $this->load_style();
        $this->load_script();
        
        add_meta_box(
            sanitize_title($this->meta_boxes["class_id"]),
            $this->meta_boxes["title"],
            array($this, "generate_meta_box"),
            $this->meta_boxes["post_type"],
            $this->meta_boxes["priority"],
            $this->meta_boxes["core"]
        );
    }

    /**
     * generate Input type
     */
    public function generate_meta_box(){
        global $post_id;
        
        $bootstrap = new Bootstrap();
        $bootstrap->load_bootstrap_css();
        
        foreach ($this->meta_boxes["input"] as $input){
            
            switch($input["type"]){
                case "text":
                    $this->render->view("input.text", $input, plugin_dir_path(__FILE__)."../views/admin");
                    break;
                case "editor" :
                    $this->render->view("input.editor", $input, plugin_dir_path(__FILE__)."../views/admin");
                    break;
                case "textarea" :
                    $this->render->view("input.textarea", $input, plugin_dir_path(__FILE__)."../views/admin");
                    break;
                case "email" :
                    $this->render->view("input.email", $input, plugin_dir_path(__FILE__)."../views/admin");
                    break;
                case "img" :
                    wp_enqueue_media();
                    $this->render->view("img", $input, plugin_dir_path(__FILE__)."../views/admin");
                    break;
                default:
                    $this->render->view($input["type"] ,$input, plugin_dir_path(__FILE__)."../views/admin");
                    break;
            }
            
            
        }
        
    }

    /**
     * Save input
     */
    public function save_post(){
        global $post_id;

        if(isset($_POST["post_type"]) && $_POST["post_type"] == $this->meta_boxes["post_type"]){
            
            foreach ($this->meta_boxes["input"] as $input){

                if($input["type"] == "text" || $input["type"] == "editor" || $input["type"] == "img" || $input["type"] == "textarea" || $input["type"] == "email"){

                    if(isset($_POST[$input["name"]]) === true){
                        update_post_meta($post_id,$input["name"],$_POST[$input["name"]]);
                    }
                    
                }

            }

        }
        
        
        
    }
    
   
    
}
