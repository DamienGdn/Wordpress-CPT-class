<?php

/*
Plugin Name: Core Plugin Wordpress
Plugin URI: nothing
Description: Class and method for create a tools set for wordpress
Version: 1.0
Author: Orange Partner
License: GPL2
*/

namespace PluginCore;
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
require plugin_dir_path(__FILE__)."/class/Autoloader.php";


Autoloader::register();

Autoloader::ajax();
