<?php
/*
* @package myown
*
/*
Plugin Name: myown plugin
Plugin URI: http://myown.com/plugin
Description: This is my first plugin
Version:1.0.0
Author: Maryam "Maryam" khan
Author URI:http://myownplugin2022.com
Liscense:GPLv2 or later
Text Domain:myown-plugin
*/


if (! defined('ABSPATH')) {
	die;
}

if(! class_exists('Recipe_post_type')){
	
}

//include( plugin_dir_path( __FILE__ ) . 'include/Recipe_custom_post_type.php' );
if ( ! defined( 'myown_PLUGIN_DIR' ) ) {
	define( 'myown_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'myown_PLUGIN_DIR_URL' ) ) {
	define( 'myown_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'myown_ABSPATH' ) ) {
	define( 'myown_ABSPATH', dirname( __FILE__ ) );

//including loader file

include_once myown_ABSPATH . '/includes/class-Recipe-loader.php';
}