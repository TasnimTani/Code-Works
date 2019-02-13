<?php
/*
 * The template for displaying all single posts.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */
global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
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

// Single Theme Translation Text
$prev_post_text  = cs_get_option('previous_post') ? cs_get_option('previous_post') : esc_html__( 'Older Post', 'seese' );
$next_post_text  = cs_get_option('next_post') ? cs_get_option('next_post') : esc_html__( 'Newer Post', 'seese' );

// Single Post Layout Option
$page_layout_options = get_post_meta( get_the_ID(), 'post_page_layout_options', true );

// Single Post Theme Option
$single_comment_form     = cs_get_option('single_comment_form');
$single_page_layout      = cs_get_option('single_page_layout');
$single_sidebar_position = cs_get_option('single_sidebar_position');

if ($page_layout_options) {

  $post_page_layout      = $page_layout_options['post_page_layout'];
  $post_show_sidebar     = $page_layout_options['post_page_show_sidebar'];
  $post_sidebar_position = $page_layout_options['post_page_sidebar_position'];

  if ($post_page_layout === 'less-width') {
    $parent_class = 'seese-less-width';
    $layout_class = 'container seese-reduced';
  } else if ($post_page_layout === 'extra-width') {
    $parent_class = 'seese-extra-width';
    $layout_class = 'container';
  } else {
     if ($single_page_layout === 'less-width') {
       $parent_class = 'seese-less-width';
       $layout_class = 'container seese-reduced';
     } else {
       $parent_class = 'seese-extra-width';
       $layout_class = 'container';
     }
  }

  if ( ($post_page_layout === 'less-width') || ($post_page_layout === 'extra-width') ) {

    if($post_show_sidebar){
      if ($post_sidebar_position === 'sidebar-left') {
        $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-leftCol';
        $sidebar_position = $post_sidebar_position;
      } else {
        $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-rightCol';
        $sidebar_position = $post_sidebar_position;
      }
    } else {
      $column_class     = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
      $sidebar_position = 'sidebar-hide';
    }

  } else {

    if ($single_sidebar_position === 'sidebar-left') {
      $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-leftCol';
      $sidebar_position = 'sidebar-left';
    } elseif ($single_sidebar_position === 'sidebar-hide') {
      $column_class     = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
      $sidebar_position = 'sidebar-hide';
    } else {
      $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-rightCol';
      $sidebar_position = 'sidebar-right';
    }

  }

} else {

  if ($single_page_layout === 'less-width') {
    $parent_class = 'seese-less-width';
    $layout_class = 'container seese-reduced';
  } else {
    $parent_class = 'seese-extra-width';
    $layout_class = 'container';
  }

  if ($single_sidebar_position === 'sidebar-left') {
    $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-leftCol';
    $sidebar_position = 'sidebar-left';
  } elseif ($single_sidebar_position === 'sidebar-hide') {
    $column_class     = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
    $sidebar_position = 'sidebar-hide';
  } else {
    $column_class     = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-has-rightCol';
    $sidebar_position = 'sidebar-right';
  }

}

get_header(); ?>

<!-- Content Wrapper Start -->
<div class="seese-containerWrap <?php echo esc_attr($parent_class); ?>">
  <div class="seese-background seese-background-outer">
    <div class="<?php echo esc_attr($layout_class); ?>">
      <div class="seese-background-inner <?php echo esc_attr($content_padding); ?> seese-container-inner" style="<?php echo esc_attr($custom_padding); ?>">
        <div class="row">

          <?php
          if ($sidebar_position === 'sidebar-left') {
            get_sidebar(); // Sidebar
          }
          ?>

          <!-- Content Column Start -->
          <div class="<?php echo esc_attr($column_class); ?> seese-contentCol">
            <div class="row seese-content-area">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php
	              if ( have_posts() ) :
                  while ( have_posts() ) : the_post();

                    get_template_part( 'layouts/post/content', 'single' ); ?>
                    <div class="seese-pagination">
                      <div class="row">
                        <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 newer">
                          <?php next_post_link( '%link', '<span class="seese-label">'.esc_attr($next_post_text).'</span><span class="post-name">%title</span>' ); ?>
                        </div>
                        <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 older">
                          <?php previous_post_link( '%link', '<span class="seese-label">'.esc_attr($prev_post_text).'</span><span class="post-name">%title</span>' ); ?>
                        </div>
                      </div>
                    </div>

                    <?php
                    $single_comment_form = ($single_comment_form) ? comments_template() : '';
                    
                  endwhile;
                else :
                  get_template_part( 'layouts/post/content', 'none' );
                endif;
                wp_reset_postdata();  // avoid errors further down the page ?>

              </div>
            </div>
          </div>
          <!-- Content Column End -->

          <?php
          if ($sidebar_position === 'sidebar-right') {
	          get_sidebar(); // Sidebar
	        }
          ?>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Wrapper End -->

<?php get_footer();
