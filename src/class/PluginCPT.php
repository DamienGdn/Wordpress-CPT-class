<?php

namespace PluginCore;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginCPT
 *
 * @author KHFW4613
 */
class PluginCPT {
    //put your code here
    
    
    protected $data;
    protected $labels;
    protected $cpt_args;
    protected $label_cat;
    protected $rewrite_cat;
    protected $args_cat;
    protected $meta_boxes;
    protected $input;
   



    /**
     * 
     * @param type $data array contain 
     *  name of CPT, singular Name, 
     *  icon f109 default Icon
     * 
     */
    public function __construct($data = array("icon_menu" => "109", "support" => array("title", "editor", 'thumbnail'))) {

        
        $this->data = $data;
        $this->set_cpt_labels();
        $this->set_cpt_args();
        add_action("init", array($this,"create_cpt"));
        add_action("admin_head", array($this,"menu_icons_styles"));
        add_action("save_post", array($this,"save_post"));
        
        
    }
    
    /**
     * 
     * @return array of label contain data for View cpt in admin menu
     */
    protected function set_cpt_labels(){
        
        $this->labels = array(
            "name"               => $this->data["name"], 
            'singular_name'      => $this->data["name"],            
            'add_new'            => 'add '.$this->data["name"],
            'add_new_item'       => 'add new '.$this->data["name"],
            'edit_item'          => 'Modify '.$this->data["name"],
            'new_item'           => 'New '.$this->data["name"],
            'all_items'          => 'All '.$this->data["plurial"],
            'view_item'          => 'See '.$this->data["name"],
            'search_items'       => 'Search '.$this->data["name"],
            'not_found'          => 'no '.$this->data["name"].' found',
            'not_found_in_trash' => 'no '.$this->data["name"].' found in trash',
            'parent_item_colon'  => '',
            'menu_name'          => $this->data["plurial"]
        );
        
    }
    /**
     * 
     * @return array of args for CPT
     */
    protected function set_cpt_args(){
        
        
        
        $this->cpt_args = array(
            'labels'             => $this->labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'page',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => $this->data["support"],
            'rewrite'            => array( "with_front" => true, "slug" => sanitize_title($this->data["name"]))
        );
        
        
    }
    
     public function create_cpt(){
        
        register_post_type(sanitize_title($this->data["plurial"]), $this->cpt_args);
        
        if(isset($this->data["tax"])){
            
            foreach ($this->data["tax"] as $tax){
                
                $this->taxo_categorie($tax);
            }
            
        }
        
        
        flush_rewrite_rules();        
    }
    
    protected function set_label_cat($args){
        
            $this->label_cat = array(
                'name'          => __( $args["name"]),
                'menu_name'     => __( $args["name"]),
                'search_items'  => __( 'search'.$args["name"]),
                'all_items'     => __( 'All '.$args["name"]),
                'parent_item'   => __( $args["name"] ),
                'edit_item'     => __( 'Edit '.$args["name"] ),
                'view_item'     => __( 'See '.$args["name"] ),
                'update_item'   => __( 'Update '.$args["name"]),
                'add_new_item'  => __( 'Add '.$args["name"] ),
                'new_item_name' => __( 'New '.$args["name"] ),
                'not_found'     => __( 'Not found' ),
            );    
    }
    
    protected function set_rewrite_cat($args = array("hierarchical" => false, 'whith_front' => false)){
         $this->rewrite_cat = array(
            'slug'                       => $args["slug"],
            'with_front'                 => true,
            'hierarchical'               => true,
        );
    }
    
    protected function set_args_cat(){
        $this->args_cat = array(
            'labels'                     => $this->label_cat,
            'hierarchical'               => true,
            'public'                     => true,
            
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
            'rewrite'                    => $this->rewrite_cat,
            'sort'                       => true
        );    
        
    }


    public function taxo_categorie($args){
        
        $this->set_label_cat($args["label"]);
        $this->set_rewrite_cat($args["rewrite"]);
        $this->set_args_cat();


        
        register_taxonomy(
                sanitize_title($args["label"]["name"])."_".sanitize_title($this->data["plurial"]),
                array(sanitize_title($this->data["plurial"])),
                $this->args_cat
                );
        
        flush_rewrite_rules();
        
    }

    public static function taxo_generic($args){

        register_taxonomy(
            sanitize_title($args["name"]),
            $args["post_type"],
            $args["args"]
        );
    }
    
   
    /**
     * function able to change icon menu of CPT
     * Link for choose icon https://developer.wordpress.org/resource/dashicons/#admin-post
     */
    public function menu_icons_styles(){
        ?>
        <style>
            #adminmenu #menu-posts-<?=sanitize_title($this->data["plurial"])?> div.wp-menu-image:before {
            content: '<?=$this->data["icon_menu"]?>';
        
        </style>
        <?php
    }


    public function save_post(){
        global $post_id;
        
        
    }
    
    
    
}


