<?php
/*
* @package wordpress_tasks
*
/*
Plugin Name: wordpress_tasks plugin
Plugin URI: http://wordpress_tasks.com/plugin
Description: This is my first plugin
Version:1.0.0
Author: Maryam "Maryam" khan
Author URI:http://wordpress_tasksplugin2022.com
Liscense:GPLv2 or later
Text Domain:wordpress_tasks-plugin
*/


if (! defined('ABSPATH')) {
	die;
}

if(! class_exists('Recipe_post_type')){
	
}

/**
* define plugin directory 
*/
if ( ! defined( 'wordpress_tasks_PLUGIN_DIR' ) ) {
	define( 'wordpress_tasks_PLUGIN_DIR', __DIR__ );
}

/**
*define for plugin directory file
*/

if ( ! defined( 'wordpress_tasks_PLUGIN_DIR_URL' ) ) {
	define( 'wordpress_tasks_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
}

/**
* defining for file directory file
*/

if ( ! defined( 'wordpress_tasks_ABSPATH' ) ) {
	define( 'wordpress_tasks_ABSPATH', dirname( __FILE__ ) );

/**
* including loader file here 
*/

include_once wordpress_tasks_ABSPATH . '/includes/class-Recipe-loader.php';
}