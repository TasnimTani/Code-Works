<?php
/**
 * Single Post.
 */

// Single Post Type Meta
$post_type             = get_post_meta( get_the_ID(), 'post_type_metabox', true );
$image_display_type    = !empty($post_type['image_display_type']) ? $post_type['image_display_type'] : 'img-slider';

// Single Theme Option
$single_metas_hide     = (array) cs_get_option( 'single_metas_hide' );
$single_featured_image = cs_get_option('single_featured_image');
$single_popup_option   = cs_get_option('single_popup_option');
$single_author_info    = cs_get_option('single_author_info');
$single_share_option   = cs_get_option('single_share_option');

// Single Featured Image Option
$single_large_image    = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$single_large_image    = $single_large_image[0];
?>

<!-- Post Start -->
<div class="seese-blog-post">
  <div id="post-<?php the_ID(); ?>">
    <h1 class="post-heading"><?php echo esc_attr(get_the_title()); ?></h1>

    <?php
    if ( !in_array('date', $single_metas_hide) || !in_array('author', $single_metas_hide) || !in_array('category', $single_metas_hide) ) { // Meta's Hide ?>
      <div class="seese-publish">
        <ul>

	        <?php
	        if (!in_array('author', $single_metas_hide)) { // Author Hide ?>
	          <li><span>by</span></li>
	          <li><?php printf('<a href="%1$s" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()); ?></li><?php
	        }

	        if (!in_array('date', $single_metas_hide)) { // Date Hide
	          if (!in_array( 'author', $single_metas_hide)) { ?>
	            <li><span>-</span></li><?php
	          } ?>
	          <li>
	            <?php the_time('F d, Y'); ?>
	          </li><?php
	        }

	        if (!in_array( 'category', $single_metas_hide)) { // Category Hide
	          if (!in_array( 'date', $single_metas_hide) || !in_array('author', $single_metas_hide) ) { ?>
	            <li><span>-</span></li><?php
	          } ?>
	          <li>
	            <div class="seese-blog-cat"><?php
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

    <?php
    if($single_featured_image){
      if (('gallery' == get_post_format()) && ($image_display_type == 'img-slider') && ! empty( $post_type['gallery_post_format'])) { ?>

        <div class="seese-sliderBox seese-featured">
          <ul class="owl-carousel seese-featureImg-carousel">
            <?php
            $ids = explode( ',', $post_type['gallery_post_format'] );
            foreach ( $ids as $id ) {
              $attachment = wp_get_attachment_image_src( $id, 'fullsize' );
              $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
              $alt = $alt ? esc_attr($alt) : esc_attr(get_the_title());

              $post_img = $attachment[0];
              $post_img = $post_img ? $post_img : SEESE_PLUGIN_ASTS . '/images/1170x705_sl.jpg';

              if ($single_popup_option) {
                $link_open = '<a href='. esc_url($post_img).' class="seese-img-popup">';
                $link_close = '</a>';
              } else {
                $link_open  = '';
                $link_close = '';
              }
              echo '<li>'. $link_open .'<img src="'.esc_url($post_img).'" alt="'.$alt.'" />'.$link_close.'</li>';
            }
            ?>
          </ul>
        </div>

      <?php
      } elseif ( ('gallery' == get_post_format()) && ($image_display_type == 'img-gallery') && ! empty( $post_type['gallery_post_format'] ) ) { ?>

        <div class="seese-gallery seese-featured">

          <?php
          $ids = explode( ',', $post_type['gallery_post_format'] );
          $count_img = count($ids);
          $count = 0; $row_img = 1;
          $row_number = ceil($count_img/2);

          foreach ( $ids as $id ) {
            $attachment = wp_get_attachment_image_src( $id, 'full' );
            $alt = get_post_meta($id, '_wp_attachment_image_alt', true);

     	      $count++;

            if( ($count === 1) || (($count % 2) === 1) ) {

              echo '<ul class="row">';

              if( ($count_img === 1) || (($row_number % 2) === 1 && ($row_number === $row_img)) ){
                echo '<li class="box col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                echo '<a href='.$attachment[0].'><img src="'. $attachment[0] .'" alt="'. esc_attr($alt) .'" /></a></li>';
              } else {
                if( ($row_img === 1) || (($row_img % 2) === 1) ) {
                    echo '<li class="box col-lg-8 col-md-8 col-sm-8 col-xs-8">';
                    echo '<a href='.$attachment[0].'><img src="'. aq_resize( $attachment[0], '575', '320', true ) .'" alt="'. esc_attr($alt) .'" /></a></li>';
                  } else {
                    echo '<li class="box col-lg-5 col-md-5 col-sm-5 col-xs-5">';
                    echo '<a href='.$attachment[0].'><img src="'. aq_resize( $attachment[0], '380', '230', true ) .'" alt="'. esc_attr($alt) .'" /></a></li>';
                  }
              }

            } else {

              if( ($row_img === 1) || (($row_img % 2) === 1) ) {
                echo '<li class="box col-lg-4 col-md-4 col-sm-4 col-xs-4">';
                echo '<a href='.$attachment[0].'><img src="'. aq_resize( $attachment[0], '250', '320', true ) .'" alt="'. esc_attr($alt) .'" /></a></li>';
              } else {

                echo '<li class="box col-lg-7 col-md-7 col-sm-7 col-xs-7">';
                echo '<a href='.$attachment[0].'><img src="'. aq_resize( $attachment[0], '445', '230', true ) .'" alt="'. esc_attr($alt) .'" /></a></li>';
              }
            }

            if((($count % 2) === 0) || ($count === $count_img)){
              echo '</ul>';
              $row_img++;
            }

       	  } ?>
        </div>
      <?php
      } elseif ( ('audio' == get_post_format()) && ! empty( $post_type['audio_post_format'] ) ) { ?>
        <div class="seese-music seese-featured">
          <?php echo $post_type['audio_post_format']; ?>
        </div>
      <?php
      } elseif ( ('video' == get_post_format()) && ! empty( $post_type['video_post_format'] ) ) { ?>
        <div class="seese-video seese-featured">
          <?php echo $post_type['video_post_format']; ?>
        </div>
	    <?php
	    } elseif ( $single_large_image ) { ?>
        <div class="seese-featureImg seese-featured">
          <?php
          if ($single_popup_option) {
            echo '<a href='. esc_url($single_large_image).' class="seese-img-popup">';
          }?>
          <img src="<?php echo esc_url($single_large_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
          <?php if ($single_popup_option) { echo '</a>'; } ?>
        </div>
	    <?php
	    } else {
        echo '';
      }
    } ?>

    <div class="seese-excerpt">

      <div class="seese-article">
        <?php
        the_content();
        if ( function_exists( 'seese_wp_link_pages' ) ) {
          echo seese_wp_link_pages();
        } ?>
      </div>

      <?php
      if( isset($single_share_option) || !in_array( 'tag', $single_metas_hide ) ) { ?>

        <div class="seese-sharebar">
          <div class="row">

          <?php
          if(isset($single_share_option)) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 sharebox">
               <?php
               if ( function_exists( 'seese_wp_share_option' ) ) {
                 echo seese_wp_share_option();
               } ?>
            </div>
          <?php
          }

          if (!in_array( 'tag', $single_metas_hide )) {
            $tag_list = get_the_tags(); if($tag_list) { ?>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 tagbox">
              <div class="taglist">
                <?php echo the_tags('', '', ''); ?>
              </div>
            </div>
            <?php
            }
          } ?>

          </div>
        </div>

      <?php
      } ?>

    </div>
  </div>
</div>
<!-- Post End -->

<!-- Author Info Start-->
<?php
  if(isset($single_author_info)) {
	seese_author_info();
  }
?>
<!-- Author Info End -->
