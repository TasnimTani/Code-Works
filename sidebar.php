<?php
/*
 * The sidebar containing the main widget area.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

// Theme Option Sidebar Position
global $post;
$seese_id    = ( isset( $post ) ) ? $post->ID : false;
$seese_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) { $seese_id = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id; }
$page_layout_options = get_post_meta( $seese_id, 'page_layout_options', true );
$post_page_layout_options = get_post_meta( $seese_id, 'post_page_layout_options', true);

$blog_sidebar_position = cs_get_option('blog_sidebar_position');
$post_sidebar_position = cs_get_option('single_sidebar_position');
$blog_widget_selected  = cs_get_option('blog_widget');
$post_widget_selected  = cs_get_option('single_blog_widget');
$page_show_sidebar     = false;
$post_page_layout      = '';

if ($seese_id && is_page(get_the_ID())) {

  if ($page_layout_options) {
    $page_show_sidebar     = $page_layout_options['page_show_sidebar'];
    $page_sidebar_position = $page_layout_options['page_sidebar_position'];
    $page_sidebar_space    = $page_layout_options['page_sidebar_space'];
    $page_sidebar_widget   = $page_layout_options['page_sidebar_widget'];

    if($page_show_sidebar == true) {
      $col_layout_class = '';
      if($page_sidebar_position === 'sidebar-right') {
        if (stripos($page_sidebar_widget, "shop") !== false) {
          $col_layout_class .= 'seese-shop-sidebar seese-shop-right-sidebar';
        }
        $col_layout_class .= ' seese-rightCol';
      } else {
        if (stripos($page_sidebar_widget, "shop") !== false) {
          $col_layout_class .= 'seese-shop-sidebar seese-shop-left-sidebar';
        }
        $col_layout_class .= ' seese-leftCol';
      }

    } else {
      $col_layout_class = '';
    }
  } else {
    $col_layout_class = '';
  }

} elseif ( !is_page(get_the_ID()) && !is_single(get_the_ID()) && ($blog_sidebar_position !== 'sidebar-hide') ) {

  if ($blog_sidebar_position === 'sidebar-hide') {
    $col_layout_class = '';
  } elseif ($blog_sidebar_position === 'sidebar-left') {
    $col_layout_class = 'seese-leftCol';
  } else {
    $col_layout_class = 'seese-rightCol';
  }

} elseif ($seese_id && is_single()) {

  if ($post_page_layout_options) {
    $post_page_layout  = $post_page_layout_options['post_page_layout'];
    $post_show_sidebar = $post_page_layout_options['post_page_show_sidebar'];
    $post_sb_position  = $post_page_layout_options['post_page_sidebar_position'];
  } else {
    $post_page_layout  = '';
    $post_show_sidebar = '';
    $post_sb_position  = '';
  }

  if ( ($post_page_layout === 'less-width') || ($post_page_layout === 'extra-width') ) {
    if ( $post_show_sidebar ){
      if($post_sb_position === 'sidebar-left') {
        $col_layout_class = 'seese-leftCol';
      } else if($post_sb_position === 'sidebar-right') {
        $col_layout_class = 'seese-rightCol';
      }
    } else {
      $col_layout_class = '';
    }
  } else {
    if ($post_sidebar_position === 'sidebar-hide'){
      $col_layout_class = '';
    } elseif ($post_sidebar_position === 'sidebar-left') {
      $col_layout_class = 'seese-leftCol';
    } else {
      $col_layout_class = 'seese-rightCol';
    }
  }

} else {
  $col_layout_class = '';
}
?>

<!-- Sidebar Column Start -->
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 seese-sidebar <?php echo esc_attr($col_layout_class); ?>">
  <?php
  if ( $seese_id && is_page(get_the_ID()) && ($page_show_sidebar == true) && isset($page_layout_options['page_sidebar_widget']) ) {
    if (is_active_sidebar($page_layout_options['page_sidebar_widget'])) {
 	    dynamic_sidebar($page_layout_options['page_sidebar_widget']);
    }
  } elseif ( !is_page() && !is_single() && ($blog_sidebar_position !== 'sidebar-hide') && isset($blog_widget_selected) ) {
 	  if (is_active_sidebar($blog_widget_selected)) {
      dynamic_sidebar($blog_widget_selected);
    }
  } elseif ( $seese_id && is_single() && ($post_page_layout !== 'theme-default') && ($post_show_sidebar == true) && isset($post_page_layout_options['post_page_sidebar_widget']) ) {
 	  if (is_active_sidebar($post_page_layout_options['post_page_sidebar_widget'])) {
      dynamic_sidebar($post_page_layout_options['post_page_sidebar_widget']);
    }
  } elseif ( is_single() && ($post_page_layout === 'theme-default') && ($post_sidebar_position !== 'sidebar-hide') && isset($post_widget_selected) ) {
 	  if (is_active_sidebar($post_widget_selected)) {
      dynamic_sidebar($post_widget_selected);
    }
  } else {
 	  if (is_active_sidebar('sidebar-main')) {
      dynamic_sidebar('sidebar-main');
    }
  } ?>
</div>
<!-- Sidebar Column End -->