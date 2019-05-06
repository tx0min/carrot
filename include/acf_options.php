<?php


/* register acf options */

		
if( function_exists('acf_add_local_field_group') ):
	
	if(!acf_enabled()) add_filter('acf/settings/show_admin', '__return_false');
	
	//THEME GLOBAL SETTINGS
	acf_add_options_sub_page(array(
		'title' => __('Theme Settings',THEME_NAME ),
		'menu' => __('Theme Settings',THEME_NAME ),
		'slug' => 'theme-options',
		'parent_slug' => 'carrot_theme_settings',
		'capability' => 'manage_options'
	));

	acf_add_local_field_group(array (
		'key' => 'group_theme_settings',
		'title' => __('Theme Settings',THEME_NAME ),
		'fields' => array (
			/*array (
				'key' => 'settings_tab_social',
				'label' => __('Social Networks', THEME_NAME ),
				'type' => 'tab',
				//'placement' => 'left',
				
			),
			array (
				'key' => 'settings_redes_sociales',
				'label' => __('Social Networks', THEME_NAME ),
				'name' => 'redes_sociales',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array (
					0 => 'group_social_networks',
				),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),*/
			array (
				'key' => 'settings_tab_advanced',
				'label' => __('Settings', THEME_NAME ),
				'type' => 'tab',
				
			),
			array (
				'key' => 'field_57d05466193e9',
				'label' => __('Enable Advanced Custom Fields Admin Page',THEME_NAME ),
				'name' => 'enable_acf',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => 'separator',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
			)
			
			
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-options',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'left',
		'instruction_placement' => 'field',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));



	//SOCIAL NETWORK (TO USE AS CLONE)
	acf_add_local_field_group(array (
		'key' => 'group_social_networks',
		'title' => __('Social Networks', THEME_NAME ),
		'fields' => array (
			array (
				'key' => 'field_website',
				'label' => 'Web',
				'name' => 'web',
				'type' => 'url',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_email',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'email',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_social_facebook',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'url',
				'instructions' => __('Enter the full URL of the Facebook page or profile.', THEME_NAME ),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_social_twitter',
				'label' => 'Twitter',
				'name' => 'twitter',
				'type' => 'text',
				'instructions' => __('Enter the Twitter username, with the preceding @.', THEME_NAME ),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array (
				'key' => 'field_social_instagram',
				'label' => 'Instagram',
				'name' => 'instagram',
				'type' => 'text',
				'instructions' => __('Enter the Instagram username, with the preceding @.', THEME_NAME ),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array (
				'key' => 'field_social_linkedin',
				'label' => 'LinkedIn',
				'name' => 'linkedin',
				'type' => 'text',
				'instructions' => __('Enter the full URL of the LinkedIn profile.', THEME_NAME ),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array (
				'key' => 'field_social_wikipedia',
				'label' => 'Wikipedia',
				'name' => 'wikipedia',
				'type' => 'text',
				'instructions' => __('Enter the full URL of the Wikipedia page.', THEME_NAME ),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'dummy',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	
	
	
	//VIDEO GALLERY (TO CLONE)

	acf_add_local_field_group(array (
		'key' => 'group_video_gallery',
		'title' => __('Video Gallery', THEME_NAME ),
		'fields' => array (
			array (
				'label' => __('Videos', THEME_NAME),
				'key' => 'field_videos',
				'name' => 'videos',
				'type' => 'repeater',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_show_videos',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'collapsed' => 'video_title',
				'button_label' => __('Add Video', THEME_NAME),
				'sub_fields' => array (
					array (
						'label' => __('Video Title', THEME_NAME),
						'name' => 'video_title',
						'type' => 'text'
					),
					array (
						'label' => __('Video URL', THEME_NAME),
						'name' => 'video_url',
						'type' => 'url',
						'instructions' => __('Youtube or Vimeo video URL', THEME_NAME),
					),
					array (
						'label' => __('Grid columns',THEME_NAME),
						'name' => 'grid_cols',
						'instructions' => __('For videos displayed in grids',THEME_NAME),
						'type' => 'number',
						'default_value' => 1,
						'min' => 1,
						'max' => 6,
						'step' => 1
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'dummy',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	
	//IMAGE GALLERY (TO USE AS CLONE)
	acf_add_local_field_group(array (
		'key' => 'group_image_gallery',
		'title' => __('Image Gallery', THEME_NAME ),
		'fields' => array (
		
			array (
				'label' => __("Images",THEME_NAME),
				'key' => 'field_gallery',
				'name' => 'images',
				'type' => 'gallery',
				'instructions' => '',
				'required' => 0,
				
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'preview_size' => 'thumbnail',
				'insert' => 'append',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'label' => __('Layout', THEME_NAME),
				'key' => 'field_disposition',
				'name' => 'disposition',
				'type' => 'select',
				'required' => 0,
				
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'vscroll' => __('Vertical',THEME_NAME),
					//'hscroll' => __('Horizontal', THEME_NAME),
					'grid' => __('Grid', THEME_NAME) ,
					//'mosaic' => 'Mosaic de miniatures de diferent mida',
					'slider' => __('Slider', THEME_NAME),
				),
				'default_value' => array (
					0 => 'horizontal',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'label' => __('Columns', THEME_NAME),
				'key' => 'field_columns',
				'name' => 'columns',
				'type' => 'number',
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'grid',
						)
						
					)
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				
				'default_value' => 3,
				'allow_null' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'label' => __('Autoplay', THEME_NAME),
				'key' => 'field_autoplay',
				'name' => 'autoplay',
				'type' => 'true_false',
				'default_value' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Loop', THEME_NAME),
				'key' => 'field_loop',
				'name' => 'loop',
				'type' => 'true_false',
				'default_value' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Pause on hover', THEME_NAME),
				'key' => 'field_pause_on_hover',
				'name' => 'pause_on_hover',
				'type' => 'true_false',
				'default_value' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Enable dragging', THEME_NAME),
				'key' => 'field_drag',
				'name' => 'drag',
				'type' => 'true_false',
				'default_value' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Show navigation', THEME_NAME),
				'key' => 'field_show_navigation',
				'name' => 'show_navigation',
				'type' => 'true_false',
				'default_value' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Show Pagination', THEME_NAME),
				'key' => 'field_show_pager',
				'name' => 'show_pager',
				'type' => 'true_false',
				'default_value' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Articles per page', THEME_NAME),
				'key' => 'field_articles_to_show',
				'name' => 'articles_to_show',
				'type' => 'number',
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				'default_value' => 3,
				
			),
			array (
				'label' => __('Articles per page in small devices', THEME_NAME),
				'key' => 'field_articles_to_show_responsive',
				'name' => 'articles_to_show_responsive',
				'type' => 'number',
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				'default_value' => 1,
				
			),

			array (
				'label' => __('Cycle by page', THEME_NAME),
				'key' => 'field_page_slide',
				'name' => 'page_slide',
				'description' => __( 'If there is more than one item per page and this option is checked, navigation will cycle the whole page. Otherwise it will cycle by item.', THEME_NAME ),
				'type' => 'true_false',
				'default_value' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				
			),
			array (
				'label' => __('Effect', THEME_NAME),
				'key' => 'field_slide_effect',
				'name' => 'slide_effect',
				'type' => 'select',
				'required' => 0,
				'choices' => array(
					'none' => __( 'No effect', THEME_NAME ),
					'fade' => __( 'Fade', THEME_NAME ),
					'slide-h' => __( 'Slide Horizontal', THEME_NAME ),
					'slide-v' => __( 'Slide Vertical', THEME_NAME ),
					'flip-h' => __( 'Flip Horizontal', THEME_NAME ),
					'flip-v' => __( 'Flip Vertical', THEME_NAME ),
					'zoom' => __( 'Zoom', THEME_NAME )
				),
				'default_value' => array (
					0 => 'none',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				)
			),
			
			array (
				'label' => __('Slider timeout', THEME_NAME),
				'description' => __( 'Time between slides (in miliseconds)', THEME_NAME ),
				'key' => 'field_slide_timeout',
				'name' => 'slide_timeout',
				'type' => 'number',
				'min' => 0,
				'max' => 10000,
				'step' => 100,
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				'default_value' => 5000,
				
			),

			array (
				'label' => __('Slide speed', THEME_NAME),
				'description' => __( 'Slide transition speed (in miliseconds)', THEME_NAME ),
				'key' => 'field_slide_speed',
				'name' => 'slide_speed',
				'type' => 'number',
				'min' => 0,
				'max' => 10000,
				'step' => 50,
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				),
				'default_value' => 600,
				
			),

			array (
				'label' => __('Vertical Align', THEME_NAME),
				'key' => 'field_valign',
				'name' => 'valign',
				'type' => 'select',
				'required' => 0,
				'choices' => array(
					'top' => __( 'Top align', THEME_NAME ),
					'center' => __( 'Center align', THEME_NAME ),
					'bottom' => __( 'Bottom align', THEME_NAME )
				),
				'default_value' => array (
					0 => 'top',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_disposition',
							'operator' => '==',
							'value' => 'slider',
						)
						
					)
				)
			),
			array (
				'label' => __('Gutter', THEME_NAME),
				'key' => 'field_gutter',
				'name' => 'gutter',
				'type' => 'select',
				'required' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => carrot_availableGaps(),
				'default_value' => array (
					0 => 'small',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'label' => __('Thumbnail size', THEME_NAME),
				'key' => 'field_thumbsize',
				'name' => 'thumbsize',
				'type' => 'select',
				'required' => 0,
				'conditional_logic' =>0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => carrot_get_thumbsizes_dropdown(),
				'default_value' => array (
					0 => 'large',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_lightbox',
				'label' => __('Use lightbox',THEME_NAME ),
				'name' => 'lightbox',
				'type' => 'true_false',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
			),
			array (
				'key' => 'field_bordered',
				'label' => __('Images border',THEME_NAME ),
				'name' => 'bordered',
				'type' => 'true_false',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 0,
			)/*,
			array (
				'key' => 'field_title_lightbox',
				'label' => __('Show image title in lightbox',THEME_NAME ),
				'name' => 'title_lightbox',
				'type' => 'true_false',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_lightbox',
							'operator' => '==',
							'value' => '1',
						)
					),
				),
				'default_value' => 0,
			)*/
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'dummy',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
	
	//add grid size to single images
	acf_add_local_field_group(array (
		'key' => 'group_image_fields',
		'title' => 'Image',
		'fields' => array (
			/*array (
				'key' => 'field_grid_rows',
				'label' => __('Grid rows',THEME_NAME),
				'name' => 'grid_rows',
				'instructions' => __('For images displayed in grids',THEME_NAME),
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'readonly' => 0,
				'disabled' => 0,
			),*/
			array (
				'key' => 'field_grid_cols',
				'label' => __('Grid columns',THEME_NAME),
				'name' => 'grid_cols',
				'instructions' => __('For images displayed in grids',THEME_NAME),
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'attachment',
					'operator' => '==',
					'value' => 'all',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	// SINGLE PAGE THEME OPTIONS
	acf_add_local_field_group(array (
		'key' => 'group_574d36c57a8fa',
		'title' => 'Page Options',
		'fields' => array (
			array (
				'key' => 'field_sidebar_display',
				'label' => __('Sidebar display', THEME_NAME ),
				'name' => 'sidebar_display',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'no' => esc_attr__( 'No sidebar', THEME_NAME ),
					'left' => esc_attr__( 'Left sidebar', THEME_NAME ),
					'right' => esc_attr__( 'Right sidebar', THEME_NAME ),
					'bottom' => esc_attr__( 'Bottom bar', THEME_NAME )
				),
				'default_value' => array (
					0 => 'no_sidebar',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_sidebar_columns',
				'label' => __('Sidebar Columns', THEME_NAME ),
				'name' => 'sidebar_columns',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 3,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'readonly' => 0,
				'disabled' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_sidebar_display',
							'operator' => '==',
							'value' => 'bottom',
						),
					),
				),
			),
			array (
				'key' => 'field_page_display_options',
				'label' => __('Page display options', THEME_NAME ),
				'name' => 'page_display_options',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'default' => __('Site Defaults', THEME_NAME ),
					'custom' => __('Custom options for this page', THEME_NAME ),
				),
				'default_value' => array (
					0 => 'default',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_page_custom_display_options',
				'label' => __('Custom display options', THEME_NAME ),
				'name' => 'page_custom_display_options',
				'type' => 'checkbox',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'show_header' => __('Show Header', THEME_NAME ),
					'sticky_header' => __('Sticky Header', THEME_NAME ),
					'show_title' => __('Show Page Title', THEME_NAME ),
					'show_breadcrumb' => __('Show Breadcrumb', THEME_NAME ),
					'show_footer' => __('Show Footer', THEME_NAME ),
				),
				'default_value' => array (
					0 => 'show_header',
					1 => 'sticky_header',
					2 => 'show_title',
					3 => 'show_breadcrumb',
					4 => 'show_footer',
				),
				'layout' => 'vertical',
				'toggle' => 0,
			),
			array (
				'key' => 'field_header_layout',
				'label' => __('Header Layout',THEME_NAME ),
				'name' => 'header_layout',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array (
					'width' => '100%',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'normal' => __('Default header',THEME_NAME ),
					'page' => __('Selected header',THEME_NAME ),
				),
				'default_value' => array (
					0 => 'normal',
				),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_custom_display_options',
							'operator' => '==',
							'value' => 'show_header',
						),
						array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
					),
				),
				
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			
			array (
				'key' => 'field_page_header',
				'label' => 'Selected header',
				'name' => 'page_header',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array (
					'width' => '100%',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'block',
				),
				'taxonomy' => array (
				),
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_custom_display_options',
							'operator' => '==',
							'value' => 'show_header',
						),
						array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
						array (
							'field' => 'field_header_layout',
							'operator' => '==',
							'value' => 'page',
						),
					),
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
			array (
				'key' => 'field_sticky_header_layout',
				'label' => __('Sticky Header Style',THEME_NAME ),
				'name' => 'sticky_header_layout',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_custom_display_options',
							'operator' => '==',
							'value' => 'sticky_header',
						),
						array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'normal' => __('Default sticky header',THEME_NAME ),
					'page' => __('Selected sticky header',THEME_NAME ),
				),
				'default_value' => array (
					0 => 'normal',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			
			array (
				'key' => 'field_page_sticky_header',
				'label' => 'Selected sticky header',
				'name' => 'page_sticky_header',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_custom_display_options',
							'operator' => '==',
							'value' => 'sticky_header',
						),array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
						array (
							'field' => 'field_sticky_header_layout',
							'operator' => '==',
							'value' => 'page',
						),
					),
				),
				
				'wrapper' => array (
					'width' => '100%',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'block',
				),
				'taxonomy' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
			
	
			array (
				'key' => 'field_footer_layout',
				'label' => __('Footer Layout',THEME_NAME ),
				'name' => 'footer_layout',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_custom_display_options',
							'operator' => '==',
							'value' => 'show_footer',
						),
						array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
					),
				),
				'wrapper' => array (
					'width' => '100%',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'normal' => __('Default footer',THEME_NAME ),
					'page' => __('Selected footer',THEME_NAME ),
				),
				'default_value' => array (
					0 => 'normal',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			
			array (
				'key' => 'field_page_footer',
				'label' => 'Selected footer',
				'name' => 'page_footer',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_page_custom_display_options',
							'operator' => '==',
							'value' => 'show_footer',
						),array (
							'field' => 'field_page_display_options',
							'operator' => '==',
							'value' => 'custom',
						),
						array (
							'field' => 'field_footer_layout',
							'operator' => '==',
							'value' => 'page',
						),
					),
				),
				
				'wrapper' => array (
					'width' => '100%',
					'class' => '',
					'id' => '',
				),
				'post_type' => array (
					0 => 'block',
				),
				'taxonomy' => array (
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),
			
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
				array (
					'param' => 'page_type',
					'operator' => '!=',
					'value' => 'posts_page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	
	
	
	//SINGLE POST  THEME OPTIONSS
	acf_add_local_field_group(array (
		'key' => 'group_5770e6e9b0cab',
		'title' => __('Article fields',THEME_NAME ),
		'fields' => array (
			array (
				'key' => 'field_57726dd1caabf',
				'label' => __('Summary',THEME_NAME ),
				'name' => 'entradeta',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				)
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	acf_add_local_field_group(array (
		'key' => 'group_post_template',
		'title' => __('Post Template',THEME_NAME ),
		'fields' => array (
			array (
				'key' => 'field_post_template',
				'label' => __('Template',THEME_NAME ),
				'name' => 'single_post_template',
				'type' => 'select',
				'required' => 0,
				
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => carrot_get_post_templates(),
				'default_value' => array (
					0 => '',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array (
				'key' => 'field_grid_cols',
				'label' => __('Grid columns',THEME_NAME),
				'name' => 'grid_cols',
				'instructions' => __('For articles displayed in grids',THEME_NAME),
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'field_show_featured_image',
				'label' => __("Show featured image",THEME_NAME),
				'name' => 'show_featured_image',
				'type' => 'radio',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'theme' => sprintf( __( 'Defined by theme (%s)', THEME_NAME ), (_o("single_post_show_featured")?__('Show',THEME_NAME):__('Hide',THEME_NAME)) ),
					'show' => __('Show',THEME_NAME),
					'hide' => __('Hide',THEME_NAME),
				),
				'allow_null' => 0,
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'theme',
				'layout' => 'vertical',
				'return_format' => 'value',
				'instructions' => __('Shows the featured image, only if supported by the selected template. This option overrides the global configuration', THEME_NAME),
				
			),
				
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				)
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	// SINGLE POST AND PAGE OPTIONS 
	acf_add_local_field_group(array (
		'key' => 'article_options',
		'title' => __('Article Options', THEME_NAME),
		'fields' => array (
			array (
				'key' => 'field_5772a5d99db71',
				'label' => __('Drop Cap',THEME_NAME ),
				'name' => 'capital_inicial',
				'type' => 'true_false',
				'instructions' => __('Check to highlight the article first letter', THEME_NAME),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 0,
			),array (
				'key' => 'field_5772a5d99db74',
				'label' => __('Hyphenate',THEME_NAME ),
				'name' => 'hyphenate',
				'type' => 'true_false',
				'instructions' => __('Check to hyphen content ends of lines', THEME_NAME),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 0,
			)
			,array (
				'key' => 'field_5772a5d99db72',
				'label' => __('Columnize',THEME_NAME ),
				'name' => 'columnize',
				'type' => 'true_false',
				'instructions' => __('Check to distribute content in columns', THEME_NAME),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 0,
			),
			array (
				'key' => 'field_5772a5d99db73',
				'label' => __('Columns',THEME_NAME ),
				'name' => 'columns',
				'type' => 'number',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_5772a5d99db72',
							'operator' => '==',
							'value' => '1',
						)
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 2,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => 3,
				'step' => 1,
				'readonly' => 0,
				'disabled' => 0,
			),
			
			/*,array (
				'key' => 'field_5772a5d99db85',
				'label' => __('Enable star rating',THEME_NAME ),
				'name' => 'star_rating',
				'type' => 'true_false',
				'message' => __('Check to enable user star rating', THEME_NAME),
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,

			),*/
		),

		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				)
			),array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				)
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	
	
	
	

	/*
	//CATEGORY FIELDS
	acf_add_local_field_group(array (
		'key' => 'group_5770edd7d483a',
		'title' => 'Category',
		'fields' => array (
			array (
				'key' => 'field_5770eddc909f7',
				'label' => __('Color',THEME_NAME ),
				'name' => 'color',
				'type' => 'color_picker',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
			),
			array (
				'key' => 'field_5774f5736b8ac',
				'label' => __('Icon',THEME_NAME ),
				'name' => 'icono',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_5774f58c6b8ad',
				'label' => __('Background',THEME_NAME ),
				'name' => 'imatge_fons',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'heading-size',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'category',
				),
			),
			array (
				array (
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'especials',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	*/
	
	
	
	
	
	
	/* USERs fields */
	/*acf_add_local_field_group(array (
		'key' => 'group_5770ee0d74ab7',
		'title' => 'User',
		'fields' => array (
			array (
				'key' => 'field_5770ee11ba769',
				'label' => __('Profile Picture',THEME_NAME ),
				'name' => 'foto',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
			),
			array (
				'key' => 'field_5770ee1cba76a',
				'label' => __('Description',THEME_NAME ),
				'name' => 'descripcio',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',
				'readonly' => 0,
				'disabled' => 0,
			),
			array (
				'key' => 'user_redes_sociales',
				'label' => __('Social Networks', THEME_NAME ),
				'name' => 'redes_sociales',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array (
					0 => 'group_social_networks',
				),
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),

		),
		'location' => array (
			array (
				array (
					'param' => 'user_form',
					'operator' => '==',
					'value' => 'all',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

	
	*/
	
	
	
	




	





	//add bidirectional relationship functionality
	function bidirectional_acf_update_value( $value, $post_id, $field  ) {
		$field_name = $field['name'];
		$field_key = $field['key'];
		$global_name = 'is_updating_' . $field_name;
		
		if( !empty($GLOBALS[ $global_name ]) ) return $value;
		
		$GLOBALS[ $global_name ] = 1;
		
		if( is_array($value) ) {
			foreach( $value as $post_id2 ) {
				$value2 = get_field($field_name, $post_id2, false);
				if( empty($value2) ) {
					$value2 = array();
				}
				if( in_array($post_id, $value2) ) continue;
				$value2[] = $post_id;
				update_field($field_key, $value2, $post_id2);
			}
		}
	

		// find posts which have been removed
		$old_value = get_field($field_name, $post_id, false);
		if( is_array($old_value) ) {
			foreach( $old_value as $post_id2 ) {
				if( is_array($value) && in_array($post_id2, $value) ) continue;
				$value2 = get_field($field_name, $post_id2, false);
				if( empty($value2) ) continue;
				$pos = array_search($post_id, $value2);
				unset( $value2[ $pos] );
				update_field($field_key, $value2, $post_id2);
			}
		}
		// reset global varibale to allow this filter to function as per normal
		$GLOBALS[ $global_name ] = 0;
		return $value;
	}

	add_filter('acf/update_value/name=related-project-author', 'bidirectional_acf_update_value', 10, 3);
	
	


endif;



