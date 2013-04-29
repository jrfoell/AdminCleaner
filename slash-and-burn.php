<?php
/*
Plugin Name: Gaia Freshmuse Slash and Burn
Plugin URI: http://freshmuse.com
Description: 
Author: Dan Beil and Grant Landram
Version: Super beta 0.1
Author URI: http://gaiarendering.com
Change Log:
*/
?>
<?php
function gaia_sab_css() {
		wp_enqueue_script('sab_js', plugins_url('/js/sab_js.js', __FILE__), 'jquery', '', '');
		wp_register_style( 'gaia_sab_styles', plugins_url('/css/slash-and-burn.css', __FILE__), array(), '1' );
		wp_enqueue_style('gaia_sab_styles');
	};
add_action('admin_enqueue_scripts', 'gaia_sab_css');

add_action('admin_menu', 'gaia_sab_submenu_page');

function gaia_sab_submenu_page() {
	add_submenu_page( 'options-general.php', 'Slash and Burn Options', 'Slash and Burn Options', 'manage_options', 'gaia-sab-submenu-page', 'gaia_sab_submenu_page_callback' ); 
}
//http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
function gaia_sab_init(){
	register_setting( 'gaia_sab_options', 'gaia_sab_options' );
}
add_action( 'admin_init', 'gaia_sab_init' );

function gaia_sab_submenu_page_callback() {
	require_once dirname (__FILE__) . '/inc/submenu-callback.php' ;
};
//end setting page
?>
<?php
add_action('plugins_loaded', 'gaia_fire');
function gaia_fire() {
  if(current_user_can('administrator'))
  add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 99);
  add_action('admin_menu', 'remove_menu_pages', 99);
  add_action('widgets_init', 'remove_core_widgets', 99);
  add_action('admin_init', 'remove_meta_boxes', 99);
}
?>
<?php
// start our functions
function remove_dashboard_widgets() {
	require_once dirname (__FILE__) . '/inc/remove-dashboard-widgets.php' ;
};

// start our functions
function remove_menu_pages() {
  require_once dirname (__FILE__) . '/inc/remove-menu-pages.php' ;
};

//start our function
function remove_core_widgets() {
	require_once dirname (__FILE__) . '/inc/remove-core-widgets.php' ;
};


function remove_meta_boxes() {
  require_once dirname (__FILE__) . '/inc/remove-meta-boxes.php' ;
};


function theme_custom_login() {
	$gaia_sab_options = get_option('gaia_sab_options');
	echo '<style type="text/css">';
	if (!empty($gaia_sab_options["login_color"])) {
	echo 'body.login {
		background-color:' . $gaia_sab_options["login_color"] .';
	}';
	};
	if (!empty($gaia_sab_options["login_image"])) {
	echo 'body.login {
		background-image:url("' . $gaia_sab_options["login_image"] .'");
	}';
	};
	if (!empty($gaia_sab_options["login_image_position"])){
	echo 'body.login {
		background-position:' . $gaia_sab_options["login_image_position"] .';
	}';
	};
	if (!empty($gaia_sab_options["login_image_repeat"])) {
	echo 'body.login {
		background-repeat:' . $gaia_sab_options["login_image_repeat"] .';
	}';
	};
	if (!empty($gaia_sab_options["login_logo"])) {
	echo '.login h1 a {
		background-image:url("' . $gaia_sab_options["login_logo"] .'");
	}';
	};
		echo '</style>';
		};
add_action('login_head', 'theme_custom_login');
function sab_url_login() {
	return '/';
};
add_action('login_headerurl', 'sab_url_login');

function admin_styles2() {
	$gaia_sab_options = get_option('gaia_sab_options');
	$gaia_sab_logo = $gaia_sab_options["admin_logo"];
	if (!empty($gaia_sab_logo)) {
	echo '<style type="text/css">
	#wp-admin-bar-wp-logo .ab-icon {
		background-image:url("'.$gaia_sab_options["admin_logo"].'") !important;
	}
		</style>';
		};
};
add_action('admin_head', 'admin_styles2'); //Thanks John Hawkins!

function modify_footer_admin() {
	$gaia_sab_options = get_option('gaia_sab_options');
	echo $gaia_sab_options['admin_footer'];
};
add_action('admin_footer_text', 'modify_footer_admin');
?>