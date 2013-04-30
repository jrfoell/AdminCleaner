<?php
$gaia_sab_options = get_option('gaia_sab_options');
$gaia_sab_logo = $gaia_sab_options["admin_logo"];
if (!empty($gaia_sab_logo)) {
	echo '<style type="text/css">
	#wp-admin-bar-wp-logo .ab-icon {
		background-image:url("'.$gaia_sab_options["admin_logo"].'") !important;
	}
	</style>';
	};
?>