<?php
/*
 * Seese Theme's Functions
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/**
 * Define - Folder Paths
 */
define( 'SEESE_THEMEROOT_PATH', get_template_directory() );
define( 'SEESE_THEMEROOT_URI', get_template_directory_uri() );
define( 'SEESE_CSS', SEESE_THEMEROOT_URI . '/assets/css' );
define( 'SEESE_IMAGES', SEESE_THEMEROOT_URI . '/assets/images' );
define( 'SEESE_SCRIPTS', SEESE_THEMEROOT_URI . '/assets/js' );
define( 'SEESE_FRAMEWORK', get_template_directory() . '/inc' );
define( 'SEESE_LAYOUT', get_template_directory() . '/layouts' );
define( 'SEESE_CS_IMAGES', SEESE_THEMEROOT_URI . '/inc/theme-options/theme-extend/images' );
define( 'SEESE_CS_FRAMEWORK', get_template_directory() . '/inc/theme-options/theme-extend' ); // Called in Icons field *.json
define( 'SEESE_ADMIN_PATH', get_template_directory() . '/inc/theme-options/cs-framework' ); // Called in Icons field *.json
define( 'SEESE_PLUGIN_ASTS', plugins_url() . '/seese-core/assets' );

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$seese_theme_child = wp_get_theme();
	$seese_get_parent = $seese_theme_child->Template;
	$seese_theme = wp_get_theme($seese_get_parent);
} else { // Parent Theme Active
	$seese_theme = wp_get_theme();
}

define('SEESE_NAME', $seese_theme->get( 'Name' ), true);
define('SEESE_VERSION', $seese_theme->get( 'Version' ), true);
define('SEESE_BRAND_URL', $seese_theme->get( 'AuthorURI' ), true);
define('SEESE_BRAND_NAME', $seese_theme->get( 'Author' ), true);

/**
 * All Main Files Include
 */
require_once( SEESE_FRAMEWORK . '/init.php' );
