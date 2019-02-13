<?php
// Metabox
global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
$seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) {
  $seese_id   = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id;
  $seese_id   = ( !is_product_category() && !is_product_tag() ) ? $seese_id : false;
}
$seese_id   = ( !is_search() && !is_404() && !is_archive() && !is_category() && !is_tag() && !is_single('testimonial') ) ? $seese_id : false;
$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

// Title Bar Layout - ThemeOptions & Metabox
if ($seese_meta) {
  $title_bar  = $seese_meta['title_bar'];
  if ($title_bar === 'custom') {
		$title_area_layout     = $seese_meta['title_area_layout'];
	  $title_type            = ($seese_meta['title_type']) ? $seese_meta['title_type'] : 'default-title';
	  $title_area_spacings   = $seese_meta['title_area_spacings'];
	  $title_top_spacings    = $seese_meta['title_top_spacings'];
	  $title_bottom_spacings = $seese_meta['title_bottom_spacings'];
	  $title_area_breadcrumb = $seese_meta['title_area_breadcrumb'];
	  $title_area_outer_bg   = $seese_meta['title_area_outer_bg'];
	  $title_area_inner_bg   = $seese_meta['title_area_inner_bg'];
  } else {
		$title_area_layout     = cs_get_option('title_area_layout');
	  $title_type            = 'default-title';
	  $title_area_spacings   = cs_get_option('title_area_spacings');
	  $title_top_spacings    = cs_get_option('title_top_spacings');
	  $title_bottom_spacings = cs_get_option('title_bottom_spacings');
	  $title_area_breadcrumb = cs_get_option('title_area_breadcrumb');
	  $title_area_outer_bg   = cs_get_option('title_area_outer_bg');
	  $title_area_inner_bg   = cs_get_option('title_area_inner_bg');
	}
} else {
	$title_area_layout     = cs_get_option('title_area_layout');
	$title_type            = 'default-title';
	$title_area_spacings   = cs_get_option('title_area_spacings');
	$title_top_spacings    = cs_get_option('title_top_spacings');
	$title_bottom_spacings = cs_get_option('title_bottom_spacings');
	$title_area_breadcrumb = cs_get_option('title_area_breadcrumb');
	$title_area_outer_bg   = cs_get_option('title_area_outer_bg');
	$title_area_inner_bg   = cs_get_option('title_area_inner_bg');
}

if ($title_area_inner_bg['image']) {
  $bg_class = 'seese-title-bg seese-title-bg-inner ';
} elseif ($title_area_inner_bg['color']) {
	$bg_class = 'seese-title-bg-inner ';
} else {
	$bg_class = '';
}

if ($title_area_spacings && $title_area_spacings !== 'seese-padding-none') {
  if ($title_area_spacings === 'seese-padding-custom') {
	  $title_top_spacings = $title_top_spacings ? 'padding-top:'. seese_check_px($title_top_spacings) .' !important;' : '';
	  $title_bottom_spacings = $title_bottom_spacings ? 'padding-bottom:'. seese_check_px($title_bottom_spacings) .' !important;' : '';
	  $custom_padding = $title_top_spacings . $title_bottom_spacings;
  } else {
	  $custom_padding = '';
  }
} else {
  $custom_padding = '';
}

if ($title_area_layout === 'less-width') {
  $parent_class = 'seese-less-width';
  $layout_class = 'container seese-reduced';
} else {
  $parent_class = 'seese-extra-width';
  $layout_class = 'container';
}

if (!is_single() && !is_single('product') && !is_single('team') && !is_single('testimonial') && !is_404()) {
  if ( ($title_type !== 'hide-title-text') || ($title_area_breadcrumb) ) { ?>

	  <!-- Banner & Title Area Start -->
	  <div class="seese-title-area <?php echo esc_attr($parent_class); ?>">
	    <div class="seese-title-bg-outer">
	      <div class="<?php echo esc_attr($layout_class); ?>">

	        <?php
	        if (!is_home()) {
		        echo '<div class="seese-title-default '.esc_attr($bg_class.$title_area_spacings).'" style="'.esc_attr($custom_padding).'">';
			        if($title_type !== 'hide-title-text') {
			          if ( function_exists( 'seese_title_area' ) ): ?>
			            <h1 class="page-title">
			              <?php echo seese_title_area(); ?>
			            </h1>
			          <?php
			          endif;
			        }

			        if ($title_area_breadcrumb) {
			          if ( function_exists( 'breadcrumb_trail' ) ) {
			          	 echo breadcrumb_trail();
			          }
			        }
		        echo '</div>';
	      	} else {
	      		echo '<div class="seese-title-none"></div>';
	      	}
	        ?>

	      </div>
	    </div>
	  </div>
	  <!-- Banner & Title Area End -->

<?php }
  }
?>