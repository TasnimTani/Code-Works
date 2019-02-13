<?php
/*
 * Codestar Framework - Custom Style
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/* All Dynamic CSS Styles */
if ( ! function_exists( 'seese_dynamic_styles' ) ) {
	function seese_dynamic_styles() {
		$seese_framework_get_typography = seese_framework_get_typography();

		ob_start();

		global $post;
		$seese_id   = ( isset( $post ) ) ? $post->ID : false;
		$seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
		$seese_id   = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id;
		$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

		/* Title Area Outer Background */
		$title_bar  = isset($seese_meta['title_bar']) ? $seese_meta['title_bar'] : '';

	  if ($title_bar === 'custom') {
	  	$title_area_outer_bg = isset($seese_meta['title_area_outer_bg']) ? $seese_meta['title_area_outer_bg'] : '';
	  	$title_area_text_color = isset($seese_meta['title_area_text_color']) ? $seese_meta['title_area_text_color'] : '';
	  	$title_area_inner_bg = isset($seese_meta['title_area_inner_bg']) ? $seese_meta['title_area_inner_bg'] : '';
	  	$title_area_outer_overlay = isset($seese_meta['title_area_outer_overlay']) ? $seese_meta['title_area_outer_overlay'] : '';
	  } elseif ($title_bar === 'hide') {
	  	$title_area_outer_bg = '';
	  	$title_area_text_color = '';
	  	$title_area_inner_bg = '';
	  	$title_area_outer_overlay = '';
	  } else {
	  	$title_bar_tp   = cs_get_option('title_bar');
			if($title_bar_tp){
		    $title_area_outer_bg = cs_get_option('title_area_outer_bg');
		    $title_area_text_color = cs_get_option('title_area_text_color');
		    $title_area_inner_bg = cs_get_option('title_area_inner_bg');
		    $title_area_outer_overlay = cs_get_option('title_area_outer_overlay');
		  } else {
		  	$title_area_outer_bg = '';
		  	$title_area_text_color = '';
	  	  $title_area_inner_bg = '';
	  	  $title_area_outer_overlay = '';
		  }
	  }

$title_area_outer_bg_url = ( ! empty( $title_area_outer_bg['image'] ) ) ? 'background-image: url('. $title_area_outer_bg['image'] .');' : ' ';
$title_area_outer_bg_repeat = ( ! empty( $title_area_outer_bg['repeat'] ) ) ? 'background-repeat: '. $title_area_outer_bg['repeat'] .';' : 'background-repeat: no-repeat;';
$title_area_outer_bg_position = ( ! empty( $title_area_outer_bg['position'] ) ) ? 'background-position: '. $title_area_outer_bg['position'] .';' : 'background-position: center top;';
$title_area_outer_bg_attachment = ( ! empty( $title_area_outer_bg['attachment'] ) ) ? 'background-attachment: '. $title_area_outer_bg['attachment'] .';' : '';
$title_area_outer_bg_size = ( ! empty( $title_area_outer_bg['size'] ) ) ? 'background-size: '. $title_area_outer_bg['size'] .';' : 'background-size: cover;';
$title_area_outer_bg_color = ( ! empty( $title_area_outer_bg['color'] ) ) ? 'background-color: '. $title_area_outer_bg['color'] .';' : '';

if ( isset($title_area_outer_bg_url) || isset($title_area_outer_bg_color) ) {
echo <<<CSS
.no-class {}
.seese-title-bg-outer {
  position: relative;
  {$title_area_outer_bg_url}
  {$title_area_outer_bg_repeat}
  {$title_area_outer_bg_position}
  {$title_area_outer_bg_attachment}
  {$title_area_outer_bg_size}
  {$title_area_outer_bg_color}
}
CSS;
}
if ( isset($title_area_text_color) ) {
echo <<<CSS
.no-class {}
.seese-title-default .page-title {
  color: {$title_area_text_color};
}
CSS;
}
if ( isset($title_area_outer_bg_url) || isset($title_area_outer_bg_color) ) {
echo <<<CSS
.no-class {}
.seese-title-bg-outer::before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: {$title_area_outer_overlay};
}
CSS;
}

/* Title Area Inner Background */
$title_area_inner_overlay = isset($seese_meta['title_area_inner_overlay']) ? $seese_meta['title_area_inner_overlay'] : cs_get_option('title_area_inner_overlay');

$title_area_inner_bg_url = ( ! empty( $title_area_inner_bg['image'] ) ) ? 'background-image: url('. $title_area_inner_bg['image'] .');' : ' ';
$title_area_inner_bg_repeat = ( ! empty( $title_area_inner_bg['repeat'] ) ) ? 'background-repeat: '. $title_area_inner_bg['repeat'] .';' : 'background-repeat: no-repeat;';
$title_area_inner_bg_position = ( ! empty( $title_area_inner_bg['position'] ) ) ? 'background-position: '. $title_area_inner_bg['position'] .';' : 'background-position: center top;';
$title_area_inner_bg_attachment = ( ! empty( $title_area_inner_bg['attachment'] ) ) ? 'background-attachment: '. $title_area_inner_bg['attachment'] .';' : '';
$title_area_inner_bg_size = ( ! empty( $title_area_inner_bg['size'] ) ) ? 'background-size: '. $title_area_inner_bg['size'] .';' : 'background-size: cover;';
$title_area_inner_bg_color = ( ! empty( $title_area_inner_bg['color'] ) ) ? 'background-color: '. $title_area_inner_bg['color'] .';' : '';

if (isset($title_area_inner_bg_url) || isset($title_area_inner_bg_color)) {
echo <<<CSS
.no-class {}
.seese-title-bg-inner {
	position: relative;
	{$title_area_inner_bg_url}
	{$title_area_inner_bg_repeat}
	{$title_area_inner_bg_position}
	{$title_area_inner_bg_attachment}
	{$title_area_inner_bg_size}
	{$title_area_inner_bg_color}
}
CSS;
}
if ($title_area_inner_overlay) {
echo <<<CSS
.no-class {}
.seese-title-bg-inner:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
	background-color: {$title_area_inner_overlay};
}
CSS;
}

/* Page Layout Outer Background - Page Metabox/Theme Option - Background */
$content_layout_outer_bg_meta = (isset($seese_meta['content_layout_outer_bg'])) ? $seese_meta['content_layout_outer_bg'] : '';
$content_layout_outer_bg_pmb  = (isset($content_layout_outer_bg_meta)) ? $content_layout_outer_bg_meta : '';
$content_overlay_outer_color  = (isset($seese_meta['content_overlay_outer_color'])) ? $seese_meta['content_overlay_outer_color'] : cs_get_option('content_overlay_outer_color');

$content_layout_outer_bg_pmb_image = isset($content_layout_outer_bg_pmb['image']) ? $content_layout_outer_bg_pmb['image'] : '';
$content_layout_outer_bg_pmb_color = isset($content_layout_outer_bg_pmb['color']) ? $content_layout_outer_bg_pmb['color'] : '';

if ($content_layout_outer_bg_pmb_image || $content_layout_outer_bg_pmb_color) {
	$content_layout_outer_bg = $content_layout_outer_bg_pmb;
} else {
	$content_layout_outer_bg = cs_get_option('content_layout_outer_bg');
}

$content_layout_outer_bg_url        = ( ! empty( $content_layout_outer_bg['image'] ) ) ? 'background-image: url('. $content_layout_outer_bg['image'] .');' : ' ';
$content_layout_outer_bg_repeat     = ( ! empty( $content_layout_outer_bg['repeat'] ) ) ? 'background-repeat: '. $content_layout_outer_bg['repeat'] .';' : 'background-repeat: no-repeat;';
$content_layout_outer_bg_position   = ( ! empty( $content_layout_outer_bg['position'] ) ) ? 'background-position: '. $content_layout_outer_bg['position'] .';' : 'background-position: center top;';
$content_layout_outer_bg_attachment = ( ! empty( $content_layout_outer_bg['attachment'] ) ) ? 'background-attachment: '. $content_layout_outer_bg['attachment'] .';' : '';
$content_layout_outer_bg_size       = ( ! empty( $content_layout_outer_bg['size'] ) ) ? 'background-size: '. $content_layout_outer_bg['size'] .';' : 'background-size: cover;';
$content_layout_outer_bg_color      = ( ! empty( $content_layout_outer_bg['color'] ) ) ? 'background-color: '. $content_layout_outer_bg['color'] .';' : 'background-color: #ffffff;';

if ($content_layout_outer_bg_url || $content_layout_outer_bg_color) {
echo <<<CSS
.no-class {}
.seese-background-outer {
	position: relative;
	{$content_layout_outer_bg_url}
	{$content_layout_outer_bg_repeat}
	{$content_layout_outer_bg_position}
	{$content_layout_outer_bg_attachment}
	{$content_layout_outer_bg_size}
	{$content_layout_outer_bg_color}
}
CSS;
}
if ($content_overlay_outer_color) {
echo <<<CSS
.no-class {}
.seese-background-outer:before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: {$content_overlay_outer_color};
}
CSS;
}

/* Page Layout Inner Background - Page Metabox/Theme Option - Background */
$content_layout_inner_bg_meta = (isset($seese_meta['content_layout_inner_bg'])) ? $seese_meta['content_layout_inner_bg'] : '';
$content_layout_inner_bg_pmb  = (isset($content_layout_inner_bg_meta)) ? $content_layout_inner_bg_meta : '';
$content_overlay_inner_color  = (isset($seese_meta['content_overlay_inner_color'])) ? $seese_meta['content_overlay_inner_color'] : cs_get_option('content_overlay_inner_color');

$content_layout_inner_bg_pmb_image = isset($content_layout_inner_bg_pmb['image']) ? $content_layout_inner_bg_pmb['image'] : '';
$content_layout_inner_bg_pmb_color = isset($content_layout_inner_bg_pmb['color']) ? $content_layout_inner_bg_pmb['color'] : '';

if ($content_layout_inner_bg_pmb_image || $content_layout_inner_bg_pmb_color) {
  $content_layout_inner_bg = $content_layout_inner_bg_pmb;
} else {
  $content_layout_inner_bg = cs_get_option('content_layout_inner_bg');
}

$content_layout_inner_bg_url        = ( ! empty( $content_layout_inner_bg['image'] ) ) ? 'background-image: url('. $content_layout_inner_bg['image'] .');' : ' ';
$content_layout_inner_bg_repeat     = ( ! empty( $content_layout_inner_bg['repeat'] ) ) ? 'background-repeat: '. $content_layout_inner_bg['repeat'] .';' : 'background-repeat: no-repeat;';
$content_layout_inner_bg_position   = ( ! empty( $content_layout_inner_bg['position'] ) ) ? 'background-position: '. $content_layout_inner_bg['position'] .';' : 'background-position: center top;';
$content_layout_inner_bg_attachment = ( ! empty( $content_layout_inner_bg['attachment'] ) ) ? 'background-attachment: '. $content_layout_inner_bg['attachment'] .';' : '';
$content_layout_inner_bg_size       = ( ! empty( $content_layout_inner_bg['size'] ) ) ? 'background-size: '. $content_layout_inner_bg['size'] .';' : 'background-size: cover;';
$content_layout_inner_bg_color      = ( ! empty( $content_layout_inner_bg['color'] ) ) ? 'background-color: '. $content_layout_inner_bg['color'] .';' : 'background-color: #ffffff;';

if ($content_layout_inner_bg_url || $content_layout_inner_bg_color) {
echo <<<CSS
.no-class {}
.seese-background-inner {
	position: relative;
	{$content_layout_inner_bg_url}
	{$content_layout_inner_bg_repeat}
	{$content_layout_inner_bg_position}
	{$content_layout_inner_bg_attachment}
	{$content_layout_inner_bg_size}
	{$content_layout_inner_bg_color}
}
CSS;
}
if ($content_overlay_inner_color) {
echo <<<CSS
.no-class {}
.seese-background-inner:before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: {$content_overlay_inner_color};
}
CSS;
}

/* Footer Layout Background- Theme Options - Background */
$footer_layout_bg = cs_get_option('footer_layout_bg');
$footer_bg_overlay_color = cs_get_option('footer_bg_overlay_color');

$footer_layout_bg_url = ( ! empty( $footer_layout_bg['image'] ) ) ? 'background-image: url('. $footer_layout_bg['image'] .');' : ' ';
$footer_layout_bg_repeat = ( ! empty( $footer_layout_bg['repeat'] ) ) ? 'background-repeat: '. $footer_layout_bg['repeat'] .';' : 'background-repeat: no-repeat;';
$footer_layout_bg_position = ( ! empty( $footer_layout_bg['position'] ) ) ? 'background-position: '. $footer_layout_bg['position'] .';' : 'background-position: center top;';
$footer_layout_bg_attachment = ( ! empty( $footer_layout_bg['attachment'] ) ) ? 'background-attachment: '. $footer_layout_bg['attachment'] .';' : '';
$footer_layout_bg_size = ( ! empty( $footer_layout_bg['size'] ) ) ? 'background-size: '. $footer_layout_bg['size'] .';' : 'background-size: cover;';
$footer_layout_bg_color = ( ! empty( $footer_layout_bg['color'] ) ) ? 'background-color: '. $footer_layout_bg['color'] .';' : '';

if ($footer_layout_bg_url || $footer_layout_bg_color) {
echo <<<CSS
.no-class {}
.seese-footer {
	position: relative;
	{$footer_layout_bg_url}
	{$footer_layout_bg_repeat}
	{$footer_layout_bg_position}
	{$footer_layout_bg_size}
	{$footer_layout_bg_attachment}
	{$footer_layout_bg_color}
}
CSS;
}
if ($footer_bg_overlay_color) {
echo <<<CSS
.no-class {}
.seese-footer:before {
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: {$footer_bg_overlay_color};
}
CSS;
}

// Primary Colors
$all_element_color  = cs_get_customize_option( 'all_element_colors' );
if ($all_element_color) {
echo <<<CSS
	.no-class {}
	a,
	.seese-aside .product_list_widget li a:hover,
	.seese-aside .product_list_widget li .remove:hover,
	.error404 .error-content h2 span,
	.seese-contentCol .seese-publish li a:hover,
	.seese-sharebar .sharebox a:hover,
	.seese-author .author-content a:hover,
	.seese-pagination .older:hover a .seese-label,
	.seese-pagination .newer:hover a .seese-label,
	.comment-wrapper .comments-date .comments-reply a:hover,
	.seese-latestBlog h3.blog-heading a:hover,
	.breadcrumbs li a:hover,
	.seese-readmore a:hover,
	.seese-sidebar li a:hover,
	.seese-sidebar .seese-recent-blog .boxright h4 a:hover,
	.seese-sidebar .widget_categories li a:hover,
	.seese-team-box .seese-team-info .seese-lift-up .member-name a:hover,
	.slick-slider .seese-prslr-content .seese-prslr-title a:hover,
	.woocommerce-error,
	.woocommerce-error li,
	.woocommerce-checkout .woocommerce-info a:hover,
	.woocommerce .shop_table td a:hover,
	.product-remove a:hover,
	.woocommerce .wishlist_table .product-name a:hover,
	.woocommerce .wishlist_table .product-remove a:hover,
	.seese-product-summary-col .product_meta span a:hover,
	.woocommerce div.product .woocommerce-product-rating a:hover,
	p.stock.out-of-stock,
	.woocommerce-cart .cart-collaterals .cart_totals table .shipping td .shipping-calculator-button,
    .woocommerce ul.products .seese-product-img .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover i,
	.woocommerce .seese-product-summary-col a.add_to_wishlist.button.alt:hover i,
	.woocommerce .seese-product-summary-col a.add_to_wishlist:hover i {color: {$all_element_color};}

	input[type="checkbox"]:checked + label::after,
	input[type="checkbox"]:checked + label::after,
	.tagbox .taglist a:hover,
	.seese-author li a:hover,
	.comment-wrapper .comments-date .comments-reply a:hover,
	.slick-slider .slick-dots li.slick-active button,
	p.woocommerce-thankyou-order-received,
	.woocommerce-checkout .woocommerce-info a:hover,
	.seese-prsc-shop-carousel .owl-dots .owl-dot.active,
	.seese-testi-slider .owl-dots .owl-dot.active {border-color: {$all_element_color};}

	.line-scale-pulse-out>div,
	.seese-prsc-shop-carousel .owl-dots .owl-dot:hover,
	.slick-slider .slick-dots li button:hover,
	.vc_btn3-container a.vc_general:hover,
	.tagbox .taglist a:hover,
	.seese-author li a:hover,
	.seese-sidebar .tagcloud a:hover,
	.seese-testi-slider .owl-dots .owl-dot:hover {background: {$all_element_color};}
CSS;
}

// Menu Bar Background Color
$menubar_bg_color  = cs_get_customize_option( 'menubar_bg_color' );
if ($menubar_bg_color) {
echo <<<CSS
	.no-class {}
	.seese-header {background: {$menubar_bg_color};}
CSS;
}

// Main Menu Color
$mainmenu_link_color  = cs_get_customize_option( 'mainmenu_link_color' );
if ($mainmenu_link_color) {
echo <<<CSS
	.no-class {}
	.seese-mainmenu ul li a,
	.slicknav_nav li a {color: {$mainmenu_link_color};}
CSS;
}

// Main Menu Hover Color
$mainmenu_link_hover_color  = cs_get_customize_option( 'mainmenu_link_hover_color' );
if ($mainmenu_link_hover_color) {
echo <<<CSS
.no-class {}
.seese-mainmenu ul>li.current-menu-ancestor>a,
.seese-mainmenu ul>li.current-menu-item>a,
.seese-mainmenu ul>li.current_page_parent>a,
.seese-mainmenu ul li.active a,
.seese-mainmenu ul li a:hover,
.navbar-toggle:hover .icon-bar,
.slicknav_nav>li.current-menu-ancestor>a,
.slicknav_nav>li.current-menu-ancestor>a>a,
.slicknav_nav>li.current-menu-parent>a>a,
.slicknav_nav>li.current-menu-parent>a,
.slicknav_nav li.active > a,
.slicknav_nav li.active > a a,
.slicknav_nav ul li a:hover,
.slicknav_nav li a:hover,
.slicknav_nav li a:hover a,
.slicknav_nav li li a:hover,
.slicknav_nav li li.active a,
.slicknav_nav li li.active li a:hover,
.seese-mainmenu ul>li li.current_page_parent>a,
.slicknav_nav li ul>li.current-menu-parent>a>a,
.slicknav_nav li ul li li.current-menu-item a,
.slicknav_nav li ul li.current-menu-item>a,
.slicknav_nav li li a:hover a,
.slicknav_nav li ul>li.current-menu-parent>a {color: {$mainmenu_link_hover_color};}
CSS;
}

// Sub Menu Background Color
$submenu_bg_color  = cs_get_customize_option( 'submenu_bg_color' );
if ($submenu_bg_color) {
echo <<<CSS
.no-class {}
.seese-mainmenu ul li ul, #seese-mobilemenu .slicknav_nav {background: {$submenu_bg_color};}
CSS;
}

// Sub Menu Color
$submenu_link_color  = cs_get_customize_option( 'submenu_link_color' );
if ($submenu_link_color) {
echo <<<CSS
.no-class {}
.seese-mainmenu ul li ul li a,
.seese-mainmenu ul>li.current-menu-ancestor li a,
.seese-mainmenu ul>li.current_page_parent li a,
.slicknav_nav li li a,
.slicknav_nav li li.active li a,
.seese-mainmenu ul li ul li a:link,
.seese-mainmenu ul li ul li a:active,
.seese-mainmenu ul li ul li a:visited {color: {$submenu_link_color};}
CSS;
}

// Sub Menu Hover Color
$submenu_link_hover_color  = cs_get_customize_option( 'submenu_link_hover_color' );
if ($submenu_link_hover_color) {
echo <<<CSS
.no-class {}
.seese-mainmenu ul li ul li.active>a:link,
.seese-mainmenu ul li ul li.active>a:active,
.seese-mainmenu ul li ul li.active>a:visited,
.seese-mainmenu ul li ul li a:hover,
.seese-mainmenu ul li ul li.current-menu-item li a:hover,
.seese-mainmenu ul li ul li.current_page_parent>a:link,
.seese-mainmenu ul li ul li.current_page_parent>a:active,
.seese-mainmenu ul li ul li.current_page_parent>a:visited,
.seese-mainmenu ul li ul li.current-menu-item>a:link,
.seese-mainmenu ul li ul li.current-menu-item>a:active,
.seese-mainmenu ul li ul li.current-menu-item>a:visited,
.seese-mainmenu ul li ul li.current-menu-parent>a:link,
.seese-mainmenu ul li ul li.current-menu-parent>a:active,
.seese-mainmenu ul li ul li.current-menu-parent>a:visited  {color: {$submenu_link_hover_color};}
CSS;
}

// Title Color
$title_text_color  = cs_get_customize_option( 'title_text_color' );
if ($title_text_color) {
echo <<<CSS
.no-class {}
.seese-contentCol h1.post-heading,
.seese-title-area .page-title,
.track_order h2 {color: {$title_text_color};}
CSS;
}

// Breadcrumbs text color
$breadcrumbs_text_color  = cs_get_customize_option( 'breadcrumbs_text_color' );
if ($breadcrumbs_text_color) {
echo <<<CSS
.no-class {}
.breadcrumbs li a {color: {$breadcrumbs_text_color};}
CSS;
}

// Body Content Color
$body_color  = cs_get_customize_option( 'body_color' );
if ($body_color) {
echo <<<CSS
.no-class {}
body,
.single .seese-article strong {color: {$body_color};}
CSS;
}

// Body Link Color
$body_links_color  = cs_get_customize_option( 'body_links_color' );
if ($body_links_color) {
echo <<<CSS
.no-class {}
.seese-contentCol a {color: {$body_links_color};}
CSS;
}

// Body Link Hover Color
$body_link_hover_color  = cs_get_customize_option( 'body_link_hover_color' );
if ($body_link_hover_color) {
echo <<<CSS
.no-class {}
.seese-contentCol a:hover {color: {$body_link_hover_color};}
CSS;
}

// Sidebar Content Color
$sidebar_content_color  = cs_get_customize_option( 'sidebar_content_color' );
if ($sidebar_content_color) {
echo <<<CSS
.no-class {}
.seese-sidebar {color: {$sidebar_content_color};}
CSS;
}

// Content Heading Color
$content_heading_color  = cs_get_customize_option( 'content_heading_color' );
if ($content_heading_color) {
echo <<<CSS
.no-class {}
.seese-contentCol h1,
.seese-contentCol h1 a,
.seese-contentCol h2,
.seese-contentCol h2 a,
.seese-contentCol h3,
.seese-contentCol h3 a,
.seese-contentCol h4,
.seese-contentCol h4 a,
.seese-contentCol h5,
.seese-contentCol h5 a,
.seese-contentCol h6,
.seese-contentCol h6 a  {color: {$content_heading_color} !important;}
CSS;
}

// Sidebar Heading Color
$sidebar_heading_color  = cs_get_customize_option( 'sidebar_heading_color' );
if ($sidebar_heading_color) {
echo <<<CSS
.no-class {}
.seese-sidebar .seese-widget h2,.seese-aside .seese-sidebar .seese-widget h2, .seese-sidebar h2.widget-title {color: {$sidebar_heading_color};}
CSS;
}

// Footer Widget Heading Color
$footer_heading_color  = cs_get_customize_option( 'footer_heading_color' );
if ($footer_heading_color) {
echo <<<CSS
.no-class {}
.seese-bottomboxes h4, .seese-footer h2 {color: {$footer_heading_color} !important;}
CSS;
}

// Footer Widget Color
$footer_text_color  = cs_get_customize_option( 'footer_text_color' );
if ($footer_text_color) {
echo <<<CSS
.no-class {}
.seese-bottomboxes, .seese-footer {color: {$footer_text_color};}
CSS;
}

// Footer link Color
$footer_link_color  = cs_get_customize_option( 'footer_link_color' );
if ($footer_link_color) {
echo <<<CSS
.no-class {}
.seese-footer .widget_nav_menu li a, .seese-footer a, .seese-bottomboxes a {color: {$footer_link_color} !important;}
CSS;
}

// Footer link hover Color
$footer_link_hover_color  = cs_get_customize_option( 'footer_link_hover_color' );
if ($footer_link_hover_color) {
echo <<<CSS
.no-class {}
.seese-footer .widget_nav_menu li a:hover, .seese-footer a:hover, .seese-bottomboxes a:hover {color: {$footer_link_hover_color} !important;}
CSS;
}

// Copyright text Color
$copyright_text_color  = cs_get_customize_option( 'copyright_text_color' );
if ($copyright_text_color) {
echo <<<CSS
.no-class {}
.seese-copyright {color: {$copyright_text_color};}
CSS;
}

// Copyright Link Color
$copyright_link_color  = cs_get_customize_option( 'copyright_link_color' );
if ($copyright_link_color) {
echo <<<CSS
.no-class {}
.seese-copyright a {
	color: {$copyright_link_color} !important;
}
CSS;
}

// Copyright Link Hover Color
$copyright_link_hover_color  = cs_get_customize_option( 'copyright_link_hover_color' );
if ($copyright_link_hover_color) {
echo <<<CSS
.no-class {}
.seese-copyright a:hover {color: {$copyright_link_hover_color} !important;}
CSS;
}


// Maintenance Mode
$maintenance_mode_bg  = cs_get_option( 'maintenance_mode_bg' );
$page = cs_get_option('maintenance_mode_page');
if ($maintenance_mode_bg) {
  $maintenance_css = ( ! empty( $maintenance_mode_bg['image'] ) ) ? 'background-image: url('. $maintenance_mode_bg['image'] .');' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['repeat'] ) ) ? 'background-repeat: '. $maintenance_mode_bg['repeat'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['position'] ) ) ? 'background-position: '. $maintenance_mode_bg['position'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['attachment'] ) ) ? 'background-attachment: '. $maintenance_mode_bg['attachment'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['size'] ) ) ? 'background-size: '. $maintenance_mode_bg['size'] .';' : '';
  $maintenance_css .= ( ! empty( $maintenance_mode_bg['color'] ) ) ? 'background-color: '. $maintenance_mode_bg['color'] .';' : '';
echo <<<CSS
  .no-class {}
  body.page-id-{$page} {
    {$maintenance_css}
  }
CSS;
}

// Mobile Menu Breakpoint
$mobile_breakpoint  = cs_get_option( 'mobile_breakpoint');
$menu_breakpoint    = $mobile_breakpoint ? $mobile_breakpoint : '767';

echo <<<CSS
.no-class {}
@media (max-width: {$menu_breakpoint}px) {
	.seese-mainmenu {display: none;}
	.slicknav_menu {display: block;}
	.slicknav_menu .nav.navbar-nav {display: block;}
	.navbar {min-height: inherit;}
	.seese-navicon {
	  padding-top: 14px;
	  padding-bottom: 13px;
	}
	.sub-menu.row {margin: 0 !important;}
	.seese-fixed-header .scrolling.seese-header .seese-topright,
	.seese-topright {
	  padding-right: 50px;
	}
}
CSS;

// Preloader Color
$preloader_color    = cs_get_customize_option( 'preloader_color');
$preloader_bg_color = cs_get_customize_option( 'preloader_bg_color');
$preloader_options  = cs_get_option('theme_preloader_options');

$preloader_color    = isset($preloader_color) ? $preloader_color : $all_element_color;
$preloader_bg_color = isset($preloader_bg_color) ? $preloader_bg_color : '#FFFFFF';

echo <<<CSS
.no-class {}
.seese-preloader-mask {
    background-color: {$preloader_bg_color};
    height: 100%;
    position: fixed;
    width: 100%;
    z-index: 100000;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    line-height: 0px;
}
#seese-preloader-wrap {
    display: table;
    margin: 0 auto;
    top: 50%;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    position: relative;
    line-height: 0px;
}
.seese-preloader-html.{$preloader_options} > div {
  background-color: {$preloader_color};
  color: {$preloader_color};
}
CSS;

	echo $seese_framework_get_typography;
	$output = ob_get_clean();
	return $output;

	}
}

/**
 * Custom Font Family -  // Typography
 */
if ( ! function_exists( 'seese_custom_font_load' ) ) {
  function seese_custom_font_load() {

    $font_family       = cs_get_option( 'font_family' );

    ob_start();

    if( ! empty( $font_family ) ) {

      foreach ( $font_family as $font ) {
        echo '@font-face{';

        echo 'font-family: "'. $font['name'] .'";';

        if( empty( $font['css'] ) ) {
          echo 'font-style: normal;';
          echo 'font-weight: normal;';
        } else {
          echo $font['css'];
        }

        echo ( ! empty( $font['ttf']  ) ) ? 'src: url('. esc_url($font['ttf']) .');' : '';
        echo ( ! empty( $font['eot']  ) ) ? 'src: url('. esc_url($font['eot']) .');' : '';
        echo ( ! empty( $font['svg']  ) ) ? 'src: url('. esc_url($font['svg']) .');' : '';
        echo ( ! empty( $font['woff'] ) ) ? 'src: url('. esc_url($font['woff']) .');' : '';
        echo ( ! empty( $font['otf']  ) ) ? 'src: url('. esc_url($font['otf']) .');' : '';

        echo '}';
      }

    }

    $output = ob_get_clean();
    return $output;
  }
}

/* Custom Styles */
if( ! function_exists( 'seese_framework_custom_css' ) ) {
  function seese_framework_custom_css() {
    wp_enqueue_style('seese-default-style', get_template_directory_uri() . '/style.css');
    $output  = seese_custom_font_load();
    $output .= seese_dynamic_styles();
    $output .= cs_get_option( 'theme_custom_css' );
    $custom_css = seese_compress_css_lines( $output );

    wp_add_inline_style( 'seese-default-style', $custom_css );
  }
}

/* Custom JS */
if( ! function_exists( 'seese_framework_custom_js' ) ) {
  function seese_framework_custom_js() {
    if ( ! wp_script_is( 'jquery', 'done' ) ) {
      wp_enqueue_script( 'jquery' );
    }
    $output = cs_get_option( 'theme_custom_js' );
    wp_add_inline_script( 'jquery-migrate', $output );
  }
  add_action( 'wp_enqueue_scripts', 'seese_framework_custom_js' );
}
