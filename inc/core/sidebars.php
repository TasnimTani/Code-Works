<?php
/*
 * Seese Theme Widgets
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

if ( ! function_exists( 'seese_framework_widget_init' ) ) {
  function seese_framework_widget_init() {
    if ( function_exists( 'register_sidebar' ) ) {

      // Main Widget Area
      register_sidebar(
     	array(
          'name'          => esc_html__('Main Widget', 'seese'),
          'id'            => 'sidebar-main',
          'description'   => esc_html__('Appears on posts and pages.', 'seese'),
          'before_widget' => '<div id="%1$s" class="seese-widget sidebar-main-widget %2$s">',
          'after_widget'  => '</div> <!-- end widget -->',
          'before_title'  => '<h2 class="widget-title">',
          'after_title'   => '</h2>',
   	    )
      );
      // Main Widget Area End

      if (class_exists('WooCommerce')) {

        // Shop Widget Start
        register_sidebar(
          array(
            'name'          => esc_html__('Shop Widget', 'seese'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Appears on Shop Pages.', 'seese'),
            'before_widget' => '<div id="%1$s" class="seese-widget sidebar-shop-widget %2$s">',
            'after_widget'  => '</div> <!-- end widget -->',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
          )
        );
        // Shop Widget End

        // Shop Filter Widget
        register_sidebar(
          array(
			'name'          => esc_html__('Shop Filter Top Widget', 'seese'),
			'id'            => 'sidebar-shop-filter',
			'description'   => esc_html__('Appears on Shop Pages.', 'seese'),
			'before_widget' => '<div id="%1$s" class="seese-widget sidebar-shop-filter-widget %2$s '.seese_count_widgets('sidebar-shop-filter').'">',
			'after_widget'  => '</div> <!-- end widget -->',
            'before_title'  => '<h3 class="widget-title collapsable">',
            'after_title'   => '</h3>'
		  )
		);
		// Shop Filter Widget End

      }

      // Footer Top Widget
      $footer_top_block = cs_get_option( 'footer_top_block' );

      if( $footer_top_block ) {
        register_sidebar( array(
            'id'            => 'footer-top-block',
            'name'          => esc_html__('Footer Top Widget', 'seese'),
            'description'   => esc_html__('Appears on footer section before footer widgets area.', 'seese'),
            'before_widget' => '<div class="seese-widget footer-top-block-widget %2$s seese-boxes '.seese_count_widgets('footer-top-block').'">',
            'after_widget'  => '<div class="clear"></div></div> <!-- end widget -->',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
          )
        );
      }
      // Footer Top Widget End

      // Footer Widgets
      $footer_widgets = cs_get_option('footer_widget_layout');

      if( $footer_widgets ) {

        switch ( $footer_widgets ) {
          case 5:
          case 6:
          case 7:
            $length = 3;
            break;
          case 8:
          case 9:
            $length = 4;
            break;
          default:
            $length = $footer_widgets;
            break;
        }

        for( $i = 0; $i < $length; $i++ ) {
          $num = ( $i+1 );
          register_sidebar( array(
            'id'            => 'footer-' . $num,
            'name'          => esc_html__('Footer Widget ', 'seese'). $num,
            'description'   => esc_html__('Appears on footer section.', 'seese'),
            'before_widget' => '<div class="seese-widget footer-'.$num.'-widget %2$s">',
            'after_widget'  => '<div class="clear"></div></div> <!-- end widget -->',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
          ) );
        }
      }
      // Footer Widgets End

      /* Custom Sidebar */
      $custom_sidebars = cs_get_option('custom_sidebar');

      if ($custom_sidebars) {

        foreach($custom_sidebars as $custom_sidebar) :

          $heading = $custom_sidebar['sidebar_name'];
          $own_id = preg_replace('/[^a-z]/', "-", strtolower($heading));
          $desc = $custom_sidebar['sidebar_desc'];

          register_sidebar( array(
            'id'            => $own_id,
            'name'          => esc_attr($heading),
            'description'   => esc_attr($desc),
            'before_widget' => '<div id="%1$s" class="seese-widget '.$own_id.'-widget %2$s">',
            'after_widget'  => '</div> <!-- end widget -->',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
          ) );

        endforeach;
      }
      /* Custom Sidebar End */
    }
  }

  add_action( 'widgets_init', 'seese_framework_widget_init' );
}