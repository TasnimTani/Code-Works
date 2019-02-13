<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/**
 * Enqueue Files for FrontEnd
 */
if ( ! function_exists( 'seese_scripts_styles' ) ) {
  function seese_scripts_styles() {

    // Styles
    wp_enqueue_style( 'font-awesome', SEESE_THEMEROOT_URI . '/inc/theme-options/cs-framework/assets/css/font-awesome.min.css' );
    wp_enqueue_style( 'bootstrap-css', SEESE_CSS .'/bootstrap.min.css', array(), '3.3.7', 'all' );
    wp_enqueue_style( 'seese-own-loader', SEESE_CSS .'/loaders.css', array(), '0.9.9', 'all' );
    wp_enqueue_style( 'seese-own-carousel', SEESE_CSS .'/owl.carousel.min.css', array(), '2.4', 'all' );
    wp_enqueue_style( 'seese-own-slider', SEESE_CSS .'/slick-slider.min.css', array(), '1.6', 'all' );
    wp_enqueue_style( 'seese-own-popup', SEESE_CSS .'/magnific-popup.min.css', array(), '0.9.9', 'all' );
    wp_enqueue_style( 'seese-own-scrollbar', SEESE_CSS . '/mcustom-scrollbar.min.css', array(), '3.1.5', 'all');
    wp_enqueue_style( 'seese-own-animate', SEESE_CSS . '/animate.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'seese-menu-styles', SEESE_CSS . '/menu.css', array(), SEESE_VERSION, 'all' );
    wp_enqueue_style( 'seese-styles', SEESE_CSS .'/styles.css', array(), SEESE_VERSION, 'all' );

    // Scripts
    wp_enqueue_script( 'bootstrap-js', SEESE_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
    wp_enqueue_script( 'seese-lazyload', SEESE_SCRIPTS . '/unveil-lazyload.js', array( 'jquery' ), '1.0.0', false );
    wp_enqueue_script( 'seese-plugins', SEESE_SCRIPTS . '/plugins.js', array( 'jquery' ), SEESE_VERSION, true );
    wp_enqueue_script( 'seese-scripts', SEESE_SCRIPTS . '/scripts.js', array( 'jquery' ), SEESE_VERSION, true );

    // Comments
    wp_enqueue_script( 'seese-validate-js', SEESE_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'seese-validate-js', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // WooCommerce
    if (class_exists( 'WooCommerce' )){
      // Styles
      wp_enqueue_style( 'seese-woocommerce', SEESE_THEMEROOT_URI . '/inc/plugins/woocommerce/woocommerce.css', array(), SEESE_VERSION, 'all' );
      wp_enqueue_style( 'seese-woocommerce-responsive', SEESE_THEMEROOT_URI . '/inc/plugins/woocommerce/woocommerce-responsive.css', array(), SEESE_VERSION, 'all' );

      // Scripts
      wp_enqueue_script( 'seese-woocommerce-scripts', SEESE_SCRIPTS . '/wc-scripts.js', array( 'jquery' ), '1.0', true );
    }

    // Responsive Active
    wp_enqueue_style( 'seese-responsive', SEESE_CSS .'/responsive.css', array(), SEESE_VERSION, 'all' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'seese_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'seese_admin_scripts_styles' ) ) {
  function seese_admin_scripts_styles() {

    wp_enqueue_style('admin-main', SEESE_CSS . '/admin-styles.css', __FILE__);
    wp_enqueue_script('admin-scripts', SEESE_SCRIPTS . '/admin-scripts.js', __FILE__);

  }
  add_action( 'admin_enqueue_scripts', 'seese_admin_scripts_styles' );
}

/* Enqueue All Styles */
function seese_framework_wp_enqueue_styles() {

  seese_framework_google_fonts();

  add_action( 'wp_head', 'seese_framework_custom_css', 99 );
  add_action( 'wp_head', 'seese_framework_custom_js', 99 );

  if ( is_child_theme() ){
    wp_enqueue_style( 'seese_framework_child', get_stylesheet_uri() );
  }

}
add_action( 'wp_enqueue_scripts', 'seese_framework_wp_enqueue_styles' );
