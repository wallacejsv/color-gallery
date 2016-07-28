<?php
/*
Plugin Name: Color Gallery
Plugin URI: https://wordpress.org/plugins/color-gallery/
Description: Create photo gallery and filter by color
Version: 1.0
Author: Luan Cuba
Author URI: http://luancuba.com.br
Text Domain: color-gallery
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	exit;
}

define( 'CG__VERSION', 0.1 );
define( 'CG__URL', plugin_dir_url( __FILE__ ) );
define( 'CG__PATH', plugin_dir_path( __FILE__ ) );

require_once CG__PATH . '/includes/loader.php';
