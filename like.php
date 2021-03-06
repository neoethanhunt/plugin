<?php
/*
Plugin Name: courselike

*/


if(!defined('LI_BASE_DIR')) {
	define('LI_BASE_DIR', dirname(__FILE__));
}
if(!defined('LI_BASE_URL')) {
	define('LI_BASE_URL', plugin_dir_url(__FILE__));
}


/***************************
* language files
***************************/
function li_load_text_domain() {
	load_plugin_textdomain( 'like_it', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'li_load_text_domain' );

/***************************
* includes
***************************/
include(LI_BASE_DIR . '/includes/display-functions.php');
include(LI_BASE_DIR . '/includes/like.php');
include(LI_BASE_DIR . '/includes/scripts.php');
include(LI_BASE_DIR . '/includes/widgets.php');
