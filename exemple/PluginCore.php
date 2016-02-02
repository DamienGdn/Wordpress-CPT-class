<?php

/*
Plugin Name: Plugin Class CPT
Description: Class and method for create a tools set for wordpress
Version: 1.0
License: GPL2
*/

namespace PluginCore;
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
require plugin_dir_path(__FILE__)."/class/Autoloader.php";


Autoloader::register();




$tag = array(
    'name'          => __( "Tags"),
    'menu_name'     => __( "Tags" ),
    'search_items'  => __( 'Tags search'),
    'all_items'     => __( 'All Tags'),
    'parent_item'   => __( 'Tags' ),
    'edit_item'     => __( 'Edit Tags' ),
    'view_item'     => __( 'See Tag' ),
    'update_item'   => __( 'Update Tag'),
    'add_new_item'  => __( 'Add Tag' ),
    'new_item_name' => __( 'New Tag' ),
    'not_found'     => __( 'Not found' ),
);
$args = array(
    'labels'                     => $tag,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    "rewrite"                    => false,
    'sort'                       => true
);

$tax = array(
    "name" => "tags",
    "post_type" => array("partners", "contacts", "post", "events"),
    "args" => $args
);

PluginCPT::taxo_generic($tax);

$tag = array(
    'name'          => __( "Country"),
    'menu_name'     => __( "Country" ),
    'search_items'  => __( 'Country search'),
    'all_items'     => __( 'All Country'),
    'parent_item'   => __( 'Country' ),
    'edit_item'     => __( 'Edit Country' ),
    'view_item'     => __( 'See Country' ),
    'update_item'   => __( 'Update Country'),
    'add_new_item'  => __( 'Add Country' ),
    'new_item_name' => __( 'New Country' ),
    'not_found'     => __( 'Not found' ),
);
$args = array(
    'labels'                     => $tag,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    "rewrite"                    => false,
    'sort'                       => true
);

$tax = array(
    "name" => "country",
    "post_type" => array("partners", "contacts", "post"),
    "args" => $args
);

PluginCPT::taxo_generic($tax);

include plugin_dir_path(__FILE__)."/class/TermMeta.php";


