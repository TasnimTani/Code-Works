<?php
/**
 * Template part for displaying posts.
 */
// Blog Theme Option
$blog_style            = cs_get_option('blog_listing_style');
$blog_columns          = cs_get_option('blog_listing_columns');
$blog_read_more_option = cs_get_option('blog_read_more_option');
$blog_popup_option     = cs_get_option('blog_popup_option');
$blog_metas_hide       = (array) cs_get_option('blog_metas_hide');
$blog_excerpt_length   = cs_get_option('blog_excerpt_length');
$blog_excerpt_length   = $blog_excerpt_length ? $blog_excerpt_length : '55';

// Blog Page Translation Text Option
$read_more_text = cs_get_option('read_more_text') ? cs_get_option('read_more_text') : esc_html__( 'Read More', 'seese' );

// Blog Page Layout Option
$post_type   = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$large_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$large_image = $large_image[0];
?>

<!-- Blog Start -->
<div class="seese-latestBlog">

  <?php
  if (is_sticky(get_the_ID())) {
    $sclass = 'sticky';
  } else {
    $sclass = '';
  } ?>

  <div id="post-<?php the_ID(); ?>" <?php post_class('seese-blog-post '.$sclass); ?>>

    <?php
    if (('gallery' == get_post_format()) && !empty($post_type['gallery_post_format'])) {
      $images = [];
      $ids    = explode( ',', $post_type['gallery_post_format'] );
      foreach ( $ids as $id ) {
        $attachment = wp_get_attachment_image_src( $id, 'full' );
        if ( isset($attachment[0]) ) {
          array_push($images, $attachment[0]);
        }
      }

      if ( count($images) > 0 ) { ?>
        <div class="seese-sliderBox">
          <ul class="owl-carousel seese-featureImg-carousel">
            <?php
            foreach ( $ids as $id ) {
              $attachment = wp_get_attachment_image_src( $id, 'full' );
              $alt   = get_post_meta($id, '_wp_attachment_image_alt', true);
              $alt   = ($alt) ? esc_attr($alt) : esc_attr(get_the_title());
              $g_img = $attachment[0];

              if ($blog_style === 'style-two') {
                $post_img = ($g_img) ? $g_img : '';
              } else {
                if ($blog_columns === 'seese-blog-col-3') {
                  if ($g_img){
                    if (class_exists('Aq_Resize')) {
                      $featured_img = aq_resize( $g_img, '370', '235', true );
                      $post_img = ($featured_img) ? $featured_img : SEESE_PLUGIN_ASTS . '/images/370x235.jpg';
                    } else {
                      $post_img = $g_img;
                    }
                  } else {
                    $post_img = '';
                  }
                } else if ($blog_columns === 'seese-blog-col-2') {
                  if ($g_img) {
                    if (class_exists('Aq_Resize')) {
                      $featured_img = aq_resize( $g_img, '570', '355', true );
                      $post_img = ($featured_img) ? $featured_img : SEESE_PLUGIN_ASTS . '/images/570x355.jpg';
                    } else {
                      $post_img = $g_img;
                    }
                  } else {
                    $post_img = '';
                  }
                } else {
                  if ($g_img){
                    $post_img = $g_img;
                  } else {
                    $post_img = '';
                  }
                }
              }

              if ($blog_popup_option) {
                $popup_class = 'seese-img-popup';
                $link_to = ($g_img) ? $g_img : get_the_permalink();
              } else {
                $popup_class = '';
                $link_to = get_the_permalink();
              }

              if ($post_img) {
                echo '<li><a href='.esc_url($link_to).' class="'.esc_attr($popup_class).'"><img src="'.esc_url($post_img).'" alt="'.$alt.'" /></a></li>';
              } else {
                echo '';
              }
            } ?>
          </ul>
        </div>
      <?php
      }
    } elseif (('audio' == get_post_format()) && !empty($post_type['audio_post_format'])) { ?>
      <div class="seese-music">
        <?php echo $post_type['audio_post_format']; ?>
      </div>
    <?php
    } elseif (('video' == get_post_format()) && !empty($post_type['video_post_format'])) { ?>
      <div class="seese-video">
        <?php echo $post_type['video_post_format']; ?>
      </div>
    <?php
    } elseif ($large_image) {

      if ($blog_style === 'style-two') {
        $post_img = ($large_image) ? $large_image : SEESE_PLUGIN_ASTS . '/images/1170x705.jpg';
      } else {
        if ($blog_columns === 'seese-blog-col-3') {
          if (class_exists('Aq_Resize')) {
            $post_img = aq_resize( $large_image, '370', '235', true );
            $post_img = ($post_img) ? $post_img : SEESE_PLUGIN_ASTS . '/images/370x235.jpg';
          } else {
            $post_img = $large_image;
          }
        } else if($blog_columns === 'seese-blog-col-2') {
          if (class_exists('Aq_Resize')) {
            $post_img = aq_resize( $large_image, '570', '355', true );
            $post_img = ($post_img) ? $post_img : SEESE_PLUGIN_ASTS . '/images/570x355.jpg';
          } else {
            $post_img = $large_image;
          }
        } else {
          $post_img = $large_image;
        }
      }

      if ($blog_popup_option) {
        $popup_class = 'seese-img-popup';
        $link_to = $large_image;
      } else {
        $popup_class = '';
        $link_to = get_the_permalink();
      } ?>

      <div class="seese-featureImg">
        <a href="<?php echo esc_url($link_to); ?>" class="<?php echo esc_attr($popup_class); ?>"><img src="<?php echo esc_url($post_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/></a>
      </div>
    <?php
    } else {
      echo '';
    } // Featured Image ?>

    <div class="seese-blog-excerpt">

      <?php
      if ( !in_array('date', $blog_metas_hide) || !in_array('author', $blog_metas_hide) || !in_array('category', $blog_metas_hide) ) { // Meta's Hide ?>
        <div class="seese-publish">
          <ul>
            <?php
            if (!in_array('author', $blog_metas_hide)) { // Author Hide ?>
              <li><span>by</span></li>
              <li><?php printf('<a href="%1$s" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()); ?></li>
            <?php
            }
            if (!in_array('date', $blog_metas_hide)) { // Date Hide
              if (!in_array( 'author', $blog_metas_hide)) { ?>
                <li><span>-</span></li><?php
              } ?>
              <li>
                <?php the_time('F d, Y'); ?>
              </li>
            <?php
            }
            if (!in_array( 'category', $blog_metas_hide)) { // Category Hide
              if (!in_array( 'date', $blog_metas_hide) || !in_array('author', $blog_metas_hide) ) { ?>
                <li><span>-</span></li><?php
              } ?>
              <li>
                <div class="seese-blog-cat">
                  <?php
                  $categories = get_the_category();
                  if ($categories) {
                    the_category( '<span>&nbsp;&amp;&nbsp;</span>' );
                  } ?>
                </div>
              </li>
            <?php
            } ?>
          </ul>
        </div>
      <?php
      } ?>

      <h3 class="blog-heading">
        <a href="<?php echo esc_url(get_permalink()); ?>">
          <?php echo esc_attr(get_the_title()); ?>
        </a>
      </h3>

      <div class="seese-article">
        <?php
        if ( function_exists( 'seese_excerpt' ) ) {
          seese_excerpt($blog_excerpt_length);
        }
        if ( function_exists( 'seese_wp_link_pages' ) ) {
          echo seese_wp_link_pages();
        } ?>
      </div>

      <?php
      if($blog_read_more_option) { ?>
        <div class="seese-readmore">
          <a href="<?php echo esc_url( get_permalink() ); ?>">
            <?php echo esc_attr($read_more_text). ' <i class="fa fa-angle-right"></i>'; ?>
          </a>
        </div>
      <?php
      } ?>

    </div>

  </div>
</div>
<!-- Post End -->