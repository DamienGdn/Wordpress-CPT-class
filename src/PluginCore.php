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

Autoloader::ajax();
