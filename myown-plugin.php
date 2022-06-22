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

/**
* define plugin directory 
*/
if ( ! defined( 'myown_PLUGIN_DIR' ) ) {
	define( 'myown_PLUGIN_DIR', __DIR__ );
}

/**
*define for plugin directory file
*/

if ( ! defined( 'myown_PLUGIN_DIR_URL' ) ) {
	define( 'myown_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

/**
* defining for file directory file
*/

if ( ! defined( 'myown_ABSPATH' ) ) {
	define( 'myown_ABSPATH', dirname( __FILE__ ) );

/**
* including loader file here 
*/

include_once myown_ABSPATH . '/includes/class-Recipe-loader.php';
}