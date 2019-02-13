<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

// Metabox
global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
$seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) { $seese_id = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id; }
$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

if ($seese_meta) {
  $content_padding = $seese_meta['content_spacings'];
} else {
  $content_padding = '';
}

if ($content_padding && $content_padding !== 'seese-padding-none') {
  $content_top_spacings = $seese_meta['content_top_spacings'];
  $content_bottom_spacings = $seese_meta['content_bottom_spacings'];
  if ($content_padding === 'seese-padding-custom') {
	  $content_top_spacings = $content_top_spacings ? 'padding-top:'. seese_check_px($content_top_spacings) .' !important;' : '';
	  $content_bottom_spacings = $content_bottom_spacings ? 'padding-bottom:'. seese_check_px($content_bottom_spacings) .' !important;' : '';
	  $custom_padding = $content_top_spacings . $content_bottom_spacings;
  } else {
	  $custom_padding = '';
  }
} else {
  $custom_padding = '';
}

if ($seese_meta) {
  $title_bar = $seese_meta['title_bar'];
  if ($title_bar === 'hide') {
  	$title_bar_show = false;
  } elseif ($title_bar === 'custom') {
  	$title_bar_show = true;
  } else {
    $title_bar_show = cs_get_option('title_bar');
  }
} else {
  $title_bar_show = cs_get_option('title_bar');
}

// Page Layout Options
$page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );

if ($page_layout_options) {
  $page_layout           = $page_layout_options['page_layout'];
  $page_show_sidebar     = $page_layout_options['page_show_sidebar'];
  $page_sidebar_position = $page_layout_options['page_sidebar_position'];
  $page_sidebar_space    = $page_layout_options['page_sidebar_space'];
  $page_sidebar_widget   = $page_layout_options['page_sidebar_widget'];

  if ($page_layout === 'less-width') {
    $parent_class = 'seese-less-width';
    $layout_class = 'container seese-reduced';
  } else {
    $parent_class = 'seese-extra-width';
    $layout_class = 'container';
  }

  if ($page_show_sidebar){

    if ($page_sidebar_position === 'sidebar-left') {
      $column_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar';
      if (stripos($page_sidebar_widget, "shop") !== false) {
        $column_class .= ' seese-shop-has-sidebar';
      }
      $column_class .= ' seese-has-leftCol';
      $sidebar_position = $page_sidebar_position;
    } else {
      $column_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar';
      if (stripos($page_sidebar_widget, "shop") !== false) {
        $column_class .= ' seese-shop-has-sidebar';
      }
      $column_class .= ' seese-has-rightCol';
      $sidebar_position = $page_sidebar_position;
    }

    if ($page_sidebar_space === 'space-one') {
      $column_class .= ' seese-sidebar-space-one';
    } else if($page_sidebar_space === 'space-two') {
      $column_class .= ' seese-sidebar-space-two';
    } else {
      $column_class .= '';
    }

    if (!$title_bar_show) {
      $layout_class .= ' seese-top-space';
    }

  } else {
    $column_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
    $sidebar_position = 'sidebar-hide';
  }

} else {
  $page_show_sidebar = false;
  $sidebar_position  = 'sidebar-hide';

  $parent_class = 'seese-extra-width';
  $layout_class = 'container';
  $column_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
}

// echo json_encode( get_option('_cs_options') ); // BrixeyWP - JSON File, json, Json.
get_header(); ?>

<div class="seese-containerWrap <?php echo esc_attr($parent_class); ?>">
  <div class="seese-background seese-background-outer">
    <div class="<?php echo esc_attr($layout_class); ?>">
      <div class="seese-background-inner <?php echo esc_attr($content_padding); ?> seese-container-inner" style="<?php echo esc_attr($custom_padding); ?>">
        <div class="row">

          <?php
          // Left Sidebar
          if( ($page_show_sidebar == true) && ($sidebar_position === 'sidebar-left') ) {
            get_sidebar();
          }
          ?>

          <!-- Content Col Start -->
          <div class="<?php echo esc_attr($column_class); ?> seese-contentCol">
            <div class="row seese-content-area">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                  while ( have_posts() ) : the_post();
                    the_content();
                    // If comments are open or we have at least one comment, load up the comment template.
                    $theme_page_comments = cs_get_option('theme_page_comments');
                    if ( isset($theme_page_comments) && (comments_open() || get_comments_number()) ) :
                      comments_template();
                    endif;
                  endwhile;
                ?>
              </div>
            </div>
          </div>
          <!-- Content Col End -->

          <?php
          // Right Sidebar
          if( ($page_show_sidebar == true) && ($sidebar_position === 'sidebar-right') ) {
       	    get_sidebar();
          }
    	    ?>

        </div>
      </div>
	</div>
  </div>
</div>

<?php get_footer();
