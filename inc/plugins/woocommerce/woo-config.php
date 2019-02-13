<?php
/*
 * All WooCommerce Related Functions
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

if ( class_exists( 'WooCommerce' ) ) {

	/**
	 * Remove each style one by one
	 * https://docs.woothemes.com/document/disable-the-default-stylesheet/
	 */
	add_filter( 'woocommerce_enqueue_styles', 'seese_dequeue_styles' );
    if ( ! function_exists('seese_dequeue_styles') ) {
		function seese_dequeue_styles( $enqueue_styles ) {
		  unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
		  unset( $enqueue_styles['woocommerce-layout'] );  // Remove the layout
		  return $enqueue_styles;
		}
	}

	/**
	* Product Listing Page Modification
	*/
	// Remove Shop Page Title
	add_filter( 'woocommerce_show_page_title', 'seese_hide_page_title' );
		if ( ! function_exists('seese_hide_page_title') ) {
		function seese_hide_page_title() {
		  return false;
		}
	}

	// Add Product Category Content Changes
	remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
	remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );

  add_action( 'woocommerce_before_subcategory', 'seese_product_cat_image_open', 9 );
  add_action( 'woocommerce_before_subcategory', 'seese_product_cat_link_open', 10 );
  add_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_close', 10, 2 );

  if (!function_exists('seese_product_cat_image_open')) {
		function seese_product_cat_image_open() {
			echo '<div class="seese-product-img">';
		}
	}

	if (!function_exists('seese_product_cat_link_open')) {
		function seese_product_cat_link_open( $category ) {
			echo '<a href="' . get_term_link( $category, 'product_cat' ) . '" class="woocommerce-LoopProduct-link">';
		}
	}

	remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
  add_action( 'woocommerce_before_subcategory_title', 'seese_product_cat_thumbnail', 10 );
  if (!function_exists('seese_product_cat_thumbnail')) {
		function seese_product_cat_thumbnail( $category ) {
			$html  = '<div class="seese-loop-thumb">';

			$small_thumbnail_size  	= apply_filters( 'subcategory_archive_thumbnail_size', 'shop_catalog' );
			$dimensions    			= wc_get_image_size( $small_thumbnail_size );
			$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

			if ( $thumbnail_id ) {
				$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
				$image        = $image[0];
				$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
				$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
			} else {
				$image        = wc_placeholder_img_src();
				$image_srcset = $image_sizes = false;
			}

			if ( $image ) {
				$image = str_replace( ' ', '%20', $image );
				if ( $image_srcset && $image_sizes ) {
					$html .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
				} else {
					$html .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
				}
			}

			$html .= '</div>';
			echo $html;
		}
	}

  add_action( 'woocommerce_before_subcategory_title', 'seese_product_cat_title_open', 10, 2);
  if (!function_exists('seese_product_cat_title_open')) {
		function seese_product_cat_title_open() {
			echo '</div><div class="seese-product-cnt"><div class="seese-product-text">';
		}
	}

	remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
	add_action( 'woocommerce_shop_loop_subcategory_title', 'seese_product_cat_title', 10 );
  if (!function_exists('seese_product_cat_title')) {
		function seese_product_cat_title( $category ) {
			$html  = '<h3>';
			$html .= esc_attr($category->name);
			if ( $category->count > 0 )
			  $html .= apply_filters( 'woocommerce_subcategory_count_html', ' ('.$category->count.') ', $category );
		  $html .= '</h3>';
		  echo $html;
		}
	}

	add_action( 'woocommerce_after_subcategory_title', 'seese_product_cat_title_close' );
  if (!function_exists('seese_product_cat_title_close')) {
		function seese_product_cat_title_close() {
			echo '</div></div>';
		}
	}

	// Remove Breadcrumbs
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

  // Remove Default Sidebar Hook
  remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

  // Remove Product Ordering, Count
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
  remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

  // Remove Template Loop Link
  remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

  // Remove Product Title
  remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
  // Remove Product Rating
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

  // Add Product Title
  add_action( 'woocommerce_shop_loop_item_title', 'seese_product_title', 10);
  if (!function_exists('seese_product_title')) {
		function seese_product_title() {
			echo '<h3>'. get_the_title() . '</h3>';
		}
	}

  // Add all products within this wrap. Product Listing Pages
  add_action( 'woocommerce_before_shop_loop', 'seese_all_products_open', 30, 2);
	if (!function_exists('seese_all_products_open')) {
		function seese_all_products_open() {
			$shop_page_url = get_permalink(wc_get_page_id('shop'));
			$html = '<div class="seese-shop-load-anim"><div class="line-scale-pulse-out"><div></div><div></div><div></div><div></div><div></div></div></div>';
			$html.= '<div class="seese-products-full-wrap seese-prsc-shop-default" data-shopurl="'.esc_url($shop_page_url).'">';
			echo $html;
		}
	}
  add_action( 'woocommerce_after_shop_loop', 'seese_all_products_close', 9);
	if (!function_exists('seese_all_products_close')) {
		function seese_all_products_close() {
			echo '</div>';
		}
	}

  // Add image within this wrap. Product Listing Pages
	add_action( 'woocommerce_before_shop_loop_item_title', 'seese_product_thumb_wrap_open', 9, 2);
	add_action( 'woocommerce_before_shop_loop_item_title', 'seese_product_thumb_wrap_close', 14, 2);
	if (!function_exists('seese_product_thumb_wrap_open')) {
		function seese_product_thumb_wrap_open() {
			$product_options = get_post_meta(get_the_ID(), 'product_options', true );
			$product_bg_color = (isset($product_options['product_single_bg'])) ? 'style="background:'.$product_options['product_single_bg'].'"' : '';
			$html = '<div class="seese-product-img" '.$product_bg_color.'>';
			$html.= '<a href="'.esc_url(get_permalink(get_the_ID())).'" class="woocommerce-LoopProduct-link"></a>';
			echo $html;
		}
	}
	if (!function_exists('seese_product_thumb_wrap_close')) {
		function seese_product_thumb_wrap_close() {
      echo '</div>';
		}
	}

  // Add Wishlist Plugin Button
  if ( defined( 'YITH_WCWL' ) ) {
  	// Make Wishlist Text Empty
		add_filter( 'yith_wcwl_button_label' , 'seese_add_to_wishlist_text_empty' );
		function seese_add_to_wishlist_text_empty() {
			return '';
	  }
  	add_action( 'woocommerce_before_shop_loop_item_title', 'seese_add_to_wishlist', 9);
	  if ( ! function_exists('seese_add_to_wishlist') ) {
	    function seese_add_to_wishlist() {
	      echo do_shortcode('[yith_wcwl_add_to_wishlist icon="fa-heart-o"]');
	    }
	  }
  }

  // Add Custom Badge
  add_action( 'woocommerce_before_shop_loop_item_title', 'seese_add_custom_badge', 9, 2);
  if ( ! function_exists('seese_add_custom_badge') ) {
    function seese_add_custom_badge() {
      $woo_single_custom_badge = get_post_meta( get_the_ID(), 'badge_input', true );
      if(!empty($woo_single_custom_badge)) {
        echo '<span class="seese-custom-badge">'. esc_attr( $woo_single_custom_badge ) .'</span>';
      }
    }
  }

	// Add Image Parent div Class and catalog image + hover image
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
	add_action( 'woocommerce_before_shop_loop_item_title', 'seese_loop_product_thumbnail', 10);
	if ( ! function_exists('seese_loop_product_thumbnail') ) {
	  function seese_loop_product_thumbnail() {
	    global $product;

	    $html = '';
	    $hover_image         = (cs_get_option('woo_hover_image')) ? true : false;
	    $product_options     = get_post_meta($product->get_id(), 'product_options', true );
			$product_hover_image = isset($product_options['product_hover_image_change']) ? $product_options['product_hover_image_change'] : true;

	    if ($hover_image && $product_hover_image) {
	      $product_gallery_thumbnail_ids = $product->get_gallery_image_ids();
	      $product_thumbnail_alt_id      = ($product_gallery_thumbnail_ids) ? reset($product_gallery_thumbnail_ids) : null;
	      if ($product_thumbnail_alt_id) {
	      	$product_thumbnail_alt_title = get_the_title($product_thumbnail_alt_id);
	        $product_thumbnail_alt_src   = wp_get_attachment_image_src( $product_thumbnail_alt_id, 'shop_catalog' );
	        if ($product_thumbnail_alt_src) {
	          $hover_parent_class = 'seese-loop-thumb-has-hover';
	        } else {
	          $hover_parent_class = '';
	        }
	      } else {
	      	$hover_parent_class = '';
	      }
	    } else {
	      $hover_parent_class = '';
	    }

	    $html .= '<div class="seese-loop-thumb '.esc_attr($hover_parent_class).'">';

	    if (has_post_thumbnail($product->get_id())) {
	    	$lazy_load_image_url     = SEESE_THEMEROOT_URI.'/inc/plugins/woocommerce/images/lazy-load.jpg';
				$product_thumbnail_id    = get_post_thumbnail_id();
				$product_thumbnail_title = get_the_title($product_thumbnail_id);
				$product_thumbnail_clog  = wp_get_attachment_image_src($product_thumbnail_id, 'shop_catalog');
				$product_thumbnail_full  = wp_get_attachment_image_src($product_thumbnail_id, 'full');
				$product_lazy_load       = cs_get_option('woo_lazy_load');

				if ( $product_lazy_load === 'seese-dload-full' ) {
					$html .= '<img width="'.esc_attr($product_thumbnail_clog[1]).'" height="'.esc_attr($product_thumbnail_clog[2]).'" src="'.esc_url($product_thumbnail_clog[0]).'" alt="'.esc_attr($product_thumbnail_title).'" data-src-main="'.esc_url($product_thumbnail_full[0]).'" class="attachment-shop_catalog size-shop_catalog wp-post-image" />';
				} else {
					$html .= '<img width="'.esc_attr($product_thumbnail_clog[1]).'" height="'.esc_attr($product_thumbnail_clog[2]).'" data-src="'.esc_url($product_thumbnail_clog[0]).'" src="'.esc_url($lazy_load_image_url).'" alt="'.esc_attr($product_thumbnail_title).'" data-src-main="'.esc_url($product_thumbnail_full[0]).'" class="attachment-shop_catalog size-shop_catalog wp-post-image seese-unveil-image" />';
					$html .= '<div class="seese-unveil-loader ball-beat"><div></div></div>';
				}

	    } else {
	    	$image_url = SEESE_THEMEROOT_URI.'/inc/plugins/woocommerce/images/shop-sample.jpg';
	  		$html .= '<img src="'.esc_url($image_url).'" class="attachment-shop-catalog size-shop_catalog" />';
	    }

	    if ($hover_image && $product_hover_image) {
	      $product_gallery_thumbnail_ids = $product->get_gallery_image_ids();
	      $product_thumbnail_alt_id = ($product_gallery_thumbnail_ids) ? reset($product_gallery_thumbnail_ids) : null;

	      if ($product_thumbnail_alt_id) {
	        $product_thumbnail_alt_title = get_the_title($product_thumbnail_alt_id);
	        $product_thumbnail_alt_src   = wp_get_attachment_image_src($product_thumbnail_alt_id, 'shop_catalog');
	        $product_thumbnail_alt_full  = wp_get_attachment_image_src($product_thumbnail_alt_id, 'full');

	        if ($product_thumbnail_alt_src) {
	          $html .= '<div class="seese-hover-image-wrap"><img width="'.esc_attr($product_thumbnail_alt_src[1]).'" height="'.esc_attr($product_thumbnail_alt_src[2]).'" src="'.esc_url($product_thumbnail_alt_src[0]).'" alt="'.esc_attr($product_thumbnail_alt_title).'" data-src-main="'.esc_url($product_thumbnail_alt_full[0]).'" class="attachment-shop_catalog size-shop_catalog seese-pr-hover-image" /></div>';
	        }
	      }
	    }

	    $html .= '</div>';
	    echo $html;
	  }
	}

	// Function to return new placeholder image URL for shop.
	add_filter( 'woocommerce_placeholder_img_src', 'seese_custom_shop_placeholder', 10 );
	function seese_custom_shop_placeholder( $image_url ) {
	  $image_url = SEESE_THEMEROOT_URI.'/inc/plugins/woocommerce/images/shop-sample.jpg';
	  return $image_url;
	}

	// Add product title, price and ratings within this wrap. Product Listing Pages
	add_action( 'woocommerce_before_shop_loop_item_title', 'seese_meta_wrap_open', 14, 2);
	add_action( 'woocommerce_after_shop_loop_item_title', 'seese_meta_wrap_atc_open', 12, 2);
	add_action( 'woocommerce_after_shop_loop_item', 'seese_meta_wrap_close' );
	if (!function_exists('seese_meta_wrap_open')) {
	  function seese_meta_wrap_open() {
	      echo '<div class="seese-product-cnt"><div class="seese-product-text">';
	  }
	}
	if (!function_exists('seese_meta_wrap_atc_open')) {
	  function seese_meta_wrap_atc_open() {
	      echo '</div><div class="seese-atc-wrap">';
	  }
	}
	if (!function_exists('seese_meta_wrap_close')) {
	  function seese_meta_wrap_close() {
	    global $product;
			echo '</div>';
	    echo get_the_term_list($product->get_id(), 'product_cat', '<div class="seese-posted-in-cats"><div class="seese-single-cat">', ', ', '</div></div>');
	    echo '</div>';
		}
	}

	// WooCommerce Products Per Page Limit
	add_filter( 'loop_shop_per_page', 'seese_product_limit', 20);
	if ( ! function_exists('seese_product_limit') ) {
		function seese_product_limit() {
			$woo_limit = cs_get_option('theme_woo_limit');
			$woo_limit = $woo_limit ? $woo_limit : '20';
			return $woo_limit;
		}
	}

	// Product Column Limit - Shop Page
	add_filter('loop_shop_columns', 'seese_loop_columns');
	if ( ! function_exists('seese_loop_columns') ) {
		function seese_loop_columns() {
			return cs_get_option('woo_product_columns', '4');
		}
	}

	// Remove WooCommerce Default Pagination & Add our Own Pagination
	remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
	function woocommerce_pagination() {
		seese_shop_paging_nav();
	}
	add_action( 'woocommerce_pagination', 'woocommerce_pagination', 10);

	// Display only min price for variable products.
	add_filter( 'woocommerce_variable_sale_price_html', 'seese_custom_variable_price', 10, 2 );
	add_filter( 'woocommerce_variable_price_html', 'seese_custom_variable_price', 10, 2 );
	function seese_custom_variable_price( $price, $product ) {
	  if ( !is_product() ) {
	    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
	    $price = $prices[0] !== $prices[1] ? sprintf( __( '<i class="fa fa-tags" aria-hidden="true"></i> %1$s', 'seese' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

	    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
	    sort( $prices );
	    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<i class="fa fa-tags" aria-hidden="true"></i> %1$s', 'seese' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

	    $price = isset($price) ? $price : $saleprice;
	  }
	  return $price;
	}

	// Display only min price for grouped products.
	add_filter( 'woocommerce_grouped_price_html', 'seese_grouped_price_html', 10, 2 );
	function seese_grouped_price_html( $price, $product ) {
	  if ( !is_product() ) {
	    $tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
		  $child_prices     = array();

			foreach ( $product->get_children() as $child_id ) {
				$child = wc_get_product( $child_id );
				if ( '' !== get_post_meta( $child_id, '_price', true ) ) {
					$child_prices[] = 'incl' === $tax_display_mode ? wc_get_price_including_tax( $child ) : wc_get_price_excluding_tax( $child );
				}
			}

			if ( ! empty( $child_prices ) ) {
				$min_price = min( $child_prices );
				$max_price = max( $child_prices );
			} else {
				$min_price = '';
				$max_price = '';
			}

	    if ( $min_price == $max_price ) {
	      $price = wc_price( $min_price );
	  	} else {
	  		$from  = wc_price( $min_price );
	  		$price = sprintf( __( '<i class="fa fa-tags" aria-hidden="true"></i> %1$s', 'seese' ), $from );
	  	}
	  }
	  return $price;
	}

	/**
	 * Product Single Page Modification
	 */
	// Single Product Page - Upsells Products Limit
	add_filter( 'woocommerce_upsell_display_args', 'seese_upsell_products_args' );
	function seese_upsell_products_args( $args ) {
		$woo_upsell_limit   = (cs_get_option('woo_upsell_limit')) ? cs_get_option('woo_upsell_limit') : '-1';
		$woo_upsell_columns = (cs_get_option('woo_upsell_columns')) ? cs_get_option('woo_upsell_columns') : '5';

		$args['posts_per_page'] = (int)$woo_upsell_limit;
		$args['columns'] = (int)$woo_upsell_columns;

		return $args;
	}

	// Single Product Page - Related Products Limit
	add_filter( 'woocommerce_output_related_products_args', 'seese_related_products_args' );
	function seese_related_products_args( $args ) {
		$woo_related_limit   = (cs_get_option('woo_related_limit')) ? cs_get_option('woo_related_limit') : '-1';
		$woo_related_columns = (cs_get_option('woo_related_columns')) ? cs_get_option('woo_related_columns') : '5';

		$args['posts_per_page'] = (int)$woo_related_limit;
		$args['columns'] = (int)$woo_related_columns;

		return $args;
	}

	// Remove Related Products - Single Page
  $woo_single_related = cs_get_option('woo_single_related');
  if (!$woo_single_related) {
	  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}

	// Remove "You May Also Like..." Products From Theme Option - Single Page
	$woo_single_upsell = cs_get_option('woo_single_upsell');
	if (!$woo_single_upsell) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	}

	// Change the gravator image size in review authors - Single Product Page - Use Same function name of : woocommerce_review_display_gravatar
	if ( ! function_exists( 'woocommerce_review_display_gravatar' ) ) {
		function woocommerce_review_display_gravatar( $comment ) {
			echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '80' ), '' );
		}
	}

	// Remove "product description" text
	add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
	function remove_product_description_heading() {
	  return '';
	}

	// Remove "additional information" text
	add_filter( 'woocommerce_product_additional_information_heading', 'remove_additional_information_heading' );
	function remove_additional_information_heading() {
	  return '';
	}

	// Moving the add to cart section and meta section
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 30);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40);

	// Add Wishlist Plugin Button
	if ( defined( 'YITH_WCWL' ) ) {
		add_action( 'woocommerce_after_add_to_cart_button', 'seese_single_add_to_wishlist');
		if ( ! function_exists('seese_single_add_to_wishlist') ) {
		  function seese_single_add_to_wishlist() {
		      echo do_shortcode('[yith_wcwl_add_to_wishlist icon="fa-heart-o"]');
		  }
		}
	}

	// Add Wishlist Plugin Button after Out of stock
	if ( defined( 'YITH_WCWL' ) ) {
		add_action( 'woocommerce_after_out_of_stock_wishlist', 'seese_single_out_of_stock_wishlist');
		if ( ! function_exists('seese_single_out_of_stock_wishlist') ) {
		  function seese_single_out_of_stock_wishlist() {
		      echo '<div class="seese-ositem-wishlist">'.do_shortcode('[yith_wcwl_add_to_wishlist icon="fa-heart-o"]').'</div>';
		  }
		}
	}

	// Change order of RRP and sale price
	function seese_rrp_price_html( $price, $product ) {
	  return preg_replace('@(<del>.*?</del>).*?(<ins>.*?</ins>)@misx', '$2 $1', $price);
	}
	add_filter('woocommerce_get_price_html', 'seese_rrp_price_html', 100, 2 );

	// Add class on "product description" text
	add_filter( 'woocommerce_single_product_summary', 'seese_product_description_open', 10, 2 );
	add_filter( 'woocommerce_single_product_summary', 'seese_product_description_close', 20, 2 );
	function seese_product_description_open() {
	  echo '<div class="seese_single_product_excerpt">';
	}
	function seese_product_description_close() {
	  echo '</div>';
	}

	// Moving the single share section before the related product section
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
	add_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_sharing', 10, 2);
	$woo_single_share = cs_get_option('woo_single_share');
	if (!$woo_single_share) {
	  remove_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_sharing', 10, 2);
	}

	// Share code into the woocommerce_template_single_sharing
	add_action( 'woocommerce_share', 'seese_wp_single_product_share_option' );
	if ( ! function_exists( 'seese_wp_single_product_share_option' ) ) {
	  function seese_wp_single_product_share_option() {
	    global $post;
	    $page_url      = get_permalink($post->ID);
	    $title         = $post->post_title;
	    $share_text    = cs_get_option('product_share_text') ? cs_get_option('product_share_text') : esc_html__('SHARE THIS ON', 'seese');
	    $share_on_text = cs_get_option('product_share_on_text') ? cs_get_option('product_share_on_text') : esc_html__('Share On', 'seese');
	    $share_hide    = (array) cs_get_option( 'woo_single_share_hide' );

	    $output = '';
	    $output.= '<div class="seese-single-product-share"><div class="container"><a href="javascript:void(0);">'.esc_attr($share_text).'<span>:</span></a>';
	    $output.= '<ul>';
	    if ( !in_array( 'twitter', $share_hide ) ) :
	        $output.= '<li><a href="//twitter.com/home?status='.urlencode($title).'+'.urlencode($page_url).'" class="icon-fa-twitter" data-toggle="tooltip" data-placement="top" title="'.esc_attr($share_on_text).' '.esc_html__('Twitter', 'seese').'" ><i class="fa fa-twitter"></i></a></li>';
	    endif;
	    if ( !in_array( 'facebook', $share_hide ) ) :
	        $output.= '<li><a href="//www.facebook.com/sharer/sharer.php?u='.urlencode($page_url).'&amp;t='.urlencode($title).'" class="icon-fa-facebook" data-toggle="tooltip" data-placement="top" title="'.esc_attr($share_on_text).' '.esc_html__('Facebook', 'seese').'" ><i class="fa fa-facebook"></i></a></li>';
	    endif;
	    if ( !in_array( 'googleplus', $share_hide ) ) :
	        $output.= '<li><a href="https://plus.google.com/share?url='.urlencode($page_url).'" class="icon-fa-google-plus" data-toggle="tooltip" data-placement="top" title="'.esc_attr($share_on_text).' '.esc_html__('Google+', 'seese').'" ><i class="fa fa-google-plus" ></i></a></li>';
	    endif;
	    if ( !in_array( 'linkedin', $share_hide ) ) :
	        $output.= '<li><a href="//www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode($page_url).'&amp;title='.urlencode($title).'" class="icon-fa-linkedin" data-toggle="tooltip" data-placement="top" title="'.esc_attr($share_on_text).' '.esc_html__('Linkedin', 'seese').'" ><i class="fa fa-linkedin"></i></a></li>';
	    endif;
	    if ( !in_array( 'pinterest', $share_hide ) ) :
	        $output.= '<li><a href="//pinterest.com/pin/create/button/?url='.urlencode($page_url).'&amp;description='.urlencode($title).'" class="icon-fa-pinterest" data-toggle="tooltip" data-placement="top" title="'.esc_attr($share_on_text).' '.esc_html__('Pinterest', 'seese').'" ><i class="fa fa-pinterest-p"></i></a></li>';
	    endif;
	    $output.= '</ul></div></div>';
	    echo $output;
	  }
	}

	// Function to return new placeholder for large image.
	add_filter( 'woocommerce_single_product_image_html', 'seese_single_product_image_html', 10, 2 );
	function seese_single_product_image_html( $html, $post_id ) {
	  if ( !has_post_thumbnail() ) {
      $html = '<div><img src="'.SEESE_THEMEROOT_URI.'/inc/plugins/woocommerce/images/single-product-sample.jpg" alt="'.esc_html__('Placeholder', 'seese').'" /></div>';
      return $html;
	  } else {
	    return $html;
	  }
	}

	// Comments Form - Textarea next to Normal Fields
	add_filter( 'comment_form_fields', 'seese_move_comment_field' );
	function seese_move_comment_field( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}

	/**
	* Cart Page Modification
	*/
	// Remove Cross Sells => "You may be interested in" from Cart Page
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );


	/**
	* General Modification
	*/
	// Add to cart text
	function add_to_cart_text_change() {

		add_filter( 'woocommerce_product_add_to_cart_text' , 'seese_product_add_to_cart' );
		function seese_product_add_to_cart() {

			$woo_cart = esc_html__('Add To Cart', 'seese');
			global $product;

			if ( $product->is_type( 'simple' ) ) {
			  $return_text = ($product->is_purchasable() && $product->is_in_stock()) ? $woo_cart : esc_html__('Read More', 'seese');
			} elseif ($product->is_type( 'variable' )) {
			  $return_text = esc_html__('Select Options', 'seese');
			} elseif ($product->is_type( 'grouped' )) {
			  $return_text = esc_html__('View Details', 'seese');
			} elseif ($product->is_type( 'external' )) {
				$button_text = $product->get_button_text();
				$return_text = ($button_text) ? $button_text : esc_html__('Buy Now', 'seese');
			}	else {
				$return_text = $woo_cart;
			}

			return $return_text;
		}
	} // Function OT
	add_action( 'after_setup_theme', 'add_to_cart_text_change' );

	// Define image sizes
	// add_theme_support( 'woocommerce', array(
	//   'thumbnail_image_width' => 500,
	//   'single_image_width' => 590,
	// ) );

	// update_option( 'woocommerce_thumbnail_cropping', 'custom' );
	// update_option( 'woocommerce_thumbnail_cropping_custom_width', '7' );
	// update_option( 'woocommerce_thumbnail_cropping_custom_height', '8' );

	/**
	* Custom Feilds For Woocommerce Category
	*/
	function seese_taxonomy_add_new_meta_field() { ?>
	  <div class="form-field">
	      <label for="term_meta[wh_meta_size]"><?php esc_html_e('Grid Size', 'seese'); ?></label>
	      <select name="term_meta[wh_meta_size]" id="term_meta[wh_meta_size]">
	          <?php
	          $size_list = array(
	              'd-wh'    => esc_html__('Default', 'seese'),
	              'dh-2w'   => esc_html__('Double Width Default Height', 'seese'),
	              'dw-2h'   => esc_html__('Double Height Default Width', 'seese'),
	              'd-2wh'   => esc_html__('Double Width & Height', 'seese'),
	          );
	          foreach($size_list as $key => $list) {
	              echo '<option value="'.$key.'">'.$list.'</option>';
	          }
	          ?>
	    </select>
	      <p class="description"><?php esc_html_e('Select grid size for masonary layout', 'seese'); ?></p>
	  </div>
	<?php
	}
	add_action('product_cat_add_form_fields', 'seese_taxonomy_add_new_meta_field', 10, 2);

	function seese_taxonomy_edit_meta_field($term) {
	  $term_id        = $term->term_id;
	  $term_meta      = get_option("taxonomy_" . $term_id);
	  $term_meta_size = ($term_meta['wh_meta_size']) ? esc_attr($term_meta['wh_meta_size']) : '';
	  ?>
	  <tr class="form-field">
      <th scope="row" valign="top"><label for="term_meta[wh_meta_size]"><?php esc_html_e('Grid Size', 'seese'); ?></label></th>
      <td>
        <select name="term_meta[wh_meta_size]" id="term_meta[wh_meta_size]">
          <?php
          $size_list = array(
              'd-wh'    => esc_html__('Default', 'seese'),
              'dh-2w'   => esc_html__('Double Width Default Height', 'seese'),
              'dw-2h'   => esc_html__('Double Height Default Width', 'seese'),
              'd-2wh'   => esc_html__('Double Width & Height', 'seese'),
          );
          foreach($size_list as $key => $list) {
              $sel = ($term_meta_size == $key) ? 'selected="true"' : '';
              echo '<option value="'.$key.'" '.$sel.'>'.$list.'</option>';
          }
          ?>
				</select>
				<p class="description"><?php esc_html_e('Select grid size for masonary layout', 'seese'); ?></p>
      </td>
	  </tr>
	<?php
	}
	add_action('product_cat_edit_form_fields', 'seese_taxonomy_edit_meta_field', 10, 2);

	function save_taxonomy_custom_meta($term_id) {
	  if (isset($_POST['term_meta'])) {
      $term_meta = get_option("taxonomy_" . $term_id);
      $cat_keys = array_keys($_POST['term_meta']);
      foreach ($cat_keys as $key) {
        if (isset($_POST['term_meta'][$key])) {
            $term_meta[$key] = $_POST['term_meta'][$key];
        }
      }
      update_option("taxonomy_" . $term_id, $term_meta);
	  }
	}
	add_action('edited_product_cat', 'save_taxonomy_custom_meta', 10, 2);
	add_action('create_product_cat', 'save_taxonomy_custom_meta', 10, 2);

	/**
	* Custom Feilds For Woocommerce Single Product
	*/
	add_action('woocommerce_product_data_tabs', 'seese_custom_product_data_tab', 99, 1);
  function seese_custom_product_data_tab($product_data_tabs) {
    $product_data_tabs['seese-custom-tab'] = array(
      'label'  => __( 'Seese Options', 'seese' ),
      'target' => 'seese_custom_product_data',
    );
    return $product_data_tabs;
  }

	// Display Fields
	add_action('woocommerce_product_data_panels', 'seese_custom_product_data_fields');
	function seese_custom_product_data_fields() {
	  global $woocommerce, $post;
	  echo '<div id="seese_custom_product_data" class="panel woocommerce_options_panel options_group">';
	  woocommerce_wp_text_input(
      array(
      	'id'          => 'badge_input',
      	'label'       => esc_html__( 'Add badge', 'seese' ),
      	'desc_tip'    => 'true',
        'description' => esc_html__( 'Enter the badge text here.', 'seese' )
 	    )
	  );
	  echo '</div>';
	}

	// Save Fields
	add_action('woocommerce_process_product_meta', 'seese_custom_product_data_fields_save');
	function seese_custom_product_data_fields_save( $post_id ){
	  update_post_meta( $post_id, 'badge_input', $_POST['badge_input']);
	}

	// Cart Count Number Ajax Update
	if ( defined('WOOCOMMERCE_VERSION') && version_compare( WOOCOMMERCE_VERSION, '2.7', '>=' ) ) {
		add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_ajax_fragments' );
	} else {
		add_filter( 'add_to_cart_fragments', 'woocommerce_ajax_fragments' );
	}

	function woocommerce_ajax_fragments( $fragments ) {
		global $woocommerce;
		ob_start(); ?>
		<span class="seese-cart-count"><?php echo $woocommerce->cart->get_cart_contents_count(); ?></span>
		<?php
		$fragments['.seese-cart-count'] = ob_get_clean();
		return $fragments;
  }

} // class_exists => WooCommerce

?>