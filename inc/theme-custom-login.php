<?php
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
	if (!empty($gaia_sab_options["login_logo_w"])) {
	echo '.login h1 a {
		width:'. $gaia_sab_options['login_logo_w'] .';
	}';
	};
	if (!empty($gaia_sab_options["login_logo_h"])) {
	echo '.login h1 a {
		height:'. $gaia_sab_options['login_logo_h'] .';
	}';
	};
	echo '</style>';
?>