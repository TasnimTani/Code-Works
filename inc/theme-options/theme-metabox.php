<?php
/*
 * All Metabox related options for Seese theme.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

function seese_metabox_options( $options ) {

  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'seese'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title'          => esc_html__('Standard/Image Format', 'seese'),
            'type'           => 'subheading',
            'content'        => esc_html__('There is no Extra Option for this Post Format!', 'seese'),
            'wrap_class'     => 'seese-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'           => 'notice',
            'wrap_class'     => 'gallery-title',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Gallery Format', 'seese')
          ),
          array(
            'id'             => 'image_display_type',
            'type'           => 'select',
            'title'          => esc_html__('Display Format', 'seese'),
            'options'        => array(
              'img-slider'   => esc_html__('Slider', 'seese'),
              'img-gallery'  => esc_html__('Tiles', 'seese'),
            ),
            'default_option' => 'Select Display Format',
            'info'           => esc_html__('Default option : Slider', 'seese'),
          ),
          array(
            'id'             => 'gallery_post_format',
            'type'           => 'gallery',
            'title'          => esc_html__('Add Gallery', 'seese'),
            'add_title'      => esc_html__('Add Image(s)', 'seese'),
            'edit_title'     => esc_html__('Edit Image(s)', 'seese'),
            'clear_title'    => esc_html__('Clear Image(s)', 'seese'),
          ),
          // Gallery

          // Audio
          array(
            'type'           => 'notice',
            'wrap_class'     => 'audio-title',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Audio Format', 'seese')
          ),
          array(
            'id'             => 'audio_post_format',
            'type'           => 'textarea',
            'title'          => esc_html__('Add Audio', 'seese'),
            'sanitize'       => false,
          ),
          // Audio

          // Video
          array(
            'type'           => 'notice',
            'wrap_class'     => 'video-title',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Video Format', 'seese')
          ),
          array(
            'id'             => 'video_post_format',
            'type'           => 'textarea',
            'title'          => esc_html__('Add Video', 'seese'),
            'sanitize'       => false,
          ),
          // Video
        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'seese'),
    'post_type' => array('page', 'post', 'product', 'team'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Header Menu Bar
      array(
        'name'       => 'menu_bar_section',
        'title'      => esc_html__('Menu Bar', 'seese'),
        'icon'       => 'fa fa-minus',
        'fields'     => array(

          array(
            'id'          => 'menu_bar',
            'type'        => 'image_select',
            'title'       => esc_html__('Menu Bar', 'seese'),
            'options'     => array(
              'default'   => SEESE_CS_IMAGES . '/meta-default.png',
              'custom'    => SEESE_CS_IMAGES . '/meta-custom.png',
              'hide'      => SEESE_CS_IMAGES . '/meta-hide.png',
            ),
            'attributes'  => array(
              'data-depend-id' => 'menu_bar',
            ),
            'radio'       => true,
            'default'     => 'default',
          ),
          array(
            'id'          => 'menubar_bg',
            'type'        => 'color_picker',
            'title'       => esc_html__('Background Color', 'seese'),
            'rgba'        => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'          => 'bottom_border_color',
            'type'        => 'color_picker',
            'title'       => esc_html__('Bottom Border Color', 'seese'),
            'rgba'        => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'          => 'sticky_header',
            'type'        => 'switcher',
            'title'       => esc_html__('Sticky Header', 'seese'),
            'info'        => esc_html__('Turn On if you want your menu bar on sticky.', 'seese'),
            'default'     => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'          => 'search_icon',
            'type'        => 'switcher',
            'title'       => esc_html__('Search', 'seese'),
            'info'        => esc_html__('Turn On if you want to show search icon in menu bar.', 'seese'),
            'default'     => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'          => 'heart_icon',
            'type'        => 'switcher',
            'title'       => esc_html__('Heart', 'seese'),
            'info'        => esc_html__('Turn On if you want to show heart icon in menu bar.', 'seese'),
            'default'     => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'          => 'cart_widget',
            'type'        => 'switcher',
            'title'       => esc_html__('Cart Widget', 'seese'),
            'info'        => esc_html__('Turn On if you want to show cart widget in menu bar. Make sure about installation/activation of WooCommerce plugin.', 'seese'),
            'default'     => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'          => 'login_my_account',
            'type'        => 'switcher',
            'title'       => esc_html__('Login/My Account', 'seese'),
            'info'        => esc_html__('Turn On if you want to show login/my-account in menu bar. Make sure about installation/activation of WooCommerce plugin.', 'seese'),
            'default'     => true,
            'dependency'  => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'         => 'wpml',
            'type'       => 'switcher',
            'title'      => esc_html__('WPML', 'seese'),
            'info'       => esc_html__('Turn On if you want to show WPML translator in menu bar. Make sure about installation/activation of WPML plugins.', 'seese'),
            'default'    => false,
            'dependency' => array('menu_bar', '==', 'custom'),
          ),
          array(
            'id'         => 'wpml_shortcode',
            'type'       => 'textarea',
            'title'      => esc_html__('WPML Shortcode', 'seese'),
            'info'       => esc_html__('Include WPML shortcode here.', 'seese'),
            'shortcode'  => true,
            'dependency' => array( 'wpml', '==', 'true' ),
          ),


        ),
      ),

       // Banner & Title Area
      array(
        'name'   => 'banner_title_section',
        'title'  => esc_html__('Title Area', 'seese'),
        'icon'   => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'             => 'title_bar',
            'type'           => 'image_select',
            'title'          => esc_html__('Title Area', 'seese'),
            'options'        => array(
              'default'      => SEESE_CS_IMAGES . '/meta-default.png',
              'custom'       => SEESE_CS_IMAGES . '/meta-custom.png',
              'hide'         => SEESE_CS_IMAGES . '/meta-hide.png',
            ),
            'attributes'     => array(
              'data-depend-id' => 'title_bar',
            ),
            'radio'          => true,
            'default'        => 'default',
          ),
          array(
            'id'             => 'title_area_layout',
            'type'           => 'image_select',
            'title'          => esc_html__('Layout', 'seese'),
            'options'        => array(
              'extra-width'  => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'   => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'     => array(
              'data-depend-id' => 'title_area_layout',
            ),
            'radio'          => true,
            'default'        => 'extra-width',
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'title_type',
            'type'           => 'select',
            'title'          => esc_html__('Title Text', 'seese'),
            'options'        => array(
              'custom-title-text' => esc_html__('Custom Title', 'seese'),
              'hide-title-text'   => esc_html__('Hide Title', 'seese'),
            ),
            'default_option' => 'Default Title',
            'info'           => esc_html__('Page title text type.', 'seese'),
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'page_custom_title',
            'type'           => 'text',
            'title'          => esc_html__('Custom Title', 'seese'),
            'attributes'     => array(
              'placeholder'  => esc_html__('Enter your custom title...', 'seese'),
            ),
            'dependency'     => array('title_bar|title_type', '==|==', 'custom|custom-title-text'),
          ),
          array(
            'id'               => 'title_area_text_color',
            'type'             => 'color_picker',
            'title'            => esc_html__('Title Color', 'seese'),
            'rgba'             => true,
            'info'             => esc_html__('Title text color.', 'seese'),
            'dependency'     => array('title_bar|title_type', '==|==', 'custom|custom-title-text'),
          ),
          array(
            'id'             => 'title_area_spacings',
            'type'           => 'select',
            'title'          => esc_html__('Spacings', 'seese'),
            'options'        => array(
              'seese-padding-none'   => esc_html__('Default Spacing', 'seese'),
              'seese-padding-xs'     => esc_html__('Extra Small Padding', 'seese'),
              'seese-padding-sm'     => esc_html__('Small Padding', 'seese'),
              'seese-padding-md'     => esc_html__('Medium Padding', 'seese'),
              'seese-padding-lg'     => esc_html__('Large Padding', 'seese'),
              'seese-padding-xl'     => esc_html__('Extra Large Padding', 'seese'),
              'seese-padding-custom' => esc_html__('Custom Padding', 'seese'),
            ),
            'info'           => esc_html__('Title area top and bottom spacings.', 'seese'),
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'title_top_spacings',
            'type'           => 'text',
            'title'          => esc_html__('Top Spacing', 'seese'),
            'attributes'     => array('placeholder' => '100px'),
            'dependency'     => array('title_bar|title_area_spacings', '==|==', 'custom|seese-padding-custom'),
          ),
          array(
            'id'             => 'title_bottom_spacings',
            'type'           => 'text',
            'title'          => esc_html__('Bottom Spacing', 'seese'),
            'attributes'     => array('placeholder' => '100px'),
            'dependency'     => array('title_bar|title_area_spacings', '==|==', 'custom|seese-padding-custom'),
          ),
          array(
            'id'             => 'title_area_outer_bg',
            'type'           => 'background',
            'title'          => esc_html__('Outer Background', 'seese'),
            'rgba'           => true,
            'info'           => esc_html__('Title outer area background.', 'seese'),
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'title_area_outer_overlay',
            'type'           => 'color_picker',
            'title'          => esc_html__('Outer Overlay Color', 'seese'),
            'rgba'           => true,
            'info'           => esc_html__('Title outer area background image overlay color.', 'seese'),
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'title_area_inner_bg',
            'type'           => 'background',
            'title'          => esc_html__('Inner Background', 'seese'),
            'rgba'           => true,
            'info'           => esc_html__('Title inner area background.', 'seese'),
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'title_area_inner_overlay',
            'type'           => 'color_picker',
            'title'          => esc_html__('Inner Overlay Color', 'seese'),
            'rgba'           => true,
            'info'           => esc_html__('Title inner area background image overlay color.', 'seese'),
            'dependency'     => array('title_bar', '==', 'custom'),
          ),
          array(
            'id'             => 'title_area_breadcrumb',
            'type'           => 'switcher',
            'title'          => esc_html__('Breadcrumbs', 'seese'),
            'info'           => esc_html__('Turn On if you want to show breadcrumbs in title area.', 'seese'),
            'default'        => true,
            'dependency'     => array('title_bar', '==', 'custom'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section Start
      array(
        'name'   => 'content_section',
        'title'  => esc_html__('Content Area', 'seese'),
        'icon'   => 'fa fa-file',
        'fields' => array(

          array(
            'id'          => 'content_spacings',
            'type'        => 'select',
            'title'       => esc_html__('Content Spacings', 'seese'),
            'options'     => array(
              'seese-padding-none'   => esc_html__('Default Spacing', 'seese'),
              'seese-padding-xs'     => esc_html__('Extra Small Padding', 'seese'),
              'seese-padding-sm'     => esc_html__('Small Padding', 'seese'),
              'seese-padding-md'     => esc_html__('Medium Padding', 'seese'),
              'seese-padding-lg'     => esc_html__('Large Padding', 'seese'),
              'seese-padding-xl'     => esc_html__('Extra Large Padding', 'seese'),
              'seese-padding-custom' => esc_html__('Custom Padding', 'seese'),
            ),
            'info'        => esc_html__('Content area top and bottom spacings.', 'seese'),
          ),
          array(
            'id'          => 'content_top_spacings',
            'type'        => 'text',
            'title'       => esc_html__('Top Spacing', 'seese'),
            'attributes'  => array('placeholder' => '100px'),
            'dependency'  => array('content_spacings', '==', 'seese-padding-custom'),
          ),
          array(
            'id'          => 'content_bottom_spacings',
            'type'        => 'text',
            'title'       => esc_html__('Bottom Spacing', 'seese'),
            'attributes'  => array('placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'seese-padding-custom'),
          ),
          array(
            'id'          => 'content_layout_outer_bg',
            'type'        => 'background',
            'title'       => esc_html__('Outer Background', 'seese' ),
            'info'        => esc_html__('Content outer area background.', 'seese'),
          ),
          array(
            'id'          => 'content_overlay_outer_color',
            'type'        => 'color_picker',
            'title'       => esc_html__('Outer Overlay Color', 'seese'),
            'rgba'        => true,
            'info'        => esc_html__('Content outer area background image overlay color.', 'seese')
          ),
          array(
            'id'          => 'content_layout_inner_bg',
            'type'        => 'background',
            'title'       => esc_html__('Inner Background', 'seese' ),
            'info'        => esc_html__('Content inner area background.', 'seese'),
          ),
          array(
            'id'          => 'content_overlay_inner_color',
            'type'        => 'color_picker',
            'title'       => esc_html__('Inner Overlay Color', 'seese'),
            'rgba'        => true,
            'info'        => esc_html__('Content inner area background image overlay color.', 'seese'),
          ),

        ),
      ),
      // Content Section End

      // Enable & Disable
      array(
        'name'   => 'hide_show_section',
        'title'  => esc_html__('Enable & Disable', 'seese'),
        'icon'   => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'      => 'hide_header',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Header', 'seese'),
            'label'   => esc_html__('Yes, Please do it.', 'seese'),
            'default' => false,
          ),
          array(
            'id'      => 'hide_footer',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Footer', 'seese'),
            'label'   => esc_html__('Yes, Please do it.', 'seese'),
            'default' => false,
          ),

        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'seese'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'       => 'page_layout_section',
        'fields'     => array(

          array(
            'id'               => 'page_layout',
            'type'             => 'image_select',
            'options'          => array(
              'extra-width'    => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'     => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'       => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'          => 'extra-width',
            'radio'            => true,
            'wrap_class'       => 'text-center',
          ),
          array(
            'id'               => 'page_show_sidebar',
            'type'             => 'switcher',
            'title'            => esc_html__('Show Sidebar', 'seese'),
            'default'          => false,
          ),
          array(
            'id'               => 'page_sidebar_position',
            'type'             => 'image_select',
            'options'          => array(
              'sidebar-left'   => SEESE_CS_IMAGES . '/page-sidebar-1.png',
              'sidebar-right'  => SEESE_CS_IMAGES . '/page-sidebar-2.png',
            ),
            'attributes'       => array(
              'data-depend-id' => 'page_sidebar_position',
            ),
            'default'          => 'sidebar-left',
            'radio'            => true,
            'wrap_class'       => 'text-center',
            'dependency'       => array('page_show_sidebar', '==', 'true'),
          ),
          array(
            'id'               => 'page_sidebar_space',
            'type'             => 'select',
            'title'            => esc_html__('Sidebar Space With Content Column', 'seese'),
            'options'          => array(
              'space-one'      => esc_html__('Space 1', 'seese'),
              'space-two'      => esc_html__('Space 2', 'seese'),
            ),
            'default_option'   => esc_html__('Select Space', 'seese'),
            'dependency'       => array('page_show_sidebar', '==', 'true'),
          ),
          array(
            'id'               => 'page_sidebar_widget',
            'type'             => 'select',
            'title'            => esc_html__('Sidebar Widget', 'seese'),
            'options'          => seese_framework_registered_sidebars(),
            'default_option'   => esc_html__('Select Widget', 'seese'),
            'dependency'       => array('page_show_sidebar', '==', 'true'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Post Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_page_layout_options',
    'title'     => esc_html__('Page Layout', 'seese'),
    'post_type' => array('post'),
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'       => 'post_page_layout_section',
        'fields'     => array(

          array(
            'id'               => 'post_page_layout',
            'type'             => 'image_select',
            'options'          => array(
              'theme-default'  => SEESE_CS_IMAGES . '/theme-default.png',
              'extra-width'    => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'     => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'       => array(
              'data-depend-id' => 'post_page_layout',
            ),
            'default'          => 'theme-default',
            'radio'            => true,
            'wrap_class'       => 'text-center',
          ),
          array(
            'id'               => 'post_page_show_sidebar',
            'type'             => 'switcher',
            'title'            => esc_html__('Show Sidebar', 'seese'),
            'default'          => false,
            'dependency'       => array('post_page_layout', 'any', 'extra-width,less-width'),
          ),
          array(
            'id'               => 'post_page_sidebar_position',
            'type'             => 'image_select',
            'options'          => array(
              'sidebar-left'   => SEESE_CS_IMAGES . '/page-sidebar-1.png',
              'sidebar-right'  => SEESE_CS_IMAGES . '/page-sidebar-2.png',
            ),
            'attributes'       => array(
              'data-depend-id' => 'post_page_sidebar_position',
            ),
            'default'          => 'sidebar-left',
            'radio'            => true,
            'wrap_class'       => 'text-center',
            'dependency'       => array('post_page_layout|post_page_show_sidebar', 'any|==', 'extra-width,less-width|true'),
          ),
          array(
            'id'               => 'post_page_sidebar_widget',
            'type'             => 'select',
            'title'            => esc_html__('Sidebar Widget', 'seese'),
            'options'          => seese_framework_registered_sidebars(),
            'default_option'   => esc_html__('Select Widget', 'seese'),
            'dependency'       => array('post_page_layout|post_page_show_sidebar', 'any|==', 'extra-width,less-width|true'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Product
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'product_options',
    'title'     => esc_html__('Product Options', 'seese'),
    'post_type' => 'product',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'product_option_section',
        'fields' => array(

          array(
            'id'          => 'product_single_bg',
            'type'        => 'color_picker',
            'title'       => esc_html__('Product Background Color', 'seese'),
            'rgba'        => true,
            'help'        => esc_html__('This style will apply for this product on product catalog sortcodes and pages.', 'seese'),
          ),
          array(
            'id'          => 'product_masonry_size',
            'type'        => 'select',
            'title'       => esc_html__('Masonry Layout Grid Size', 'seese'),
            'options'     => array(
              'pd-wh'     => esc_html__('Default', 'seese'),
              'pdh-2w'    => esc_html__('Double Width Default Height', 'seese'),
              'pd-2wh'    => esc_html__('Double Width & Height', 'seese'),
            ),
            'default'     => 'pd-wh',
            'help'        => esc_html__('This style will apply for this product on masonry product catalog sortcodes and pages.', 'seese'),
          ),
          array(
            'id'          => 'product_hover_image_change',
            'type'        => 'switcher',
            'title'       => esc_html__('Image Change On Hover', 'seese'),
            'default'     => true,
            'help'        => esc_html__('This style will apply for this product on product catalog sortcodes and pages.', 'seese'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Testimonial
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'testimonial_options',
    'title'     => esc_html__('Testimonial Client', 'seese'),
    'post_type' => 'testimonial',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'testimonial_option_section',
        'fields' => array(

          array(
            'id'      => 'testi_name',
            'type'    => 'text',
            'title'   => esc_html__('Name', 'seese'),
            'info'    => esc_html__('Enter client name', 'seese'),
          ),
          array(
            'id'      => 'testi_name_link',
            'type'    => 'text',
            'title'   => esc_html__('Name Link', 'seese'),
            'info'    => esc_html__('Enter client name link, if you want', 'seese'),
          ),
          array(
            'id'      => 'testi_pro',
            'type'    => 'text',
            'title'   => esc_html__('Profession', 'seese'),
            'info'    => esc_html__('Enter client profession', 'seese'),
          ),
          array(
            'id'      => 'testi_pro_link',
            'type'    => 'text',
            'title'   => esc_html__('Profession Link', 'seese'),
            'info'    => esc_html__('Enter client profession link', 'seese'),
          ),

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Team
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Job Position', 'seese'),
    'post_type' => 'team',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'team_option_section',
        'fields' => array(

          array(
            'id'            => 'team_job_position',
            'type'          => 'text',
            'attributes'    => array(
              'placeholder' => esc_html__('Eg : Financial Manager', 'seese'),
            ),
            'info'          => esc_html__('Enter this employee job position, in your company.', 'seese'),
          ),
          array(
            'id'            => 'team_custom_link',
            'type'          => 'text',
            'title'         => esc_html__('Custom Link', 'seese'),
            'attributes'    => array(
              'placeholder' => esc_html__('http://', 'seese'),
            ),
            'info'          => esc_html__('Enter your custom link, if you don\'t want to show this page.', 'seese'),
          ),

        ),
      ),

    ),
  );

  return $options;

}
add_filter( 'cs_metabox_options', 'seese_metabox_options' );
