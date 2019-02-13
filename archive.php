<?php
/*
 * The template for displaying archive pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */
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

// Theme Options
$blog_page_layout = cs_get_option('blog_page_layout');
$blog_style       = cs_get_option('blog_listing_style');
$blog_columns     = cs_get_option('blog_listing_columns');
$blog_sb_position = cs_get_option('blog_sidebar_position');

// Page Layout
if ($blog_page_layout === 'less-width') {
  $parent_class = 'seese-less-width';
  $layout_class = 'container seese-reduced';
} else {
  $parent_class = 'seese-extra-width';
  $layout_class = 'container';
}

// Sidebar Position
if ($blog_sb_position === 'sidebar-hide') {
  $column_class     = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
  $sidebar_position = 'sidebar-hide';
} elseif ($blog_sb_position === 'sidebar-left') {
  $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-leftCol';
  $sidebar_position = 'sidebar-left';
} else {
  $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-rightCol';
  $sidebar_position = 'sidebar-right';
}

// Blog Style
if ($blog_style === 'style-two') {
  $blog_style_class      = 'seese-masonry-blog';
  $blog_msnry_class      = 'seese-blog-msnry';
  $blog_msnry_item_class = 'seese-blog-msnry-item';
} else {
  $blog_style_class      = 'seese-standard-blog';
  $blog_msnry_class      = '';
  $blog_msnry_item_class = '';
}

// Column Style
if($blog_columns === 'seese-blog-col-2') {
  $blog_grid_number  = 2;
  $blog_column_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
} else if($blog_columns === 'seese-blog-col-3') {
  $blog_grid_number  = 3;
  $blog_column_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
} else {
  $blog_grid_number  = 1;
  $blog_column_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
}

get_header(); ?>

<!-- ContainerWrap Start -->
<div class="seese-containerWrap <?php echo esc_attr($parent_class); ?>">
  <div class="seese-background seese-background-outer">
    <div class="<?php echo esc_attr($layout_class); ?>">
      <div class="seese-background-inner <?php echo esc_attr($content_padding); ?> seese-container-inner" style="<?php echo esc_attr($custom_padding); ?>">
        <div class="row">

          <?php
          if ($sidebar_position === 'sidebar-left') {
            get_sidebar(); // Sidebar
          } ?>

          <!-- Content Col Start -->
          <div class="<?php echo esc_attr($column_class); ?> seese-contentCol">
            <div class="row seese-content-area">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="seese-blog-wrapper <?php echo esc_attr($blog_style_class); ?>">
                  <div class="seese-blogs <?php echo esc_attr($blog_msnry_class); ?>">

                    <?php
                    if ( have_posts() ) :
                      $count_all_post = $GLOBALS['wp_query']->post_count;
                      $count = 0;

                   	  while ( have_posts() ) : the_post();
                        $count++;

                        if ($blog_style === 'style-two') {
                          if( $count === 1 ) {
                            echo '<div class="seese-blog-msnry-gutter"></div>';
                            echo '<div class="'.esc_attr($blog_column_class).' seese-blog-msnry-sizer"></div>';
                          }
                        } else {
                          if ( $blog_grid_number === 1) {
                            echo '<div class="row">';
                          } else {
                            if( $count === 1 ) {
                              echo '<div class="row">';
                            } else if(( $count % $blog_grid_number ) === 1 ) {
                              echo '<div class="row">';
                            }
                          }
                        }

                        echo '<div class="'.esc_attr($blog_column_class.' '.$blog_msnry_item_class).'">';
                          get_template_part( 'layouts/post/content' );
                        echo '</div>';

                        if ($blog_style !== 'style-two') {        
                          if ( $blog_grid_number === 1 ) {
                            echo '</div>';
                          } else {
                            if((($count % $blog_grid_number) === 0) || ($count === ($count_all_post))) {
                              echo '</div>';
                            }
                          }
                        }

                   	  endwhile;
                    else :
                   	  get_template_part( 'layouts/post/content', 'none' );
                    endif; ?>

                  </div>

                  <?php
                  seese_blog_paging_nav();
                  wp_reset_postdata();
                  ?>

                </div>
              </div>
            </div>
          </div>
          <!-- Content Col End -->

          <?php
          if ($sidebar_position === 'sidebar-right') {
            get_sidebar(); // Sidebar
          } ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- ContainerWrap End -->

<?php get_footer();
