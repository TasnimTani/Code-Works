<?php
/*
 * All Seese Theme Related Functions Files are Linked here
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/* Theme All Basic Setup */
require_once( SEESE_FRAMEWORK . '/theme-support.php' );
require_once( SEESE_FRAMEWORK . '/backend-functions.php' );
require_once( SEESE_FRAMEWORK . '/frontend-functions.php' );
require_once( SEESE_FRAMEWORK . '/enqueue-files.php' );
require_once( SEESE_CS_FRAMEWORK . '/custom-style.php' );
require_once( SEESE_CS_FRAMEWORK . '/config.php' );

/* WooCommerce Integration */
if (class_exists( 'WooCommerce' )){
  require_once( SEESE_FRAMEWORK . '/plugins/woocommerce/woo-config.php' );
}

/* Bootstrap Menu Walker */;
require_once( SEESE_FRAMEWORK . '/core/mega-menu/mega-menu-api.php' );

/* Install Plugins */
require_once( SEESE_FRAMEWORK . '/plugins/notify/activation.php' );

/* Breadcrumbs */
require_once( SEESE_FRAMEWORK . '/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( SEESE_FRAMEWORK . '/plugins/aq_resizer.php' );

/* Sidebars */
require_once( SEESE_FRAMEWORK . '/core/sidebars.php' );
