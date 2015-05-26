<?php
/**
 * Plugin Name: mTheme Plugin
 * Plugin URI: #
 * Description: Plugin accompany the themes of mTheme.
 * Version: 1.0
 * Author: mTheme
 * Author URI: http://themeforest.net/user/mtheme_market
 * License: license purchased
 */
function mTheme_activate() {
	flush_rewrite_rules ();
}

register_activation_hook ( __FILE__, 'mTheme_activate' );
function mTheme_deactivate() {
	flush_rewrite_rules ();
}
register_deactivation_hook ( __FILE__, 'mTheme_deactivate' );

require plugin_dir_path( __FILE__ ) . 'custom-post-type.php';
require plugin_dir_path( __FILE__ ) . 'shortcode.php';