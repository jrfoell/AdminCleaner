<?php
/*
Plugin Name: Gaia Freshmuse Slash and Burn
Plugin URI: http://freshmuse.com
Description: 
Author: Dan Beil and Grant Landram
Version: Super beta 0.3
Author URI: http://gaiarendering.com
Change Log:

Beta 0.1
- proof of concept

Beta 0.2
- creation of /inc and appropirate files

Beta 0.3
- added user level functionality
*/
?>
<?php
define('SABPATH',   plugin_dir_path(__FILE__));
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
	require_once SABPATH . '/inc/submenu-callback.php' ;
};
//end setting page
?>
<?php
add_action('plugins_loaded', 'gaia_fire');
function gaia_fire() {
	$gaia_sab_options = get_option('gaia_sab_options');
	$gaia_level = $gaia_sab_options['level'];
	if ($gaia_level == 'administrator') {
		include SABPATH . '/inc/is-admin.php' ;
	} elseif ($gaia_level == 'editor') {
		include SABPATH . '/inc/is-editor.php' ;
	} elseif ($gaia_level == 'author') {
		include SABPATH . '/inc/is-author.php' ;
	} elseif ($gaia_level == 'contributor') {
		include SABPATH . '/inc/is-contributor.php' ;
	};
};
	?>
	<?php
// start our functions
	function remove_dashboard_widgets() {
		require_once SABPATH . '/inc/remove-dashboard-widgets.php' ;
	};

// start our functions
	function remove_menu_pages() {
		require_once SABPATH . '/inc/remove-menu-pages.php' ;
	};

//start our function
	function remove_core_widgets() {
		require_once SABPATH . '/inc/remove-core-widgets.php' ;
	};


	function remove_meta_boxes() {
		require_once SABPATH . '/inc/remove-meta-boxes.php' ;
	};

	function theme_custom_login() {
		require_once SABPATH . '/inc/theme-custom-login.php' ;
	};
	add_action('login_head', 'theme_custom_login');

	function sab_url_login() {
		return '/';
	};
	add_action('login_headerurl', 'sab_url_login');

	function admin_styles2() {
		require_once SABPATH . '/inc/login-logo.php' ;
	};
add_action('admin_head', 'admin_styles2'); //Thanks John Hawkins!

function modify_footer_admin() {
	require_once SABPATH . '/inc/admin-footer-mod.php' ;
};
$gaia_sab_options = get_option('gaia_sab_options');
if (!empty($gaia_sab_options['admin_footer'])) {
	add_action('admin_footer_text', 'modify_footer_admin');
};
?>