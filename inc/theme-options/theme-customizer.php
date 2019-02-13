<?php
/*
 * All customizer related options for Seese theme.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

if( ! function_exists( 'seese_framework_customizer' ) ) {
  function seese_framework_customizer( $options ) {

	$options        = array(); // remove old options

	// Primary Color
	$options[]      = array(
	  'name'        => 'elemets_color_section',
	  'title'       => esc_html__('Primary Color', 'seese'),
	  'settings'    => array(

	    // Fields Start
	    array(
			  'name'      => 'all_element_colors',
			  'default'   => '#ff4f40',
				  'control'   => array(
					  'type'  => 'color',
					  'label' => esc_html__('Elements Color', 'seese'),
					  'description'    => esc_html__('This is theme primary color, means it\'ll affect all elements that have default color of our theme primary color.', 'seese'),
				  ),
	    ),
	    // Fields End

	  )
	);
	// Primary Color

	// Preloader Color
	$options[]      = array(
	  'name'        => 'preloader_color_section',
	  'title'       => esc_html__('01. Preloader Colors', 'seese'),
	  'settings'    => array(

		// Fields Start
		array(
			'name'      => 'preloader_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Preloader Color', 'seese'),
			),
		),
		array(
			'name'      => 'preloader_bg_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Preloader Background Color', 'seese'),
			),
		),
	    // Fields End

	  )
	);
	// Primary Color

   	// Header Color
	$options[]      = array(
	  'name'        => 'header_color_section',
	  'title'       => esc_html__('02. Header Colors', 'seese'),
	  'settings'    => array(

	    // Fields Start
      array(
      'name'          => 'menubar_bg_heading',
			  'control'       => array(
				  'type'        => 'cs_field',
				  'options'     => array(
					  'type'      => 'notice',
					  'class'     => 'info',
					  'content'   => esc_html__('Menu Bar Color', 'seese'),
					),
	  		),
      ),
		array(
			'name'      => 'menubar_bg_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Background Color', 'seese'),
			),
		),

    	array(
			'name'          => 'menubar_mainmenu_heading',
			'control'       => array(
				'type'        => 'cs_field',
				'options'     => array(
					'type'      => 'notice',
					'class'     => 'info',
					'content'   => esc_html__('Main Menu Colors', 'seese'),
				),
			),
		),
		array(
			'name'      => 'mainmenu_link_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Link Color', 'seese'),
			),
		),
		array(
			'name'      => 'mainmenu_link_hover_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Link Hover Color', 'seese'),
			),
		),

		// Sub Menu Color
		array(
			'name'          => 'menubar_submenu_heading',
			'control'       => array(
				'type'        => 'cs_field',
				'options'     => array(
					'type'      => 'notice',
					'class'     => 'info',
					'content'   => esc_html__('Sub-Menu Colors', 'seese'),
				),
			),
		),
        array(
			'name'      => 'submenu_bg_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Background Color', 'seese'),
			),
		),
		array(
			'name'      => 'submenu_link_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Link Color', 'seese'),
			),
		),
		array(
			'name'      => 'submenu_link_hover_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Link Hover Color', 'seese'),
			),
		),

       	array(
			'name'          => 'title_area_heading',
			'control'       => array(
				'type'        => 'cs_field',
				'options'     => array(
					'type'      => 'notice',
					'class'     => 'info',
					'content'   => esc_html__('Title Area', 'seese'),
				),
			),
		),
        array(
			'name'      => 'title_text_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Title Text Color', 'seese'),
			),
		),
        array(
			'name'      => 'breadcrumbs_text_color',
			'control'   => array(
				'type'  => 'color',
				'label' => esc_html__('Breadcrumbs Text Color', 'seese'),
			),
		),
	    // Fields End

	  )
	);
	// Header Color

    // Content Color
	$options[]      = array(
	  'name'        => 'content_section',
	  'title'       => esc_html__('03. Content Colors', 'seese'),
	  'description' => esc_html__('This is all about content area text and heading colors.', 'seese'),
	  'sections'    => array(

	  	array(
	      'name'          => 'content_text_section',
	      'title'         => esc_html__('Content Text', 'seese'),
	      'settings'      => array(

		        // Fields Start
		        array(
		        	'name'      => 'body_color',
		        	'control'   => array(
		      			'type'  => 'color',
		      			'label' => esc_html__('Body & Content Color', 'seese'),
		        	),
		        ),
					array(
						'name'      => 'body_links_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body Links Color', 'seese'),
						),
					),
					array(
						'name'      => 'body_link_hover_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Body Links Hover Color', 'seese'),
						),
					),
					array(
						'name'      => 'sidebar_content_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Sidebar Content Color', 'seese'),
						),
					),
					    // Fields End
				  )
				),

		    // Text Colors Section
		    array(
		    'name'          => 'content_heading_section',
		    'title'         => esc_html__('Headings', 'seese'),
		    'settings'      => array(

			      	// Fields Start
					array(
						'name'      => 'content_heading_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Content Heading Color', 'seese'),
						),
					),
		    	array(
						'name'      => 'sidebar_heading_color',
						'control'   => array(
							'type'  => 'color',
							'label' => esc_html__('Sidebar Heading Color', 'seese'),
						),
					),
          // Fields End

      	  )
        ),

	  )
	);
	// Content Color

    // Footer Color
	$options[]      = array(
	  'name'        => 'footer_section',
	  'title'       => esc_html__('04. Footer Colors', 'seese'),
	  'description' => esc_html__('This is all about footer settings. Make sure you\'ve enabled your needed section at : seese > Theme Options > Footer ', 'seese'),
	  'sections'    => array(

			// Footer Widgets Block
	  	array(
	      'name'          => 'footer_widget_section',
	      'title'         => esc_html__('Widget Block', 'seese'),
	      'settings'      => array(

		    // Fields Start
            array(
		      'name'          => 'footer_widget_color_notice',
		      'control'       => array(
		        'type'        => 'cs_field',
		        'options'     => array(
		          'type'      => 'notice',
		          'class'     => 'info',
		          'content'   => esc_html__('Content Colors', 'seese'),
		        ),
		      ),
		    ),
			array(
				'name'      => 'footer_heading_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Widget Heading Color', 'seese'),
				),
			),
			array(
				'name'      => 'footer_text_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Widget Text Color', 'seese'),
				),
			),
			array(
				'name'      => 'footer_link_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Widget Link Color', 'seese'),
				),
			),
			array(
				'name'      => 'footer_link_hover_color',
				'control'   => array(
					'type'  => 'color',
					'label' => esc_html__('Widget Link Hover Color', 'seese'),
				),
			),
		    // Fields End
		  )
		),
		// Footer Widgets Block

        // Footer Copyright Block
	  	array(
	      'name'          => 'footer_copyright_section',
	      'title'         => esc_html__('Copyright Block', 'seese'),
	      'settings'      => array(

		    // Fields Start
		    array(
		      'name'          => 'footer_copyright_active',
		      'control'       => array(
		        'type'        => 'cs_field',
		        'options'     => array(
		          'type'      => 'notice',
		          'class'     => 'info',
		          'content'   => esc_html__('Make sure you\'ve enabled copyright block in : <br /> <strong>seese > Theme Options > Footer > Copyright Bar : Enable Copyright Block</strong>', 'seese'),
		        ),
		      ),
		    ),

	      array(
					'name'      => 'copyright_text_color',
					'control'   => array(
						'type'  => 'color',
						'label' => esc_html__('Text Color', 'seese'),
					),
				),
				array(
					'name'      => 'copyright_link_color',
					'control'   => array(
						'type'  => 'color',
						'label' => esc_html__('Link Color', 'seese'),
					),
				),
				array(
					'name'      => 'copyright_link_hover_color',
					'control'   => array(
						'type'  => 'color',
						'label' => esc_html__('Link Hover Color', 'seese'),
					),
				),
		  )
		),
		// Footer Copyright Block

	  )
	);
	// Footer Color

	return $options;

  }
  add_filter( 'cs_customize_options', 'seese_framework_customizer' );
}
