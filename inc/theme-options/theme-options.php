<?php
/*
 * All Theme Options for Seese theme.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

function seese_vt_settings( $settings ) {

  $settings           = array(
    'menu_title'      => SEESE_NAME . esc_html__(' Options', 'seese'),
    'menu_slug'       => sanitize_title(SEESE_NAME) . '_options',
    'menu_type'       => 'menu',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => SEESE_NAME .' <small>V-'. SEESE_VERSION .' by <a href="'. SEESE_BRAND_URL .'" target="_blank">'. SEESE_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'seese_vt_settings' );

// Theme Framework Options
function seese_framework_options( $options ) {

  $options      = array(); // remove old options

  // ------------------------------
  // Theme Brand
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_brand',
    'title'    => esc_html__('Brand', 'seese'),
    'icon'     => 'fa fa-bookmark',
    'sections' => array(

      // Brand Logo Tab
      array(
        'name'       => 'brand_logo_title',
        'title'      => esc_html__('Logo', 'seese'),
        'icon'       => 'fa fa-star',
        'fields'     => array(

          // Site Logo
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Site Logo', 'seese')
          ),
          array(
            'id'          => 'brand_logo_default',
            'type'        => 'image',
            'title'       => esc_html__('Default Logo', 'seese'),
            'info'        => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'seese'),
            'add_title'   => esc_html__('Add Logo', 'seese'),
          ),
          array(
            'id'          => 'brand_logo_retina',
            'type'        => 'image',
            'title'       => esc_html__('Retina Logo', 'seese'),
            'info'        => esc_html__('Upload your retina logo here. Recommended size is 2x from default logo.', 'seese'),
            'add_title'   => esc_html__('Add Retina Logo', 'seese'),
          ),
          array(
            'id'          => 'retina_width',
            'type'        => 'text',
            'title'       => esc_html__('Retina & Normal Logo Width', 'seese'),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'brand_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'seese'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'brand_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'seese'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),

          // WordPress Admin Logo
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('WordPress Admin Logo', 'seese')
          ),
          array(
            'id'          => 'brand_logo_wp',
            'type'        => 'image',
            'title'       => esc_html__('Login logo', 'seese'),
            'info'        => esc_html__('Upload your WordPress login page logo here.', 'seese'),
            'add_title'   => esc_html__('Add Login Logo', 'seese'),
          ),
        ) // end: fields
      ), // end: section

      // Fav
      array(
        'name'       => 'brand_fav',
        'title'      => esc_html__('Fav Icon', 'seese'),
        'icon'       => 'fa fa-anchor',
        'fields'     => array(
          // -----------------------------
          // Begin: Fav
          // -----------------------------
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Fav Icon', 'seese')
          ),
          array(
            'id'          => 'brand_fav_icon',
            'type'        => 'image',
            'title'       => esc_html__('Fav Icon', 'seese'),
            'info'        => esc_html__('Upload your site fav icon, size should be 16x16.', 'seese'),
            'add_title'   => esc_html__('Add Fav Icon', 'seese'),
          ),
          array(
            'id'          => 'iphone_icon',
            'type'        => 'image',
            'title'       => esc_html__('Apple iPhone icon', 'seese'),
            'info'        => esc_html__('Icon for Apple iPhone (57px x 57px). This icon is used for Bookmark on Home screen.', 'seese'),
            'add_title'   => esc_html__('Add iPhone Icon', 'seese'),
          ),
          array(
            'id'          => 'iphone_retina_icon',
            'type'        => 'image',
            'title'       => esc_html__('Apple iPhone retina icon', 'seese'),
            'info'        => esc_html__('Icon for Apple iPhone retina (114px x114px). This icon is used for Bookmark on Home screen.', 'seese'),
            'add_title'   => esc_html__('Add iPhone Retina Icon', 'seese'),
          ),
          array(
            'id'          => 'ipad_icon',
            'type'        => 'image',
            'title'       => esc_html__('Apple iPad icon', 'seese'),
            'info'        => esc_html__('Icon for Apple iPad (72px x 72px). This icon is used for Bookmark on Home screen.', 'seese'),
            'add_title'   => esc_html__('Add iPad Icon', 'seese'),
          ),
          array(
            'id'          => 'ipad_retina_icon',
            'type'        => 'image',
            'title'       => esc_html__('Apple iPad retina icon', 'seese'),
            'info'        => esc_html__('Icon for Apple iPad retina (144px x 144px). This icon is used for Bookmark on Home screen.', 'seese'),
            'add_title'   => esc_html__('Add iPad Retina Icon', 'seese'),
          ),

        ) // end: fields
      ), // end: section

    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Layout', 'seese'),
    'icon'   => 'fa fa-file-text'
  );

  $options[] = array(
    'name'   => 'theme_general',
    'title'  => esc_html__('General', 'seese'),
    'icon'   => 'fa fa-wrench',
    'fields' => array(
      // -----------------------------
      // Begin: Generel Options
      // -----------------------------
      array(
        'type'             => 'notice',
        'class'            => 'info cs-seese-heading',
        'content'          => esc_html__('Preloader Options', 'seese')
      ),
      array(
        'id'               => 'need_theme_preloader',
        'type'             => 'switcher',
        'default'          => true,
        'title'            => esc_html__('Preloader', 'seese'),
        'info'             => esc_html__('Turn off if you don\'t want to show preloader.', 'seese'),
      ),
      array(
        'id'               => 'theme_preloader_options',
        'type'             => 'select',
        'options'          => array(
          'ball-beat'                  => esc_html__('Ball Beat', 'seese'),
          'ball-clip-rotate'           => esc_html__('Ball Clip Rotate', 'seese'),
          'ball-clip-rotate-pulse'     => esc_html__('Ball Clip Rotate Pulse', 'seese'),
          'ball-clip-rotate-multiple'  => esc_html__('Ball Clip Rotate Multiple', 'seese'),
          'ball-grid-beat'             => esc_html__('Ball Grid Beat', 'seese'),
          'ball-grid-pulse'            => esc_html__('Ball Grid Pulse', 'seese'),
          'ball-pulse'                 => esc_html__('Ball Pulse', 'seese'),
          'ball-pulse-rise'            => esc_html__('Ball Pulse Rise', 'seese'),
          'ball-pulse-sync'            => esc_html__('Ball Pulse Sync', 'seese'),
          'ball-rotate'                => esc_html__('Ball Rotate', 'seese'),
          'ball-scale'                 => esc_html__('Ball Scale', 'seese'),
          'ball-scale-multiple'        => esc_html__('Ball Scale Multiple', 'seese'),
          'ball-scale-ripple'          => esc_html__('Ball Scale Ripple', 'seese'),
          'ball-scale-ripple-multiple' => esc_html__('Ball Scale Ripple Multiple', 'seese'),
          'ball-spin-fade-loader'      => esc_html__('Ball Spin Fade Loader', 'seese'),
          'ball-triangle-path'         => esc_html__('Ball Triangle Path', 'seese'),
          'ball-zig-zag'               => esc_html__('Ball Zig Zag', 'seese'),
          'ball-zig-zag-deflect'       => esc_html__('Ball Zig Zag Deflect', 'seese'),
          'cube-transition'            => esc_html__('Cube Transition', 'seese'),
          'line-scale'                 => esc_html__('Line Scale', 'seese'),
          'line-scale-party'           => esc_html__('Line Scale Party', 'seese'),
          'line-scale-pulse-out'       => esc_html__('Line Scale Pulse Out', 'seese'),
          'line-scale-pulse-out-rapid' => esc_html__('Line Scale Pulse Out Rapid', 'seese'),
          'line-spin-fade-loader'      => esc_html__('Line Spin Fade Loader', 'seese'),
          'pacman'                     => esc_html__('Pacman', 'seese'),
          'semi-circle-spin'           => esc_html__('Semi Circle Spin', 'seese'),
          'square-spin'                => esc_html__('Square Spin', 'seese'),
          'triangle-skew-spin'         => esc_html__('Triangle Skew Spin', 'seese'),
        ),
        'default_option'   => esc_html__('Select preloader style', 'seese'),
        'class'            => 'horizontal',
        'title'            => esc_html__('Preloader Style', 'seese'),
        'dependency'       => array( 'need_theme_preloader', '==', 'true' ),
      ),
      array(
        'type'             => 'notice',
        'class'            => 'info cs-seese-heading',
        'content'          => esc_html__('Page Options', 'seese'),
      ),
      array(
        'id'               => 'theme_page_comments',
        'type'             => 'switcher',
        'default'          => true,
        'title'            => esc_html__('Page Comments', 'seese'),
        'info'             => esc_html__('Turn off if you don\'t want to show comments in your pages.', 'seese'),
      ),
      array(
        'type'             => 'notice',
        'class'            => 'info cs-seese-heading',
        'content'          => esc_html__('Vertical Menu', 'seese')
      ),
      array(
        'id'               => 'content_left_link',
        'type'             => 'switcher',
        'title'            => esc_html__('Left Featured Link', 'seese'),
        'info'             => esc_html__('Turn off if you don\'t want to show featured link at content left position.', 'seese'),
        'default'          => true,
      ),
      array(
        'id'               => 'left_link_title',
        'type'             => 'text',
        'title'            => esc_html__('Featured Link Title', 'seese'),
        'info'             => '',
        'dependency'       => array( 'content_left_link', '==', 'true' ),
      ),
      array(
        'id'               => 'left_link_url',
        'type'             => 'text',
        'title'            => esc_html__('Featured Link URL', 'seese'),
        'info'             => '',
        'dependency'       => array( 'content_left_link', '==', 'true' ),
      ),
      array(
        'id'               => 'content_right_gototop',
        'type'             => 'switcher',
        'title'            => esc_html__('Go to Top', 'seese'),
        'info'             => __('Turn off if you don\'t want to show <strong>Go to Top</strong> at content right position.', 'seese'),
        'default'          => true,
      ),
      array(
        'type'             => 'notice',
        'class'            => 'info cs-seese-heading',
        'content'          => esc_html__('Content Background', 'seese')
      ),
      array(
        'id'               => 'content_layout_outer_bg',
        'type'             => 'background',
        'title'            => esc_html__('Outer Background', 'seese'),
        'rgba'             => true,
        'info'             => esc_html__('Content outer area background.', 'seese'),
      ),
      array(
        'id'               => 'content_overlay_outer_color',
        'type'             => 'color_picker',
        'title'            => esc_html__('Outer Overlay Color', 'seese'),
        'rgba'             => true,
        'info'             => esc_html__('Content outer area background image overlay color.', 'seese'),
      ),
      array(
        'id'               => 'content_layout_inner_bg',
        'type'             => 'background',
        'title'            => esc_html__('Inner Background', 'seese'),
        'rgba'             => true,
        'info'             => esc_html__('Content inner area background.', 'seese'),
      ),
      array(
        'id'               => 'content_overlay_inner_color',
        'type'             => 'color_picker',
        'title'            => esc_html__('Inner Overlay Color', 'seese'),
        'rgba'             => true,
        'info'             => esc_html__('Content inner area background image overlay color.', 'seese'),
      ),

    ), // end: fields
  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header', 'seese'),
    'icon'     => 'fa fa-bars',
    'sections' => array(

      // Header Menu Bar
      array(
        'name'   => 'menu_bar_tab',
        'title'  => esc_html__('Menu Bar', 'seese'),
        'icon'   => 'fa fa-minus',
        'fields' => array(

          // Menu Bar Design
          array(
            'type'       => 'notice',
            'class'      => 'info cs-seese-heading',
            'content'    => esc_html__('Menu Bar', 'seese'),
          ),
          array(
            'id'         => 'menu_bar',
            'type'       => 'switcher',
            'title'      => esc_html__('Menu Bar', 'seese'),
            'info'       => esc_html__('Turn On if you want to show menu bar.', 'seese'),
            'default'    => true,
          ),

          array(
            'type'       => 'notice',
            'class'      => 'info cs-seese-heading',
            'content'    => esc_html__('Show / Hide', 'seese'),
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'sticky_header',
            'type'       => 'switcher',
            'title'      => esc_html__('Sticky Header', 'seese'),
            'info'       => esc_html__('Turn On if you want your menu bar on sticky.', 'seese'),
            'default'    => true,
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'search_icon',
            'type'       => 'switcher',
            'title'      => esc_html__('Search Icon', 'seese'),
            'info'       => esc_html__('Turn On if you want to show search icon in menu bar.', 'seese'),
            'default'    => true,
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'heart_icon',
            'type'       => 'switcher',
            'title'      => esc_html__('Heart Icon', 'seese'),
            'info'       => esc_html__('Turn On if you want to show heart icon in menu bar.', 'seese'),
            'default'    => true,
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'cart_widget',
            'type'       => 'switcher',
            'title'      => esc_html__('Cart Widget', 'seese'),
            'info'       => esc_html__('Turn On if you want to show cart widget in menu bar. Make sure about installation/activation of WooCommerce plugin.', 'seese'),
            'default'    => true,
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'login_my_account',
            'type'       => 'switcher',
            'title'      => esc_html__('Login/My Account', 'seese'),
            'info'       => esc_html__('Turn On if you want to show login/my-account in menu bar. Make sure about installation/activation of WooCommerce plugin.', 'seese'),
            'default'    => true,
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'wpml',
            'type'       => 'switcher',
            'title'      => esc_html__('WPML', 'seese'),
            'info'       => esc_html__('Turn On if you want to show WPML translator in menu bar. Make sure about installation/activation of WPML plugins.', 'seese'),
            'default'    => false,
            'dependency' => array('menu_bar', '==', 'true'),
          ),
          array(
            'id'         => 'wpml_shortcode',
            'type'       => 'textarea',
            'title'      => esc_html__('WPML Shortcode', 'seese'),
            'info'       => esc_html__('Include WPML shortcode here.', 'seese'),
            'shortcode'  => true,
            'dependency' => array( 'wpml', '==', 'true' ),
          ),
          array(
            'id'         => 'mobile_breakpoint',
            'type'       => 'text',
            'title'      => esc_html__('Mobile Menu Starts from?', 'seese'),
            'attributes' => array( 'placeholder' => '767' ),
            'info'       => esc_html__('Just put numeric value only. Like : 767. Don\'t use px or any other units.', 'seese'),
            'dependency' => array( 'menu_bar', '==', 'true' ),
          ),

          array(
            'type'       => 'notice',
            'class'      => 'info cs-seese-heading',
            'content'    => esc_html__('Column Layouts', 'seese'),
          ),
          array(
            'id'               => 'logo_column_layout',
            'type'             => 'select',
            'title'            => esc_html__('Select Column for Logo', 'seese'),
            'options'      => array(
                '1/12'  => esc_html__('1 Column', 'seil'),
                '1/5'   => esc_html__('2 Columns', 'seil'),
                '1/4'   => esc_html__('3 Columns', 'seil'),
                '1/3'   => esc_html__('4 Columns', 'seil'),
                '5/12'  => esc_html__('5 Columns', 'seil'),
                '1/2'   => esc_html__('6 Columns', 'seil'),
                '7/12'  => esc_html__('7 Columns', 'seil'),
                '2/3'   => esc_html__('8 Columns', 'seil'),
                '3/4'   => esc_html__('9 Columns', 'seil'),
                '5/6'   => esc_html__('10 Columns', 'seil'),
                '11/12' => esc_html__('11 Columns', 'seil'),
                '12/12' => esc_html__('12 Columns', 'seil'),
              ),
            'default_option'   => 'Select column',
            'info'       => esc_html__('Total 12 columns. If you select column 3 for logo, then only 9 will be avilable for menu & icons.so you can choose 7 for menu And 2 for icons', 'seese'),
          ),
          array(
            'id'               => 'menu_column_layout',
            'type'             => 'select',
            'title'            => esc_html__('Select Column for Menu', 'seese'),
            'options'      => array(
                '1/12'  => esc_html__('1 Column', 'seil'),
                '1/5'   => esc_html__('2 Columns', 'seil'),
                '1/4'   => esc_html__('3 Columns', 'seil'),
                '1/3'   => esc_html__('4 Columns', 'seil'),
                '5/12'  => esc_html__('5 Columns', 'seil'),
                '1/2'   => esc_html__('6 Columns', 'seil'),
                '7/12'  => esc_html__('7 Columns', 'seil'),
                '2/3'   => esc_html__('8 Columns', 'seil'),
                '3/4'   => esc_html__('9 Columns', 'seil'),
                '5/6'   => esc_html__('10 Columns', 'seil'),
                '11/12' => esc_html__('11 Columns', 'seil'),
                '12/12' => esc_html__('12 Columns', 'seil'),
              ),
            'default_option'   => 'Select column',
          ),
          array(
            'id'               => 'icon_column_layout',
            'type'             => 'select',
            'title'            => esc_html__('Select Column for Icons', 'seese'),
            'options'      => array(
                '1/12'  => esc_html__('1 Column', 'seil'),
                '1/5'   => esc_html__('2 Columns', 'seil'),
                '1/4'   => esc_html__('3 Columns', 'seil'),
                '1/3'   => esc_html__('4 Columns', 'seil'),
                '5/12'  => esc_html__('5 Columns', 'seil'),
                '1/2'   => esc_html__('6 Columns', 'seil'),
                '7/12'  => esc_html__('7 Columns', 'seil'),
                '2/3'   => esc_html__('8 Columns', 'seil'),
                '3/4'   => esc_html__('9 Columns', 'seil'),
                '5/6'   => esc_html__('10 Columns', 'seil'),
                '11/12' => esc_html__('11 Columns', 'seil'),
                '12/12' => esc_html__('12 Columns', 'seil'),
              ),
            'default_option'   => 'Select column',
          ),

        )
      ),

      // header banner
      array(
        'name'   => 'header_banner_tab',
        'title'  => esc_html__('Title Area', 'seese'),
        'icon'   => 'fa fa-bullhorn',
        'fields' => array(

          // Title Area
          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Title Area', 'seese')
          ),
          array(
            'id'               => 'title_bar',
            'type'             => 'switcher',
            'title'            => esc_html__('Title Area', 'seese'),
            'label'            => esc_html__('If you want to show title area, please turn this ON.', 'seese'),
            'default'          => true,
          ),
          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Layout', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_layout',
            'type'             => 'image_select',
            'title'            => esc_html__('Width', 'seese'),
            'options'          => array(
              'extra-width'    => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'     => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'       => array(
              'data-depend-id' => 'title_area_layout',
            ),
            'radio'            => true,
            'default'          => 'extra-width',
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_text_color',
            'type'             => 'color_picker',
            'title'            => esc_html__('Title Color', 'seese'),
            'rgba'             => true,
            'info'             => esc_html__('Title text color.', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_spacings',
            'type'             => 'select',
            'title'            => esc_html__('Spacings', 'seese'),
            'options'          => array(
              'seese-padding-none'   => esc_html__('Default Spacing', 'seese'),
              'seese-padding-xs'     => esc_html__('Extra Small Padding', 'seese'),
              'seese-padding-sm'     => esc_html__('Small Padding', 'seese'),
              'seese-padding-md'     => esc_html__('Medium Padding', 'seese'),
              'seese-padding-lg'     => esc_html__('Large Padding', 'seese'),
              'seese-padding-xl'     => esc_html__('Extra Large Padding', 'seese'),
              'seese-padding-custom' => esc_html__('Custom Padding', 'seese'),
            ),
            'label'            => esc_html__('Title area top and bottom spacings.', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_top_spacings',
            'type'             => 'text',
            'title'            => esc_html__('Top Spacing', 'seese'),
            'attributes'       => array(
              'placeholder'    => '100px',
            ),
            'dependency'       => array('title_bar|title_area_spacings', '==|==', 'true|seese-padding-custom'),
          ),
          array(
            'id'               => 'title_bottom_spacings',
            'type'             => 'text',
            'title'            => esc_html__('Bottom Spacing', 'seese'),
            'attributes'       => array(
              'placeholder'    => '100px',
            ),
            'dependency'       => array('title_bar|title_area_spacings', '==|==', 'true|seese-padding-custom'),
          ),

          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Background', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_outer_bg',
            'type'             => 'background',
            'title'            => esc_html__('Outer Background', 'seese'),
            'rgba'             => true,
            'info'             => esc_html__('Title outer area background.', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_outer_overlay',
            'type'             => 'color_picker',
            'title'            => esc_html__('Outer Overlay Color', 'seese'),
            'rgba'             => true,
            'info'             => esc_html__('Title outer area background image overlay color.', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_inner_bg',
            'type'             => 'background',
            'title'            => esc_html__('Inner Background', 'seese'),
            'rgba'             => true,
            'info'             => esc_html__('Title inner area background.', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_inner_overlay',
            'type'             => 'color_picker',
            'title'            => esc_html__('Inner Overlay Color', 'seese'),
            'rgba'             => true,
            'info'             => esc_html__('Title inner area background image overlay color.', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Breadcrumbs', 'seese'),
            'dependency'       => array('title_bar', '==', 'true'),
          ),
          array(
            'id'               => 'title_area_breadcrumb',
            'type'             => 'switcher',
            'title'            => esc_html__('Breadcrumbs', 'seese'),
            'label'            => esc_html__('If you want Breadcrumbs in your title area, please turn this ON.', 'seese'),
            'default'          => true,
            'dependency'       => array('title_bar', '==', 'true'),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer', 'seese'),
    'icon'     => 'fa fa-ellipsis-h',
    'sections' => array(

      // Footer General Options
      array(
        'name'   => 'footer_general_tab',
        'title'  => esc_html__('General Options', 'seese'),
        'icon'   => 'fa fa-gear',
        'fields' => array(

          array(
            'type'          => 'notice',
            'class'         => 'info cs-seese-heading',
            'content'       => esc_html__('General Options', 'seese'),
          ),
          array(
            'id'            => 'footer_top_block',
            'type'          => 'switcher',
            'title'         => esc_html__('Top Widget Block', 'seese'),
            'default'       => true,
            'info'          => __('If you turn this ON, then Goto : Appearance > Widgets. you can see <strong>Footer Top Widget</strong> there.', 'seese'),
          ),
          array(
            'id'            => 'footer_layout_bg',
            'type'          => 'background',
            'title'         => esc_html__('Background', 'seese'),
            'info'          => esc_html__('Select a image or color to change footer area background.', 'seese'),
          ),
          array(
            'id'            => 'footer_bg_overlay_color',
            'type'          => 'color_picker',
            'title'         => esc_html__('Overlay Color', 'seese'),
            'rgba'          => true,
            'info'          => esc_html__('Select a color to set overlay for selected background image above.', 'seese'),
          ),
        )
      ),

      // Footer Main Widgets
      array(
        'name'   => 'footer_widgets_tab',
        'title'  => esc_html__('Widget Area', 'seese'),
        'icon'   => 'fa fa-th',
        'fields' => array(

          // Footer Widget Block
          array(
            'type'          => 'notice',
            'class'         => 'info cs-seese-heading',
            'content'       => esc_html__('Widget Block', 'seese')
          ),
          array(
            'id'            => 'footer_widget_block',
            'type'          => 'switcher',
            'title'         => esc_html__('Main Widget Block', 'seese'),
            'default'       => true,
            'info'          => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'seese'),
          ),
          array(
            'id'            => 'footer_widget_layout',
            'type'          => 'image_select',
            'title'         => esc_html__('Widget Layouts', 'seese'),
            'info'          => esc_html__('Choose your footer widget layouts.', 'seese'),
            'default'       => 1,
            'options'       => array(
              1   => SEESE_CS_IMAGES . '/footer/footer-1.png',
              2   => SEESE_CS_IMAGES . '/footer/footer-2.png',
              3   => SEESE_CS_IMAGES . '/footer/footer-3.png',
              4   => SEESE_CS_IMAGES . '/footer/footer-4.png',
              5   => SEESE_CS_IMAGES . '/footer/footer-5.png',
              6   => SEESE_CS_IMAGES . '/footer/footer-6.png',
              7   => SEESE_CS_IMAGES . '/footer/footer-7.png',
              8   => SEESE_CS_IMAGES . '/footer/footer-8.png',
              9   => SEESE_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'         => true,
            'dependency'    => array('footer_widget_block', '==', true),
          ),
        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Area', 'seese'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'          => 'notice',
            'class'         => 'info cs-seese-heading',
            'content'       => esc_html__('Copyright Layout', 'seese'),
          ),
          array(
            'id'            => 'need_copyright',
            'type'          => 'switcher',
            'title'         => esc_html__('Enable Copyright Section', 'seese'),
            'default'       => true,
          ),
          array(
            'id'            => 'footer_copyright_layout',
            'type'          => 'image_select',
            'title'         => esc_html__('Select Copyright Layout', 'seese'),
            'info'          => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'seese'),
            'default'       => 'copyright-1',
            'options'       => array(
              'copyright-1' => SEESE_CS_IMAGES .'/footer/copyright-layout-1.png',
              'copyright-2' => SEESE_CS_IMAGES .'/footer/copyright-layout-2.png',
              'copyright-3' => SEESE_CS_IMAGES .'/footer/copyright-layout-3.png',
            ),
            'radio'         => true,
            'dependency'    => array('need_copyright', '==', 'true'),
          ),
          array(
            'id'            => 'copyright_text',
            'type'          => 'textarea',
            'title'         => esc_html__('Copyright Text', 'seese'),
            'shortcode'     => true,
            'dependency'    => array('need_copyright', '==', 'true'),
            'after'         => 'Helpful shortcodes: [seese_current_year] [seese_home_url] or any shortcode.',
          ),
          array(
            'type'          => 'notice',
            'class'         => 'info cs-seese-heading',
            'content'       => esc_html__('Copyright Secondary Text', 'seese'),
            'dependency'    => array('need_copyright', '==', 'true'),
          ),
          array(
            'id'            => 'secondary_text',
            'type'          => 'textarea',
            'title'         => esc_html__('Secondary Text', 'seese'),
            'shortcode'     => true,
            'dependency'    => array('need_copyright', '==', 'true'),
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Design', 'seese'),
    'icon'   => 'fa fa-magic'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'seese'),
    'icon'     => 'fa fa-eyedropper',
    'fields'   => array(

      array(
        'type'       => 'heading',
        'content'    => esc_html__('Color Options', 'seese'),
      ),
      array(
        'type'       => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content'    => __('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer.
          <br /><br />Highly customizable colors are in <strong>Appearance > Customize</strong>', 'seese'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'seese'),
    'icon'     => 'fa fa-header',
    'fields'   => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'seese'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'seese'),
            'info'            => __('Enter css selectors like : <strong>body, .custom-class</strong>', 'seese'),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'seese'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'seese'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'seese'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'seese'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'seese'),
        'accordion_title'     => esc_html__('New Typography', 'seese'),
        'default'             => array(
           array(
            'title'           => esc_html__('Body Typography', 'seese'),
            'selector'        => 'body, .woocommerce .seese_single_product_excerpt p,#tab-description p,.woocommerce-Reviews .description p',
            'font'            => array(
              'family'        => 'Raleway',
              'variant'       => 'regular',
            ),
            'size'            => '14px',
            'line_height'     => '1.42857143',
          ),
          array(
            'title'           => esc_html__('Logo Typography', 'seese'),
            'selector'        => '.seese-header .seese-logo a',
            'font'            => array(
              'family'        => 'Changa',
              'variant'       => '600',
            ),
            'size'            => '28px',
            'line_height'     => '23px',
          ),
          array(
            'title'           => esc_html__('Menu Typography', 'seese'),
            'selector'        => '.seese-mainmenu ul li a, #seese-mobilemenu .slicknav_nav li a',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '500',
            ),
            'size'            => '12px',
          ),
          array(
            'title'           => esc_html__('Sub Menu Typography', 'seese'),
            'selector'        => '#seese-mobilemenu .slicknav_nav li a.seese-title-menu,.seese-mainmenu ul li a.seese-title-menu,.seese-mainmenu ul li.seese-megamenu > ul > li > a:link,.seese-mainmenu ul li.seese-megamenu > ul > li > a:active,.seese-mainmenu ul li.seese-megamenu > ul > li > a:visited',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '600',
            ),
            'size'            => '13px',
          ),
          array(
            'title'           => esc_html__('Headings Typography', 'seese'),
            'selector'        => '.woocommerce .variations label,.woocommerce p.woocommerce-result-count,.seese-single-team .seese-team-member-name,.woocommerce p.stock.out-of-stock,.seese-load-more-controls.seese-btn-mode .seese-btn,.woocommerce .group_table td del .woocommerce-Price-amount,.woocommerce .group_table td.label a,.woocommerce table.shop_table_responsive tr td:before, .woocommerce-page table.shop_table_responsive tr td:before,.seese-single-product-share .container > a,.woocommerce-Tabs-panel .comment_container .meta strong,.seese-product-summary-col .entry-summary ins .woocommerce-Price-amount,h1, h2, h3, h4, h5, h6,.seese-aside h2,.seese-aside .widget_shopping_cart_content .buttons a,.seese-specialPage a,.seese-gototop a,.modal-content input[type="search"],.seese-filterTabs li a,.seese-footer .widget_nav_menu li a,.seese-contentCol h1, .seese-contentCol h2, .seese-contentCol h3, .seese-contentCol h4, .seese-contentCol h5, .seese-contentCol h6,.seese-contentCol .seese-publish li a,.single .seese-article strong,.seese-sharebar .sharebox a,.seese-author .author-content a,.seese-author .author-content label,.seese-commentbox h3.comment-reply-title,.seese-commentbox h3.comments-title,.seese-readmore a,.seese-sidebar h2.widget-title,.seese-team-box .seese-team-info .seese-lift-up .member-name a,.seese-team-box .seese-team-info .seese-lift-up .member-name,.seese-testi-name a,.seese-testi-name,.woocommerce-checkout .checkout_coupon .form-row-last input[type="submit"],.woocommerce-checkout .login input[type="submit"],.woocommerce table strong,.woocommerce table th,.woocommerce-checkout-review-order-table strong,.woocommerce-checkout-review-order-table th,.cart-empty,.woocommerce-message,.woocommerce ul.products li a.added_to_cart.wc-forward,.woocommerce ul.products li a.button,.seese-dropcap,.seese-form-order-filter select,.seese-content-area .seese-result-count p,.page-numbers a,.page-numbers span.current,.wp-pagenavi span.current,.wp-pagenavi a,.seese-product-summary-col .entry-summary .woocommerce-Price-amount.amount',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '500',
            ),
          ),
          array(
            'title'           => esc_html__('Light Heading Typography', 'seese'),
            'selector'        => '.slick-slider .seese-prslr-content .seese-prslr-price,.seese-product-summary-col .product_meta span,.seese-sidebar .seese-recent-blog .boxright label,.seese-sidebar .tagcloud a,.seese-sidebar th,.seese-sidebar td,.seese-testi-name:before,.seese-testi-name:after,.woocommerce textarea,.woocommerce input[type="tel"],.woocommerce input[type="text"],.woocommerce input[type="password"],.woocommerce input[type="email"],.woocommerce input[type="url"],.woocommerce .select2-container .select2-choice,.woocommerce-checkout .checkout_coupon input[type="text"],.woocommerce-checkout .login input[type="password"],.woocommerce-checkout .login input[type="text"],.track_order input[type="text"],.woocommerce-ResetPassword input[type="text"],.seese-containerWrap #seese-woo-register-wrap input[type="email"],.seese-containerWrap #seese-woo-login-wrap input[type="url"],.seese-containerWrap #seese-woo-login-wrap textarea,.seese-containerWrap #seese-woo-login-wrap input[type="email"],.seese-containerWrap #seese-woo-login-wrap input[type="search"],.seese-containerWrap #seese-woo-login-wrap input[type="text"],.seese-containerWrap #seese-woo-login-wrap input[type="password"],.woocommerce-checkout .woocommerce-info,#ship-to-different-address .checkbox,#ship-to-different-address .input-checkbox,.woocommerce-checkout-payment label',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '300',
            ),
          ),
          array(
            'title'           => esc_html__('Semi Bold Heading Typography', 'seese'),
            'selector'        => '.seese-sidebar h2.widget-title a,.up-sells.products h2,.related.products h2,.woocommerce p.cart-empty,#review_form h3.comment-reply-title,.wc-tabs-wrapper .wc-tabs li a,.seese-product-summary-col .quantity input,.seese-contentCol h1.product_title,button,.button,.vc_btn3-container a.vc_general,.seese-blog-pagination a,.seese-btn,input[type="submit"],input[type="button"],.seese-filterOptions h3,.wpcf7-form input[type="submit"],.seese-cntr-box .cntr-value,.seese-cntr-box .cntr-title,.slick-slider .seese-prslr-content .seese-prslr-shopNow-title a',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '600',
            ),
          ),
          array(
            'title'           => esc_html__('Bold Heading Typography', 'seese'),
            'selector'        => '.seese-bottomboxes h4,.seese-contentCol strong,.seese-contentCol h1.post-heading,.seese-title-area .page-title,.track_order h2,.seese-containerWrap #seese-woo-register-wrap h2,.seese-containerWrap #seese-woo-login-wrap h2,.woocommerce-checkout .checkout_coupon input[type="submit"],.woocommerce-checkout .login input[type="submit"],.track_order input[type="submit"],.woocommerce-ResetPassword input[type="submit"],.seese-containerWrap #seese-woo-register-wrap .seese-btn#seese-show-login-button,.seese-containerWrap #seese-woo-register-wrap input[type="submit"],.seese-containerWrap #seese-woo-login-wrap .seese-btn,.seese-containerWrap #seese-woo-login-wrap input[type="submit"],.form-row.place-order input[type="submit"]',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => '700',
            ),
          ),
          array(
            'title'           => esc_html__('Shortcode Elements Primary Font', 'seese'),
            'selector'        => '.slick-slider .seese-prslr-content .seese-prslr-title,.woocommerce td, .woocommerce th, .woocommerce-checkout-review-order-table td, .woocommerce-checkout-review-order-table th,.seese-filterOptions li span,.price_slider_amount .price_label,.woocommerce ul.products li.product-category h3,.seese-custom-badge,.seese-product-image-col .onsale,.woocommerce ul.products li span.onsale,.seese-product-summary-col .entry-summary del .woocommerce-Price-amount,.woocommerce div.product .woocommerce-product-rating a,.seese-cat-masonry .seese-cat-masonry-text .seese-cat-masonry-name,.seese-aside .product_list_widget li a,.seese-aside .product_list_widget li .quantity,.seese-aside .widget_shopping_cart_content .total,.seese-aside .widget_shopping_cart_content .total strong,.seese-filterOptions li a,.seese-copyright,.seese-sidebar .comment-publish label,.wpcf7-form select,.wpcf7-form input,.wpcf7-form textarea,input[type="date"],input[type="tel"],input[type="number"],.woocommerce .select2-container .select2-choice,input[type="password"],select,input[type="url"],textarea,input[type="email"],input[type="search"],input[type="text"],.tagbox .taglist a,.seese-pagination a .seese-label,.seese-pagination a .post-name,.breadcrumbs li,.wp-pagenavi span.pages,.seese-sidebar,.seese-sidebar li,.seese-sidebar li a,.seese-sidebar .widget_categories li a,.seese-sidebar .seese-recent-blog .boxright h4 a,.seese-sidebar table,.woocommerce ul.products .seese-product-cnt .price,.woocommerce ul.products .seese-product-cnt h3,.woocommerce p,.woocommerce-checkout .checkout_coupon p,.woocommerce-checkout .login p,.track_order p,.woocommerce-ResetPassword p,.seese-containerWrap #seese-woo-register-wrap form.register p,.seese-containerWrap #seese-woo-login-wrap form.login p,.woocommerce label,.woocommerce-checkout .checkout_coupon label,.woocommerce-checkout .login label,.track_order label,.woocommerce-ResetPassword label,.seese-containerWrap #seese-woo-register-wrap form.register label,.seese-containerWrap #seese-woo-login-wrap form.login label,.seese-containerWrap #seese-woo-login-wrap form.login .woocommerce-LostPassword a,.seese-containerWrap .seese-login-form-divider span,.woocommerce ul.products .seese-product-cnt .price,.woocommerce ul.products .seese-product-cnt h3,.seese-catslr-box .seese-catslr-text .seese-catslr-name,.seese-catdt-box .seese-catdt-text .seese-catdt-name',
            'font'            => array(
              'family'        => 'Poppins',
              'variant'       => 'regular',
            ),
          ),
          array(
            'title'           => esc_html__('Shortcode Elements Secondary Font', 'seese'),
            'selector'        => '.seese-single-team .seese-team-member-job,.woocommerce-Tabs-panel .comment_container .meta time,.seese-cat-masonry .seese-cat-masonry-text .seese-cat-masonry-desc,.seese-bottomboxes .subtitle,blockquote,.seese-contentCol .seese-publish li,.comment-wrapper .comments-date,.seese-commentbox .date,.comment-wrapper .comments-date .comments-reply a,.seese-sidebar .comment-publish span,.seese-cntr-box .cntr-details,.seese-team-box .seese-team-info .seese-lift-up .member-job,.seese-team-box .seese-team-text em,.seese-testi-pro a,.seese-testi-pro,address,.woocommerce ul.products li .seese-product-cnt .seese-posted-in-cats .seese-single-cat a,.woocommerce ul.products li .seese-product-cnt .seese-posted-in-cats .seese-single-cat a,.slick-slider .seese-prslr-content .seese-prslr-desc,.seese-catslr-box .seese-catslr-text .seese-catslr-desc,.seese-catdt-box .seese-catdt-text .seese-catdt-desc',
            'font'            => array(
              'family'        => 'Lora',
              'variant'       => 'italic',
            ),
          ),
          array(
            'title'           => esc_html__('Example Usage', 'seese'),
            'selector'        => '.your-custom-class',
            'font'            => array(
              'family'        => 'Lato',
              'variant'       => 'regular',
            ),
          ),

        ),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'seese'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'          => array(
          'data-placeholder'  => 'Subsets',
          'multiple'          => 'multiple',
          'style'             => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'seese'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => 'Thin 100',
          '100i'  => 'Thin 100 Italic',
          '200'   => 'Extra Light 200',
          '200i'  => 'Extra Light 200 Italic',
          '300'   => 'Light 300',
          '300i'  => 'Light 300 Italic',
          '400'   => 'Regular 400',
          '400i'  => 'Regular 400 Italic',
          '500'   => 'Medium 500',
          '500i'  => 'Medium 500 Italic',
          '600'   => 'Semi Bold 600',
          '600i'  => 'Semi Bold 600 Italic',
          '700'   => 'Bold 700',
          '700i'  => 'Bold 700 Italic',
          '800'   => 'Extra Bold 800',
          '800i'  => 'Extra Bold 800 Italic',
          '900'   => 'Black 900',
          '900i'  => 'Black 900 Italic',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Font Weight',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'            => array( '400', '500', '600' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'seese'),
        'button_title'       => esc_html__('Add New Custom Font', 'seese'),
        'accordion_title'    => esc_html__('Adding New Font', 'seese'),
        'accordion'          => true,
        'desc'               => 'It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!',
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'seese'),
            'attributes'     => array(
              'placeholder'  => 'for eg. Arial'
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => 'Upload .ttf <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.ttf</i>',
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => 'Upload .eot <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.eot</i>',
            ),
          ),

          array(
            'id'             => 'svg',
            'type'           => 'upload',
            'title'          => 'Upload .svg <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.svg</i>',
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => 'Upload .otf <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.otf</i>',
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => 'Upload .woff <small><i>(optional)</i></small>',
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => 'Use this Font-Format',
              'button_title' => 'Upload <i>.woff</i>',
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => 'Extra CSS Style <small><i>(optional)</i></small>',
            'attributes'     => array(
              'placeholder'  => 'for eg. font-weight: normal;'
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Pages', 'seese'),
    'icon'   => 'fa fa-files-o'
  );

  // ------------------------------
  // Team Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'team_section',
    'title'    => esc_html__('Team', 'seese'),
    'icon'     => 'fa fa-users',
    'fields' => array(

      // Team Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-seese-heading',
        'content' => esc_html__('Team Single', 'seese')
      ),
      array(
        'id'               => 'team_page_layout',
        'type'             => 'image_select',
        'title'            => esc_html__('Page Layout', 'seese'),
        'options'          => array(
          'extra-width'    => SEESE_CS_IMAGES . '/page-layout-1.png',
          'less-width'     => SEESE_CS_IMAGES . '/page-layout-2.png',
        ),
        'attributes'       => array(
          'data-depend-id' => 'team_page_layout',
        ),
        'radio'            => true,
        'default'          => 'extra-width',
      ),
      array(
        'id'               => 'team_spacings',
        'type'             => 'select',
        'title'            => esc_html__('Spacings', 'seese'),
        'options'          => array(
          'seese-padding-none'   => esc_html__('Default Spacing', 'seese'),
          'seese-padding-xs'     => esc_html__('Extra Small Padding', 'seese'),
          'seese-padding-sm'     => esc_html__('Small Padding', 'seese'),
          'seese-padding-md'     => esc_html__('Medium Padding', 'seese'),
          'seese-padding-lg'     => esc_html__('Large Padding', 'seese'),
          'seese-padding-xl'     => esc_html__('Extra Large Padding', 'seese'),
          'seese-padding-custom' => esc_html__('Custom Padding', 'seese'),
        ),
        'label'            => esc_html__('Title single page top and bottom spacings.', 'seese'),
      ),
      array(
        'id'               => 'team_top_spacing',
        'type'             => 'text',
        'title'            => esc_html__('Top Spacing', 'seese'),
        'info'             => esc_html__('Enter value in px, for team single pages top value.', 'seese'),
        'attributes'       => array(
          'placeholder'    => '100px',
        ),
        'dependency'       => array('team_spacings', '==|==', 'seese-padding-custom'),
      ),
      array(
        'id'               => 'team_bottom_spacing',
        'type'             => 'text',
        'title'            => esc_html__('Bottom Spacing', 'seese'),
        'info'             => esc_html__('Enter value in px, for team single pages bottom value.', 'seese'),
        'attributes'       => array(
          'placeholder'    => '100px',
        ),
        'dependency'       => array('team_spacings', '==|==', 'seese-padding-custom'),
      ),
      // Team End

    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog', 'seese'),
    'icon'     => 'fa fa-edit',
    'sections' => array(

      // blog general section
      array(
        'name'   => 'blog_general_tab',
        'title'  => esc_html__('General', 'seese'),
        'icon'   => 'fa fa-cog',
        'fields' => array(

          // Layout
          array(
            'type'            => 'notice',
            'class'           => 'info cs-seese-heading',
            'content'         => esc_html__('Layout', 'seese')
          ),
          array(
            'id'              => 'blog_page_layout',
            'type'            => 'image_select',
            'title'           => esc_html__('Page Layout', 'seese'),
            'options'         => array(
              'extra-width'   => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'    => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'      => array(
              'data-depend-id' => 'blog_page_layout',
            ),
            'radio'           => true,
            'default'         => 'extra-width',
            'help'            => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author. If this settings will not apply your blog page, please set that page as a post page in Settings > Readings.', 'seese'),
          ),
          array(
            'id'              => 'blog_listing_style',
            'type'            => 'select',
            'title'           => esc_html__('Blog Style', 'seese'),
            'options'         => array(
              'style-one'     => esc_html__('Standard', 'seese'),
              'style-two'     => esc_html__('Masonry', 'seese'),
            ),
            'default_option'  => 'Select blog style',
            'info'            => esc_html__('Default option : Standard', 'seese'),
            'help'            => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author. If this settings will not apply your blog page, please set that page as a post page in Settings > Readings.', 'seese'),
          ),
          array(
            'id'              => 'blog_listing_columns',
            'type'            => 'select',
            'title'           => esc_html__('Blog Columns', 'seese'),
            'options'         => array(
              'seese-blog-col-1' => esc_html__('Column One', 'seese'),
              'seese-blog-col-2' => esc_html__('Column Two', 'seese'),
              'seese-blog-col-3' => esc_html__('Column Three', 'seese')
            ),
            'default_option'  => 'Select blog column',
            'help'            => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'seese'),
            'info'            => esc_html__('Default option : Column One', 'seese'),
          ),
          array(
            'id'              => 'blog_sidebar_position',
            'type'            => 'select',
            'title'           => esc_html__('Sidebar Position', 'seese'),
            'options'         => array(
              'sidebar-right' => esc_html__('Right', 'seese'),
              'sidebar-left'  => esc_html__('Left', 'seese'),
              'sidebar-hide'  => esc_html__('Hide', 'seese'),
            ),
            'default_option'  => 'Select sidebar position',
            'help'            => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'seese'),
            'info'            => esc_html__('Default option : Right', 'seese'),
          ),
          array(
            'id'              => 'blog_widget',
            'type'            => 'select',
            'title'           => esc_html__('Sidebar Widget', 'seese'),
            'options'         => seese_framework_registered_sidebars(),
            'default_option'  => esc_html__('Select Widget', 'seese'),
            'dependency'      => array('blog_sidebar_position', '!=', 'sidebar-hide'),
            'help'            => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'seese'),
            'info'            => esc_html__('Default option : Main Widget', 'seese'),
          ),
          array(
            'id'              => 'blog_pagination_style',
            'type'            => 'select',
            'title'           => esc_html__('Pagination Style', 'seese'),
            'options'         => array(
              'pagination_number'  => esc_html__('Page Numbers', 'seese'),
              'pagination_nextprv' => esc_html__('Next/Previous', 'seese'),
              'pagination_btn'     => esc_html__('Load More', 'seese'),
            ),
            'default_option'  => 'Select pagination style',
            'help'            => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'seese'),
            'info'            => esc_html__('Default option : Page Numbers', 'seese'),
          ),
          // Layout

          // Enable / Disable
          array(
            'type'            => 'notice',
            'class'           => 'info cs-seese-heading',
            'content'         => esc_html__('Enable / Disable', 'seese')
          ),
          array(
            'id'              => 'blog_read_more_option',
            'type'            => 'switcher',
            'title'           => esc_html__('Read More', 'seese'),
            'info'            => esc_html__('If need to hide read more option on blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'blog_popup_option',
            'type'            => 'switcher',
            'title'           => esc_html__('Popup Option', 'seese'),
            'info'            => esc_html__('If need to disable image popup on blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'blog_metas_hide',
            'type'            => 'checkbox',
            'title'           => esc_html__('Meta\'s to hide', 'seese'),
            'info'            => esc_html__('Check items you want to hide from blog meta field.', 'seese'),
            'class'           => 'horizontal',
            'options'         => array(
              'category'      => esc_html__('Category', 'seese'),
              'date'          => esc_html__('Date', 'seese'),
              'author'        => esc_html__('Author', 'seese'),
            ),
          ),
          // Enable / Disable

          // Global Options
          array(
            'type'            => 'notice',
            'class'           => 'info cs-seese-heading',
            'content'         => esc_html__('Global Options', 'seese')
          ),
          array(
            'id'              => 'blog_exclude_categories',
            'type'            => 'checkbox',
            'title'           => esc_html__('Exclude Categories', 'seese'),
            'info'            => esc_html__('Select categories you want to exclude from blog page.', 'seese'),
            'options'         => 'categories',
          ),
          array(
            'id'              => 'blog_excerpt_length',
            'type'            => 'text',
            'title'           => esc_html__('Excerpt Length', 'seese'),
            'info'            => esc_html__('Blog short content length, in blog listing pages.', 'seese'),
            'default'         => '55',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'seese'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-seese-heading',
            'content' => esc_html__('Layout', 'seese')
          ),
          array(
            'id'              => 'single_page_layout',
            'type'            => 'image_select',
            'title'           => esc_html__('Page Layout', 'seese'),
            'options'         => array(
              'extra-width'   => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'    => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'      => array(
              'data-depend-id' => 'single_page_layout',
            ),
            'radio'           => true,
            'default'         => 'extra-width',
          ),
          array(
            'id'              => 'single_sidebar_position',
            'type'            => 'select',
            'title'           => esc_html__('Sidebar Position', 'seese'),
            'options'         => array(
              'sidebar-right' => esc_html__('Right', 'seese'),
              'sidebar-left'  => esc_html__('Left', 'seese'),
              'sidebar-hide'  => esc_html__('Hide', 'seese'),
            ),
            'default_option'  => 'Select sidebar position',
            'info'            => esc_html__('Default option : Right', 'seese'),
          ),
          array(
            'id'              => 'single_blog_widget',
            'type'            => 'select',
            'title'           => esc_html__('Sidebar Widget', 'seese'),
            'options'         => seese_framework_registered_sidebars(),
            'default_option'  => esc_html__('Select Widget', 'seese'),
            'dependency'      => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'            => esc_html__('Default option : Main Widget Area', 'seese'),
          ),
          // End fields

          // Start fields
          array(
            'type'            => 'notice',
            'class'           => 'info cs-seese-heading',
            'content'         => esc_html__('Enable / Disable', 'seese')
          ),
          array(
            'id'              => 'single_featured_image',
            'type'            => 'switcher',
            'title'           => esc_html__('Featured Image/Gallery/Audio/Video', 'seese'),
            'info'            => esc_html__('If need to hide featured image from single blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'single_popup_option',
            'type'            => 'switcher',
            'title'           => esc_html__('Popup Option', 'seese'),
            'info'            => esc_html__('If need to disable image popup on single blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'single_author_info',
            'type'            => 'switcher',
            'title'           => esc_html__('Author Info', 'seese'),
            'info'            => esc_html__('If need to hide author info on single blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'single_share_option',
            'type'            => 'switcher',
            'title'           => esc_html__('Share Option', 'seese'),
            'info'            => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'single_comment_form',
            'type'            => 'switcher',
            'title'           => esc_html__('Comment Area/Form', 'seese'),
            'info'            => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'seese'),
            'default'         => true,
          ),
          array(
            'id'              => 'single_metas_hide',
            'type'            => 'checkbox',
            'title'           => esc_html__('Meta\'s to hide', 'seese'),
            'info'            => esc_html__('Check items you want to hide from single blog page meta field.', 'seese'),
            'class'           => 'horizontal',
            'options'         => array(
              'category'      => esc_html__('Category', 'seese'),
              'tag'           => esc_html__('Tags', 'seese'),
              'date'          => esc_html__('Date', 'seese'),
              'author'        => esc_html__('Author', 'seese'),
            ),
          )

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )) {

  // ------------------------------
  // WooCommerce Section
  // ------------------------------

  $options[] = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'seese'),
    'icon'     => 'fa fa-shopping-cart',
    'sections' => array(

      //Shop Related Options
      array(
        'name'   => 'shop_tab',
        'title'  => esc_html__('Shop', 'seese'),
        'icon'   => 'fa fa-shopping-cart',
        'fields' => array(

          // Start Fields
          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Layout', 'seese')
          ),
          array(
            'id'               => 'woo_page_layout',
            'type'             => 'image_select',
            'title'            => esc_html__('Page Layout', 'seese'),
            'options'          => array(
              'extra-width'    => SEESE_CS_IMAGES . '/page-layout-1.png',
              'less-width'     => SEESE_CS_IMAGES . '/page-layout-2.png',
            ),
            'attributes'       => array(
              'data-depend-id' => 'woo_page_layout',
            ),
            'radio'            => true,
            'default'          => 'extra-width',
            'help'             => esc_html__('This style will apply, default woocommerce listings pages. Like, shop and archive pages.', 'seese'),
          ),
          array(
            'id'               => 'woo_product_columns',
            'type'             => 'select',
            'title'            => esc_html__('Product Column', 'seese'),
            'options'          => array(
              3 => esc_html__('Three Column', 'seese'),
              4 => esc_html__('Four Column', 'seese'),
              5 => esc_html__('Five Column', 'seese'),
            ),
            'default_option'   => esc_html__('Select product columns', 'seese'),
            'info'             => esc_html__('Default option : Four Column', 'seese'),
            'help'             => esc_html__('This style will apply, default woocommerce listings pages. Like, shop and archive pages.', 'seese'),
          ),
          array(
            'id'               => 'woo_sidebar_position',
            'type'             => 'select',
            'title'            => esc_html__('Sidebar Position', 'seese'),
            'options'          => array(
              'sidebar-right'  => esc_html__('Right', 'seese'),
              'sidebar-left'   => esc_html__('Left', 'seese'),
              'sidebar-hide'   => esc_html__('Hide', 'seese'),
            ),
            'default_option'   => esc_html__('Select sidebar position', 'seese'),
            'info'             => esc_html__('Default option : Right', 'seese'),
            'help'             => esc_html__('This style will apply, default woocommerce listings pages. Like, shop and archive pages.', 'seese'),
          ),
          array(
            'id'               => 'woo_widget',
            'type'             => 'select',
            'title'            => esc_html__('Sidebar Widget', 'seese'),
            'options'          => seese_framework_registered_sidebars(),
            'default_option'   => esc_html__('Select widget', 'seese'),
            'dependency'       => array('woo_sidebar_position', '!=', 'sidebar-hide'),
            'info'             => esc_html__('Default option : Shop Widget', 'seese'),
            'help'             => esc_html__('This style will apply, default woocommerce listings pages. Like, shop and archive pages.', 'seese'),
          ),
          array(
            'id'               => 'woo_load_style',
            'type'             => 'select',
            'title'            => esc_html__('Pagination Style', 'seese'),
            'options'          => array(
              'load_button'    => esc_html__('Load More', 'seese'),
              'prev_next'      => esc_html__('Next/Previous', 'seese'),
              'page_number'    => esc_html__('Page Number', 'seese'),
            ),
            'default_option'   => 'Select pagination style',
            'info'             => esc_html__('Default option : Load More', 'seese'),
            'help'             => esc_html__('This style will apply, default woocommerce listings pages. Like, shop and archive pages.', 'seese'),
          ),
          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Listing', 'seese')
          ),
          array(
            'id'               => 'theme_woo_limit',
            'type'             => 'text',
            'title'            => esc_html__('Product Limit', 'seese'),
            'info'             => esc_html__('Enter the number value for per page products limit.', 'seese'),
          ),

          // Enable / Disable
          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Enable / Disable', 'seese')
          ),
          array(
            'id'               => 'woo_lazy_load',
            'type'             => 'select',
            'title'            => esc_html__('Image Lazy Load', 'seese'),
            'options'          => array(
              'seese-dload-none'  => esc_html__('Select Disable Type', 'seese'),
              'seese-dload-full'  => esc_html__('Disable On Full Site', 'seese'),
              'seese-dload-small' => esc_html__('Disable On Small Screen', 'seese'),
            ),
            'help'             => esc_html__('Select product image lazy load option.', 'seese'),
          ),
          array(
            'id'               => 'woo_dload_size',
            'type'             => 'text',
            'title'            => esc_html__( 'Lazy Load Starts Form?', 'seese' ),
            'dependency'       => array('woo_lazy_load', '==', 'seese-dload-small'),
            'info'             => esc_html__('Just put numeric value only. Don\'t use px or any other units. Default option : 767.', 'seese'),
          ),
          array(
            'id'               => 'woo_hover_image',
            'type'             => 'switcher',
            'title'            => esc_html__('Image Change Hover Effect', 'seese'),
            'info'             => esc_html__('If you don\'t want \'image change animation on hover\' on each product, please turn this OFF.', 'seese'),
            'default'          => true,
          ),
          array(
            'id'               => 'woo_sort_filter',
            'type'             => 'switcher',
            'title'            => esc_html__('Sorting Dropdown', 'seese'),
            'info'             => esc_html__('Turn On if you want to show sorting dropdown filter.', 'seese'),
            'default'          => true,
          ),
          array(
            'id'               => 'woo_result_count',
            'type'             => 'switcher',
            'title'            => esc_html__('Product Count', 'seese'),
            'info'             => esc_html__('Turn On if you want to show product result count.', 'seese'),
            'default'          => true,
          ),

          array(
            'type'             => 'notice',
            'class'            => 'info cs-seese-heading',
            'content'          => esc_html__('Category Filter', 'seese')
          ),
          array(
            'id'               => 'woo_cat_filter',
            'type'             => 'switcher',
            'title'            => esc_html__('Filter', 'seese'),
            'info'             => esc_html__('Turn On if you want to show category filter.', 'seese'),
            'default'          => true,
          ),
          array(
            'id'               => 'woo_hide_empty',
            'type'             => 'switcher',
            'title'            => esc_html__('Show Empty', 'seese'),
            'info'             => esc_html__('Turn On if you want to show empty categories.', 'seese'),
            'default'          => false,
          ),
          array(
            'id'               => 'woo_cat_parent',
            'type'             => 'switcher',
            'title'            => esc_html__('Parents', 'seese'),
            'info'             => esc_html__('Turn On if you want to show only top level categories.', 'seese'),
            'default'          => true,
          ),
          array(
            'id'               => 'woo_order_cat',
            'type'             => 'select',
            'title'            => esc_html__('Order', 'seese'),
            'options'          => array(
              'ASC'            => esc_html__('Ascending', 'seese'),
              'DESC'           => esc_html__('Descending', 'seese'),
            ),
            'default_option'   => 'Select order',
          ),
          array(
            'id'               => 'woo_orderby_cat',
            'type'             => 'select',
            'title'            => esc_html__('Orderby', 'seese'),
            'options'          => array(
              'ID'             => esc_html__('ID', 'seese'),
              'name'           => esc_html__('Name', 'seese'),
              'count'          => esc_html__('Count', 'seese'),
            ),
            'default_option'   => 'Select orderby',
          ),
          // End Fields

        ),
      ),

      //Shop Single Product Options
      array(
        'name'   => 'shop_single_product_tab',
        'title'  => esc_html__('Single Product', 'seese'),
        'icon'   => 'fa fa-shopping-cart',
        'fields' => array(

          // Start Fields
          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Layout', 'seese')
          ),
          array(
            'id'             => 'woo_singlevrl_nav',
            'type'           => 'switcher',
            'title'          => esc_html__('Vertical Menu', 'seese'),
            'info'           => esc_html__('If you don\'t want \'Vertical Menu Links\' in single product page, please turn this OFF.', 'seese'),
            'default'        => false,
          ),
          array(
            'id'             => 'woo_single_nav',
            'type'           => 'switcher',
            'title'          => esc_html__('Product Navigation', 'seese'),
            'info'           => esc_html__('If you don\'t want \'Product Navigation\' in single product page, please turn this OFF.', 'seese'),
            'default'        => true,
          ),
          array(
            'id'             => 'woo_single_modal',
            'type'           => 'switcher',
            'title'          => esc_html__('Image Modal Gallery', 'seese'),
            'info'           => esc_html__('If you don\'t want modal gallery for full-size product images in single product page, please turn this OFF.', 'seese'),
            'default'        => true,
          ),

          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Social Share', 'seese')
          ),
          array(
            'id'             => 'woo_single_share',
            'type'           => 'switcher',
            'title'          => esc_html__('Share Buttons', 'seese'),
            'info'           => esc_html__('If you don\'t want \'Social Share Buttons\' in single product page, please turn this OFF.', 'seese'),
            'default'        => true,
          ),
          array(
            'id'             => 'woo_single_share_hide',
            'type'           => 'checkbox',
            'title'          => esc_html__('Share Buttons to Hide', 'seese'),
            'info'           => esc_html__('Check buttons you want to hide from single product social share.', 'seese'),
            'class'          => 'horizontal',
            'options'        => array(
              'twitter'      => esc_html__('Twitter', 'seese'),
              'facebook'     => esc_html__('Facebook', 'seese'),
              'googleplus'   => esc_html__('Google+', 'seese'),
              'linkedin'     => esc_html__('LinkedIn', 'seese'),
              'pinterest'    => esc_html__('Pinterest', 'seese'),
            ),
          ),

          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Up-Sells Products', 'seese')
          ),
          array(
            'id'             => 'woo_single_upsell',
            'type'           => 'switcher',
            'title'          => esc_html__('Up-Sells Products', 'seese'),
            'info'           => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this OFF.', 'seese'),
            'default'        => false,
          ),
          array(
            'id'             => 'woo_upsell_limit',
            'type'           => 'text',
            'title'          => esc_html__('Up-Sells Products Limit', 'seese'),
            'dependency'     => array('woo_single_upsell', '==', 'true'),
          ),
          array(
            'id'             => 'woo_upsell_columns',
            'type'           => 'select',
            'title'          => esc_html__('Up-Sells Products Column', 'seese'),
            'options'        => array(
              3              => esc_html__('Three Column', 'seese'),
              4              => esc_html__('Four Column', 'seese'),
              5              => esc_html__('Five Column', 'seese'),
            ),
            'info'           => esc_html__('Default option : Five Column', 'seese'),
            'default_option' => esc_html__('Select product columns', 'seese'),
            'dependency'     => array('woo_single_upsell', '==', 'true'),
          ),

          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Related Products', 'seese')
          ),
          array(
            'id'             => 'woo_single_related',
            'type'           => 'switcher',
            'title'          => esc_html__('Related Products', 'seese'),
            'info'           => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this OFF.', 'seese'),
            'default'        => true,
          ),
          array(
            'id'             => 'woo_related_limit',
            'type'           => 'text',
            'title'          => esc_html__('Related Products Limit', 'seese'),
            'dependency'     => array('woo_single_related', '==', 'true'),
          ),
          array(
            'id'             => 'woo_related_load_style',
            'type'           => 'select',
            'title'          => esc_html__('Related Products Style', 'seese'),
            'options'        => array(
              'default'      => esc_html__('Default', 'seese'),
              'slider'       => esc_html__('Slider', 'seese'),
            ),
            'info'           => esc_html__('Default option : Default', 'seese'),
            'default_option' => 'Select product style',
            'dependency'     => array('woo_single_related', '==', 'true'),
          ),
          array(
            'id'             => 'woo_related_columns',
            'type'           => 'select',
            'title'          => esc_html__('Related Products Column', 'seese'),
            'options'        => array(
              3              => esc_html__('Three Column', 'seese'),
              4              => esc_html__('Four Column', 'seese'),
              5              => esc_html__('Five Column', 'seese'),
            ),
            'info'           => esc_html__('Default option : Five Column', 'seese'),
            'default_option' => esc_html__('Select product columns', 'seese'),
            'dependency'     => array('woo_single_related', '==', 'true'),
          ),
          array(
            'id'             => 'woo_related_sl_loop',
            'type'           => 'switcher',
            'title'          => esc_html__('Slider Loop', 'seese'),
            'info'           => esc_html__('If you don\'t want loop for slider products, please turn this OFF.', 'seese'),
            'default'        => false,
            'dependency'     => array('woo_single_related|woo_related_load_style', '==|==', 'true|slider' ),
          ),
          array(
            'id'             => 'woo_related_slider_nav',
            'type'           => 'switcher',
            'title'          => esc_html__('Slider Next/Prev Buttons', 'seese'),
            'info'           => esc_html__('If you don\'t want to show slider next/prev buttons, please turn this OFF.', 'seese'),
            'default'        => true,
            'dependency'     => array('woo_single_related|woo_related_load_style', '==|==', 'true|slider' ),
          ),
          array(
            'id'             => 'woo_related_slider_dots',
            'type'           => 'switcher',
            'title'          => esc_html__('Slider Dots Pagination', 'seese'),
            'info'           => esc_html__('If you don\'t want to show slider dots, please turn this OFF.', 'seese'),
            'default'        => true,
            'dependency'     => array('woo_single_related|woo_related_load_style', '==|==', 'true|slider' ),
          ),
          array(
            'id'             => 'woo_related_slider_autoplay',
            'type'           => 'switcher',
            'title'          => esc_html__('Slider Autoplay', 'seese'),
            'info'           => esc_html__('If you don\'t want slider autoplay, please turn this OFF.', 'seese'),
            'default'        => false,
            'dependency'     => array('woo_single_related|woo_related_load_style', '==|==', 'true|slider' ),
          ),

          // End Fields
        ),
      ),

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('Extra Pages', 'seese'),
    'icon'     => 'fa fa-clone',
    'sections' => array(

      // error 404 page
      array(
        'name'      => 'error_page_section',
        'title'     => esc_html__('404 Page', 'seese'),
        'icon'      => 'fa fa-exclamation-triangle',
        'fields'    => array(

          // Start 404 Page
          array(
            'id'             => 'error_heading',
            'type'           => 'text',
            'title'          => esc_html__('404 Page Heading', 'seese'),
            'info'           => esc_html__('Enter 404 page heading.', 'seese'),
          ),
          array(
            'id'             => 'error_page_content',
            'type'           => 'textarea',
            'title'          => esc_html__('404 Page Content', 'seese'),
            'info'           => esc_html__('Enter 404 page content.', 'seese'),
            'shortcode'      => true,
          ),
          array(
            'id'             => 'error_btn_text',
            'type'           => 'text',
            'title'          => esc_html__('Button Text', 'seese'),
            'info'           => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'seese'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'               => 'maintenance_mode_section',
        'title'              => esc_html__('Maintenance Mode', 'seese'),
        'icon'               => 'fa fa-hourglass-half',
        'fields'             => array(

          // Start Maintenance Mode
          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => __('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'seese')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'seese'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'seese'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'seese'),
            'dependency'     => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'seese'),
            'dependency'     => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[]  = array(
    'name'    => 'theme_advanced',
    'title'   => esc_html__('Advanced', 'seese'),
    'icon'    => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Misc', 'seese'),
    'icon'     => 'fa fa-recycle',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'seese'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'seese'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'seese'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'seese'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'seese'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'seese'),
            'accordion_title' => esc_html__('New Sidebar', 'seese'),
            'default'             => array(
               array(
                'sidebar_name'     => esc_html__('Shop Filter Sidebar Widget', 'seese'),
                'sidebar_desc'     => esc_html__('Appears on shop page sidebar.', 'seese'),
              ),
            ),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'seese'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(

          // Start Custom CSS/JS
          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Custom CSS', 'seese')
          ),
          array(
            'id'             => 'theme_custom_css',
            'type'           => 'textarea',
            'attributes'     => array(
              'rows'         => 10,
              'placeholder'  => esc_html__('Enter your CSS code here...', 'seese'),
            ),
          ),

          array(
            'type'           => 'notice',
            'class'          => 'info cs-seese-heading',
            'content'        => esc_html__('Custom JS', 'seese')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes'     => array(
              'rows'         => 10,
              'placeholder'  => esc_html__('Enter your JS code here...', 'seese'),
            ),
          ),
          // End Custom CSS/JS

        )
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'seese'),
        'icon'        => 'fa fa-language',

        // Begin: Fields
        'fields'      => array(
          // Blog Texts
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Blog Layouts', 'seese')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'seese'),
          ),
          // Blog Pagination Texts
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Blog Pagination', 'seese')
          ),
          array(
            'id'          => 'lmore_post_text',
            'type'        => 'text',
            'title'       => esc_html__('Load More Text', 'seese'),
          ),
          array(
            'id'          => 'older_post_text',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'seese'),
          ),
          array(
            'id'          => 'newer_post_text',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'seese'),
          ),
          // Single Post Texts
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Single Post', 'seese')
          ),
           array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'seese'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'seese'),
          ),
          // Comment Area/Form
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Single Post Comment Area / Form', 'seese')
          ),
          array(
            'id'          => 'comment_singular_text',
            'type'        => 'text',
            'title'       => esc_html__('Comment Singular Text', 'seese'),
          ),
          array(
            'id'          => 'comment_plural_text',
            'type'        => 'text',
            'title'       => esc_html__('Comment Plural Text', 'seese'),
          ),
          array(
            'id'          => 'no_comments_text',
            'type'        => 'text',
            'title'       => esc_html__('No Comments Text', 'seese'),
          ),
          array(
            'id'          => 'comment_form_title_text',
            'type'        => 'text',
            'title'       => esc_html__('Title Reply Text', 'seese'),
          ),
          array(
            'id'          => 'comment_form_reply_to_text',
            'type'        => 'text',
            'title'       => esc_html__('Title Reply To Text', 'seese'),
          ),
          array(
            'id'          => 'comment_field_text',
            'type'        => 'text',
            'title'       => esc_html__('Comment Field Text', 'seese'),
          ),
          array(
            'id'          => 'name_field_text',
            'type'        => 'text',
            'title'       => esc_html__('Name Field Text', 'seese'),
          ),
          array(
            'id'          => 'email_field_text',
            'type'        => 'text',
            'title'       => esc_html__('Email Field Text', 'seese'),
          ),
          array(
            'id'          => 'reply_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Reply Text [Reply Button]', 'seese'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'seese'),
          ),
          // Single Post Pagination
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Single Post Pagination', 'seese')
          ),
          array(
            'id'          => 'previous_post',
            'type'        => 'text',
            'title'       => esc_html__('Previous Post Text', 'seese'),
          ),
          array(
            'id'          => 'next_post',
            'type'        => 'text',
            'title'       => esc_html__('Next Post Text', 'seese'),
          ),
          // Comment Pagination
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Comment Pagination', 'seese')
          ),
          array(
            'id'          => 'previous_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Previous Comment Text', 'seese'),
          ),
          array(
            'id'          => 'next_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Next Comment Text', 'seese'),
          ),
          // Single Shop Texts
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Single Product', 'seese')
          ),
           array(
            'id'          => 'product_share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'seese'),
          ),
          array(
            'id'          => 'product_share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'seese'),
          ),
          // Shop Pagination
          array(
            'type'        => 'notice',
            'class'       => 'info cs-seese-heading',
            'content'     => esc_html__('Shop Pagination', 'seese')
          ),
          array(
            'id'          => 'lmore_shop_text',
            'type'        => 'text',
            'title'       => esc_html__('Load More Products Text', 'seese'),
          ),
          array(
            'id'          => 'older_shop_text',
            'type'        => 'text',
            'title'       => esc_html__('Older Products Text', 'seese'),
          ),
          array(
            'id'          => 'newer_shop_text',
            'type'        => 'text',
            'title'       => esc_html__('Newer Products Text', 'seese'),
          ),
          // End Translation
        ) // end: fields
      ),

    ),
  );

  // ------------------------------
  // envato account
  // ------------------------------
  $options[]   = array(
    'name'     => 'envato_account_section',
    'title'    => esc_html__('Envato Account', 'seese'),
    'icon'     => 'fa fa-link',
    'fields'   => array(

      array(
        'type'           => 'notice',
        'class'          => 'warning',
        'content'        => esc_html__('Enter your Username and API key. You can get update our themes from WordPress admin itself.', 'seese'),
      ),
      array(
        'id'             => 'themeforest_username',
        'type'           => 'text',
        'title'          => esc_html__('Envato Username', 'seese'),
      ),
      array(
        'id'             => 'themeforest_api',
        'type'           => 'text',
        'title'          => esc_html__('Envato API Key', 'seese'),
        'class'          => 'text-security',
        'after'          => __('<p>This is not a password field. Enter your Envato API key, which is located in : <strong>http://themeforest.net/user/[YOUR-USER-NAME]/api_keys/edit</strong></p>', 'seese')
      ),

    )
  );

  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => esc_html__('Backup', 'seese'),
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'          => 'notice',
        'class'         => 'warning',
        'content'       => esc_html__('You can save your current options. Download a Backup and Import.', 'seese'),
      ),
      array(
        'type'          => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'seese_framework_options' );
