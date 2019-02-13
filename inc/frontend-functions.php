<?php
/*
 * All Front-End Helper Functions
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/* Exclude Category From Blog */
function seese_excludeCat($query) {
  if ( $query->is_home ) {
    $exclude_cat_ids = cs_get_option('theme_exclude_categories');
    if($exclude_cat_ids) {
      foreach( $exclude_cat_ids as $exclude_cat_id ) {
        $exclude_from_blog[] = '-'. $exclude_cat_id;
      }
      $query->set('cat', implode(',', $exclude_from_blog));
    }
  }
  return $query;
}
add_filter('pre_get_posts', 'seese_excludeCat');


/* Tag Cloud Widget - Remove Inline Font Size */
function seese_tag_cloud($tag_string){
  return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}
add_filter('wp_generate_tag_cloud', 'seese_tag_cloud', 10, 3);


/* Password Form */
if( ! function_exists( 'seese_password_form' ) ) {
  function seese_password_form( $output ) {
    $output = str_replace( 'type="submit"', 'type="submit" class=""', $output );
    return $output;
  }
  add_filter('the_password_form' , 'seese_password_form');
}


/* Maintenance Mode */
if( ! function_exists( 'seese_maintenance_mode' ) ) {
  function seese_maintenance_mode() {
    $maintenance_mode_page = cs_get_option( 'maintenance_mode_page' );
    $enable_maintenance_mode = cs_get_option( 'enable_maintenance_mode' );
    if ( isset($enable_maintenance_mode) && ! empty( $maintenance_mode_page ) && ! is_user_logged_in() ) {
      get_template_part('layouts/post/content', 'maintenance');
      exit;
    }
  }
  add_action( 'wp', 'seese_maintenance_mode', 1 );
}


/* Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
if ( ! function_exists( 'seese_count_widgets' ) ) {
  function seese_count_widgets( $sidebar_id ) {
		global $_wp_sidebars_widgets;

		if ( empty( $_wp_sidebars_widgets ) ) :
		  $_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		  $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		  $widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
		  if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
		    $widget_classes .= ' col-lg-3 col-md-3 col-sm-3 col-xs-12';
		  elseif ( $widget_count >= 3 ) :
		    $widget_classes .= ' col-lg-4 col-md-4 col-sm-4 col-xs-12';
		  elseif ( $widget_count == 2 ) :
	        $widget_classes .= ' col-lg-6 col-md-6 col-sm-6 col-xs-12';
	      elseif ( $widget_count == 1 ) :
	        $widget_classes .= ' col-lg-12 col-md-12 col-sm-12 col-xs-12';
		  endif;
		  return $widget_classes;
		endif;
  }
}


/* Widget Layouts */
if ( ! function_exists( 'seese_footer_widgets' ) ) {
  function seese_footer_widgets() {
    $output = '';
    $footer_widget_layout = cs_get_option('footer_widget_layout');

    if( $footer_widget_layout ) {

      switch ( $footer_widget_layout ) {
        case 1: $widget = array('piece' => 1, 'class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12'); break;
        case 2: $widget = array('piece' => 2, 'class' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12'); break;
        case 3: $widget = array('piece' => 3, 'class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12'); break;
        case 4: $widget = array('piece' => 4, 'class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-12'); break;
        case 5: $widget = array('piece' => 3, 'class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-12', 'layout' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12', 'queue' => 1); break;
        case 6: $widget = array('piece' => 3, 'class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-12', 'layout' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12', 'queue' => 2); break;
        case 7: $widget = array('piece' => 3, 'class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-12', 'layout' => 'col-lg-6 col-md-6 col-sm-6 col-xs-12', 'queue' => 3); break;
        case 8: $widget = array('piece' => 4, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-12', 'layout' => 'col-lg-6 col-md-3 col-sm-3 col-xs-12', 'queue' => 1); break;
        case 9: $widget = array('piece' => 4, 'class' => 'col-lg-2 col-md-3 col-sm-3 col-xs-12', 'layout' => 'col-lg-6 col-md-3 col-sm-3 col-xs-12', 'queue' => 4); break;
        default : $widget = array('piece' => 4, 'class' => 'col-lg-3 col-md-3 col-sm-3 col-xs-12'); break;
      }

      for( $i = 1; $i < $widget["piece"]+1; $i++ ) {
        $widget_class = ( isset( $widget["queue"] ) && $widget["queue"] == $i ) ? $widget["layout"] : $widget["class"];
        $output .= '<div class="'. $widget_class .'">';
        ob_start();
        if (is_active_sidebar( 'footer-'. $i )) {
          dynamic_sidebar( 'footer-'. $i );
        }
        $output .= ob_get_clean();
        $output .= '</div>';
      }
    }
    return $output;
  }
}


/* Title Area */
if ( ! function_exists( 'seese_title_area' ) ) {
  function seese_title_area() {

    global $post, $wp_query;

    // Get post meta in all type of WP pages
    $seese_id   = ( isset( $post ) ) ? $post->ID : false;
    $seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
    if (class_exists('WooCommerce')) { $seese_id   = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id; }
    $seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

    if ($seese_meta) {
    	$title_bar    = $seese_meta['title_bar'];
      $custom_title = ($title_bar === 'custom') ? $seese_meta['page_custom_title'] : '';
      if (class_exists('WooCommerce')) {
        if (is_shop()) {
          if ($custom_title) {
            $custom_title = $custom_title;
          } elseif (is_post_type_archive()) {
            post_type_archive_title();
          } else {
            $custom_title = '';
          }
        }
      }
    } else {
      $custom_title = '';
    }

    /**
     * For strings with necessary HTML, use the following:
     * Note that I'm only including the actual allowed HTML for this specific string.
     * More info: https://codex.wordpress.org/Function_Reference/wp_kses
     */
    $allowed_html_array = array(
        'a' => array(
          'href' => array(),
        ),
        'span' => array(
          'class' => array(),
        )
    );

    if ( class_exists('WooCommerce') && ( ( is_product_category() || is_product_tag() ) ) ) {
      single_cat_title();
    } else {
      if($custom_title) {
        echo esc_attr($custom_title);
      } elseif (is_home()) {
        bloginfo('name');
      } elseif (is_search()) {
        printf(esc_html__( 'Search Results for %s', 'seese' ), '<mark class="dark">' . get_search_query() . '</mark>');
      } elseif(is_404()) {
        esc_html_e('404 Error', 'seese');
      } elseif (is_category()) {
        single_cat_title();
      } elseif (is_tag()) {
        single_tag_title(esc_html__('Posts Tagged: ', 'seese'));
      } elseif (is_archive()) {
        if ( is_day() ) {
          printf( wp_kses( __( 'Archive for <span>%s</span>', 'seese' ), $allowed_html_array ), get_the_date());
        } elseif ( is_month() ) {
          printf( wp_kses( __( 'Archive for <span>%s</span>', 'seese' ), $allowed_html_array ), get_the_date( 'F, Y' ));
        } elseif ( is_year() ) {
          printf( wp_kses( __( 'Archive for <span>%s</span>', 'seese' ), $allowed_html_array ), get_the_date( 'Y' ));
        } elseif ( is_author() ) {
          printf( wp_kses( __( 'Posts by: <span>%s</span>', 'seese' ), $allowed_html_array ), get_the_author_meta( 'display_name', $wp_query->post->post_author ));
        } elseif ( is_shop() ) {
          echo esc_attr($custom_title);
        } else {
          esc_html__( 'Archives', 'seese' );
        }
      } else {
        the_title();
      }
    }

  }
}

/* Excerpt Length Change */
if ( ! function_exists( 'seese_trim_excerpt' ) ) {
  function seese_trim_excerpt($text) {
    global $post;
    if ( '' == $text ) {
      $text = get_the_content('');
      $text = apply_filters('the_content', $text);
      $text = str_replace('\]\]\>', ']]>', $text);
      $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
      $text = strip_tags($text, '<style>,<em>,<i>,<p>');
    }
    return $text;
  }
  remove_filter('get_the_excerpt', 'wp_trim_excerpt');
  add_filter('get_the_excerpt', 'seese_trim_excerpt');
}

class Excerpt {
  // Default length (by WordPress)
  public static $length = 55;
  public static function length($new_length) {
    Excerpt::$length = $new_length;
    //add_filter('excerpt_length', Excerpt::$length);
    Excerpt::output();
  }
  // Echoes out the excerpt
  public static function output() {
    $text = get_the_excerpt();
    $words = explode(' ', $text, Excerpt::$length + 1);
    if (count($words)> Excerpt::$length) {
      array_pop($words);
      $text = implode(' ', $words);
    }
    echo $text.'[...]';
  }
}

// Custom Excerpt Length
function seese_excerpt($length) {
  Excerpt::length($length);
}

/* Excerpt More Change */
if ( ! function_exists( 'seese_new_excerpt_more' ) ) {
  function seese_new_excerpt_more( $more ) {
    return '...';
  }
  add_filter('excerpt_more', 'seese_new_excerpt_more');
}

/* WP Link Pages */
if ( ! function_exists( 'seese_wp_link_pages' ) ) {
  function seese_wp_link_pages() {
    $defaults = array(
      'before'           => '<div class="wp-link-pages">' . esc_html__( 'Pages:', 'seese' ),
      'after'            => '</div>',
      'link_before'      => '<span>',
      'link_after'       => '</span>',
      'next_or_number'   => 'number',
      'separator'        => ' ',
      'pagelink'         => '%',
      'echo'             => 1
    );
    wp_link_pages( $defaults );
  }
}

/* Get Comments Number */
if ( ! function_exists( 'seese_comment_number' ) ) {
  function seese_comment_number() {
    global $post;
    $comment_singular_text = cs_get_option('comment_singular_text') ? cs_get_option('comment_singular_text') : esc_html__( 'Comment', 'seese' );
    $comment_plural_text = cs_get_option('comment_plural_text') ? cs_get_option('comment_plural_text') : esc_html__( 'Comments', 'seese' );
    $no_comments_text = cs_get_option('no_comments_text') ? cs_get_option('no_comments_text') : esc_html__( 'No Comments', 'seese' );
    $num_comments = get_comments_number( $post->ID );

    if ( comments_open($post->ID) ) {
	  if ( $num_comments == 0 ) {
  		$comments = $no_comments_text;
	  } elseif ( $num_comments > 1 ) {
  		$comments = $num_comments .' '.$comment_plural_text;
	  } else {
  		$comments = $num_comments .' '.$comment_singular_text;
	  }
  	  $write_comments = '<a href="' . get_comments_link() .'">'. $comments .'</a>';
    } else {
  	  $write_comments =  esc_html__('Comments Off', 'seese');
    }

    return $write_comments;
  }
}

/* Share Options */
if ( ! function_exists( 'seese_wp_share_option' ) ) {
  function seese_wp_share_option() {

    global $post;
    $page_url = get_permalink($post->ID);
    $title = $post->post_title;
    $share_text = cs_get_option('share_text') ? cs_get_option('share_text') : esc_html__( 'SHARE THIS ARTICLE', 'seese' );
    $share_on_text = cs_get_option('share_on_text') ? cs_get_option('share_on_text') : esc_html__( 'Share On', 'seese' );
    ?>
    <div class="seese-share">
      <a href="javascript:void(0);"><?php echo esc_attr($share_text); ?> <span>:</span></a>
      <ul>
        <li>
          <a href="//twitter.com/home?status=<?php print(urlencode($title)); ?>+<?php print(urlencode($page_url)); ?>" class="icon-fa-twitter" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Twitter', 'seese'); ?>"><i class="fa fa-twitter"></i></a>
        </li>
        <li>
          <a href="//www.facebook.com/sharer/sharer.php?u=<?php print(urlencode($page_url)); ?>&amp;t=<?php print(urlencode($title)); ?>" class="icon-fa-facebook" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Facebook', 'seese'); ?>"><i class="fa fa-facebook"></i></a>
        </li>
        <li>
          <a href="https://plus.google.com/share?url=<?php print(urlencode($page_url)); ?>" class="icon-fa-google-plus" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Google+', 'seese'); ?>"><i class="fa fa-google-plus"></i></a>
        </li>
        <li>
          <a href="//pinterest.com/pin/create/button/?url=<?php print(urlencode($page_url)); ?>&amp;description=<?php print(urlencode($title)); ?>" class="icon-fa-pinterest" data-toggle="tooltip" data-placement="top" title="<?php echo esc_attr( $share_on_text .' '); echo esc_attr('Pinterest', 'seese'); ?>"><i class="fa fa-pinterest-p"></i></a>
        </li>
      </ul>
    </div>
<?php
  }
}

/* Author Info */
if ( ! function_exists( 'seese_author_info' ) ) {
  function seese_author_info() {

    if (get_the_author_meta('url')) {
      $author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_the_author_meta( 'url' );
      $target      = 'target="_blank"';
    } else {
      $author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $website_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
      $target      = '';
    }
    $description =  get_the_author_meta('description');

    if ( !empty($description) ) { ?>

    	<div class="seese-author">
	      <div class="seese-author-info">
	        <div class="author-avatar">
	          <a href="<?php echo esc_url($website_url); ?>" <?php echo esc_attr($target); ?>>
	            <?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?>
	          </a>
	        </div>
	        <div class="author-content">
	          <label><?php echo esc_html__( 'WRITTEN BY: ', 'seese' ); ?><a href="<?php echo esc_url($author_url); ?>" class="author-name"><?php echo esc_attr(get_the_author_meta('first_name')).' '.esc_attr(get_the_author_meta('last_name')); ?></a></label>
	          <p><?php echo esc_attr(get_the_author_meta( 'description' )); ?></p>
	        </div>
	      </div>
	      <ul class="social">
	        <?php if (get_the_author_meta( 'twitter' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'twitter' ) ); ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'facebook' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'facebook' ) ); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'instagram' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'instagram' ) ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'vimeo' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'vimeo' ) ); ?>" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'pinterest' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'pinterest' ) ); ?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'google_plus' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'google_plus' ) ); ?>" target="_blank"><i class="fa fa-google_plus" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'linkedin' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'linkedin' ) ); ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
	        <?php }
	        if (get_the_author_meta( 'youtube' )) { ?>
	          <li><a href="<?php echo esc_url(get_the_author_meta( 'youtube' ) ); ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
	        <?php } ?>
	      </ul>
    </div>

    <?php
    }
  }
}

/* Custom Comment Area Modification */
if ( ! function_exists( 'seese_comment_modification' ) ) {

  function seese_comment_modification($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }

    $comment_class = empty( $args['has_children'] ) ? '' : 'parent';
    $reply_comment_text = cs_get_option('reply_comment_text') ? cs_get_option('reply_comment_text') : esc_html__( 'Reply', 'seese' ); ?>

    <<?php echo esc_attr($tag); ?> <?php comment_class('item ' . $comment_class .' ' ); ?> id="comment-<?php comment_ID() ?>">

    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="">
    <?php endif; ?>

	    <div class="comment-theme">
	      <div class="comment-image">
	        <?php if ( $args['avatar_size'] != 0 ) {
	          echo get_avatar( $comment, 80 );
	        } ?>
	      </div>
	    </div>

	    <div class="comment-main-area">
	      <div class="comment-wrapper">

	        <div class="seese-comments-meta">
	          <h4><?php printf( '%s', get_comment_author() ); ?></h4>
	          <div class="comments-date">
	            <div class="date-wrapper">
	              <?php echo get_comment_date('F d, Y'); ?>
	            </div>
	            <div class="comments-reply">
	              <?php
	              comment_reply_link( array_merge( $args, array(
	                'reply_text' => '<span class="comment-reply-link">'. $reply_comment_text .'</span>',
	                'before' => '',
	                'class'  => '',
	                'depth' => $depth,
	                'max_depth' => $args['max_depth']
	              ) ) );
	              ?>
	            </div>
	          </div>
	        </div>

	        <?php if ( $comment->comment_approved == '0' ) : ?>
	          <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'seese' ); ?></em>
	        <?php endif; ?>

        	<div class="comment-area"><?php comment_text(); ?></div>

	      </div>
	    </div>

    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif;
  }
}

/* Get Current Page URL */
if ( ! function_exists( 'get_current_url' ) ) {
  function get_current_url() {
    return ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }
}

/* Pagination Function Blog */
if ( ! function_exists( 'seese_blog_paging_nav' ) ) {
  function seese_blog_paging_nav() {

    global $wp_query;
    $blog_pagination_style = cs_get_option('blog_pagination_style');
    $lmore_post_text = cs_get_option('lmore_post_text');
    $older_post_text = cs_get_option('older_post_text');
    $newer_post_text = cs_get_option('newer_post_text');

    if($blog_pagination_style === 'pagination_btn') {
      $lmore_post_text = $lmore_post_text ? $lmore_post_text : esc_html__( 'Load More', 'seese' ); ?>
      <div class="seese-load-more-box seese-blog-load-more-box">
        <div class="seese-load-more-link seese-blog-load-more-link">
          <?php next_posts_link( '&nbsp;', $wp_query->max_num_pages ); ?>
        </div>
        <div class="seese-load-more-controls seese-blog-load-more-controls seese-btn-mode">
          <div class="line-scale-pulse-out">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <a href="javascript:void(0);" id="seese-blog-load-more-btn" class="seese-btn"><?php echo esc_attr($lmore_post_text); ?></a>
          <a href="javascript:void(0);" id="seese-loaded" class="seese-btn"><?php echo esc_html__( 'All Loaded', 'seese' ); ?></a>
        </div>
      </div>
    <?php
    } elseif($blog_pagination_style === 'pagination_nextprv') {
      $older_post_text = $older_post_text ? $older_post_text : esc_html__( 'Older Posts', 'seese' );
      $newer_post_text = $newer_post_text ? $newer_post_text : esc_html__( 'Newer Posts', 'seese' );
    ?>
      <div class="seese-prev-next-pagination seese-blog-pagination row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 newer">
          <?php next_posts_link( '<i class="fa fa-angle-double-left" aria-hidden="true"></i> '. $older_post_text, $wp_query->max_num_pages ); ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 older">
          <?php previous_posts_link( $newer_post_text . ' <i class="fa fa-angle-double-right" aria-hidden="true"></i>', $wp_query->max_num_pages ); ?>
        </div>
      </div>
    <?php
    } else {
      if ( function_exists('wp_pagenavi')) {
        wp_pagenavi();
      } else {
        $older_post_text = $older_post_text ? $older_post_text : '<i class="fa fa-angle-double-left"></i>';
        $newer_post_text = $newer_post_text ? $newer_post_text : '<i class="fa fa-angle-double-right"></i>';
        $big = 999999999;
        echo paginate_links( array(
          'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
          'format'     => '?paged=%#%',
          'total'      => $wp_query->max_num_pages,
          'show_all'   => false,
          'current'    => max( 1, get_query_var('paged') ),
          'prev_text'  => $older_post_text,
          'next_text'  => $newer_post_text,
          'mid_size'   => 1,
          'type'       => 'list'
        ) );
      }
    }
  }
}

/* Product Category Filter Menu */
if ( ! function_exists( 'seese_category_list' ) ) {
  function seese_category_list() {

    $woo_order_cat   = cs_get_option('woo_order_cat');
    $woo_orderby_cat = cs_get_option('woo_orderby_cat');
    $woo_hide_empty  = cs_get_option('woo_hide_empty');
    $woo_cat_parent  = cs_get_option('woo_cat_parent');
    $woo_order_cat   = ($woo_order_cat) ? $woo_order_cat : 'ASC';
    $woo_orderby_cat = ($woo_orderby_cat) ? $woo_orderby_cat : 'name';
    $woo_hide_empty  = ($woo_hide_empty) ? 0 : 1;

    $args = array(
      'order'       => esc_attr($woo_order_cat),
      'orderby'     => esc_attr($woo_orderby_cat),
      'hide_empty'  => $woo_hide_empty,
    );

    if($woo_cat_parent) {
      $args['parent'] = 0;
    }

    $all_categories = get_terms('product_cat', $args);

    echo '<ul class="seese-filterCategory">'."\n";
    echo '<li class="seese-cat-item-all active"><a href="javascript:void(0);" data-procat="all">'. esc_html__('Show All', 'seese') .'</a></li>';
    foreach ($all_categories as $cat) {
      if($cat->category_parent == 0) {
        echo '<li class="seese-cat-item-'.$cat->term_id.'"><a href="javascript:void(0);" data-procat="'.esc_attr($cat->slug).'">'.$cat->name.'</a></li>';
      }
    }
    echo '</ul>';
  }
}

/* Pagination Function Shop */
if ( ! function_exists( 'seese_shop_paging_nav' ) ) {
  function seese_shop_paging_nav() {

    global $wp_query;
    $pagination_style = cs_get_option('woo_load_style');
    $lmore_shop_text  = cs_get_option('lmore_shop_text');
    $older_shop_text  = cs_get_option('older_shop_text');
    $newer_shop_text  = cs_get_option('newer_shop_text');

    if($pagination_style === 'page_number'){
      if ( function_exists('wp_pagenavi')) {
        wp_pagenavi( array( 'query' => $wp_query ) );
      } else {
        $older_shop_text = $older_shop_text ? $older_shop_text : '<i class="fa fa-angle-double-left"></i>';
        $newer_shop_text = $newer_shop_text ? $newer_shop_text : '<i class="fa fa-angle-double-right"></i>';
        $big = 999999999;
        echo paginate_links( array(
          'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
          'format'    => '?paged=%#%',
          'total'     => $wp_query->max_num_pages,
          'show_all'  => false,
          'current'   => max( 1, get_query_var('paged') ),
          'prev_text' => $older_shop_text,
          'next_text' => $newer_shop_text,
       	  'mid_size'  => 1,
          'type'      => 'list'
        ) );
      }
    } elseif($pagination_style === 'prev_next') {
      $older_shop_text = $older_shop_text ? $older_shop_text : esc_html__( 'Older Products', 'seese' );
      $newer_shop_text = $newer_shop_text ? $newer_shop_text : esc_html__( 'Newer Products', 'seese' ); ?>
      <div class="seese-prev-next-pagination seese-shop-pagination row">
        <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 newer">
          <?php next_posts_link( '<i class="fa fa-angle-double-left" aria-hidden="true"></i> '. $older_shop_text, $wp_query->max_num_pages ); ?>
        </div>
        <div class=" col-lg-6 col-md-6 col-sm-6 col-xs-12 older">
          <?php previous_posts_link( $newer_shop_text . ' <i class="fa fa-angle-double-right" aria-hidden="true"></i>', $wp_query->max_num_pages ); ?>
        </div>
      </div><?php
    } else {
      $lmore_shop_text = $lmore_shop_text ? $lmore_shop_text : esc_html__( 'Load More', 'seese' );  ?>
      <div class="seese-load-more-box seese-shop-load-more-box">
        <div class="seese-load-more-link seese-shop-load-more-link">
          <?php next_posts_link( '&nbsp;', $wp_query->max_num_pages ); ?>
        </div>
        <div class="seese-load-more-controls seese-shop-load-more-controls seese-btn-mode">
          <div class="line-scale-pulse-out">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
          <a href="javascript:void(0);" id="seese-shop-load-more-btn" class="seese-btn"><?php echo esc_attr($lmore_shop_text); ?></a>
          <a href="javascript:void(0);" id="seese-loaded" class="seese-btn"><?php echo esc_html__( 'All Loaded', 'seese' ); ?></a>
        </div>
      </div>
      <?php
    }
  }
}
