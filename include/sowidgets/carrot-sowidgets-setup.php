<?php
	
if (!class_exists('Carrot_SO_Widgets_Setup')):

	class Carrot_SO_Widgets_Setup {

		public function color_options(){
			return array(
				'' => '--',
				'primary' => __('Primary', THEME_NAME),
				'alt' => __('Alternate', THEME_NAME),
				'borders' => __('Borders', THEME_NAME),
				'white' => __('White', THEME_NAME),
				'black' => __('Black', THEME_NAME),
			);
		}
		
		public function carrot_prebuilt_layouts($layouts){
		   //$layouts=array();
		   //_dump($layouts);
		   /* $layouts['home-page'] = array(
		        // We'll add a title field
		        'name' => __('Default Home', 'vantage'),    // Required
		        'description' => __('Default Home Description', THEME_NAME),    // Optional
		        //'screenshot' => plugin_dir_url( __FILE__ ) . 'images/layout-screenshot.png',    // Optional
		        'widgets' => array( ... ),
		        'grids' => array( ... ),
		        'grid_cells' => array( ... )
		    );*/
		    return $layouts;

		}

		
				
		public function __construct() {
			add_filter('siteorigin_widgets_widget_folders', array($this, 'add_widgets_collection'));
			add_filter('siteorigin_widgets_widget_banner', array($this, 'widgets_img_src'), 10, 2);
			add_filter('siteorigin_widgets_icon_families', array($this, 'icon_families_filter' ));
			add_filter('siteorigin_panels_widget_dialog_tabs', array($this, 'add_widget_tabs'), 20);
			add_filter('siteorigin_panels_widgets', array($this, 'add_bundle_groups'), 11);
			add_action( 'admin_print_styles-post-new.php', array($this, 'admin_enqueue_styles' ));
			add_action( 'admin_print_styles-post.php', array($this, 'admin_enqueue_styles' ));
			add_action( 'admin_print_styles-appearance_page_so_panels_home_page', array($this, 'admin_enqueue_styles' ));
			add_action( 'admin_print_styles-widgets.php', array($this, 'admin_enqueue_styles' ));
			add_action( 'wp_enqueue_scripts', array($this, 'enqueue_styles'));
			add_filter( 'siteorigin_widgets_field_class_prefixes', array($this, 'custom_fields_class_prefixes') );
			add_filter( 'siteorigin_widgets_field_class_paths', array($this, 'custom_fields_class_paths') );
			add_filter('siteorigin_panels_prebuilt_layouts',array($this,'carrot_prebuilt_layouts'));
		

			//row styles
			add_filter('siteorigin_panels_row_style_fields', array($this, 'row_style_fields'));
			add_filter('siteorigin_panels_row_style_attributes', array($this, 'row_style_attributes'), 10, 2);
			
			//cell styles
			add_filter('siteorigin_panels_cell_style_fields', array($this, 'cell_style_fields'));
			add_filter('siteorigin_panels_cell_style_attributes', array($this, 'cell_style_attributes'), 10, 2);
			
			//widget styles
			add_filter('siteorigin_panels_widget_style_fields', array($this, 'widget_style_fields' ) );
			add_filter('siteorigin_panels_widget_style_attributes', array($this, 'widget_style_attributes' ), 10, 2);
			
		}


		
		
		function widget_style_fields($fields) {
			$fields['widget_margin'] = array(
				'name' => __('Margin', THEME_NAME),
				'type' => 'measurement',
				'multiple' => true,
				'group' => 'layout',
				'description' => __('Margin arround the entire widget.', THEME_NAME),
				'priority' => 5,
			);
			
			$fields['widget_hidden_xs']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Extra small devices', THEME_NAME),
				'description' => __('Phones (<768px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 11
			);
			$fields['widget_hidden_sm']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Small devices', THEME_NAME),
				'description' => __('Tablets (>=768px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 12
			);
			
			$fields['widget_hidden_md']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Medium devices', THEME_NAME),
				'description' => __('Desktops (>=992px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 13
			);
			
			$fields['widget_hidden_lg']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Large  devices', THEME_NAME),
				'description' => __('Desktops (>=1200px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 14
			);
			
			
			$fields['widget_link_to']= array(
				'type' => 'text',
				'name' => __( 'Link to', THEME_NAME),
				'default' => '',
				'group' => 'layout',
				'priority' => 15
			);
			
			
			
			//design options
            $fields['widget_appear_effect'] = array(
                'type' => 'select',
                'name' => __('Appear Effect', THEME_NAME),
				'description' => __('Choose the effect of the widget when it enters screen.', THEME_NAME),
                'default' => false,
				'options' => array(
					'none' =>  __( 'None', THEME_NAME),
					'from-left' =>  __( 'Slide from left', THEME_NAME),
					'from-right' =>  __( 'Slide from right', THEME_NAME),
					'from-top' =>  __( 'Slide from top', THEME_NAME),
					'from-bottom' =>  __( 'Slide from bottom', THEME_NAME),
					'from-center' =>  __( 'Grow from center', THEME_NAME),
					'grow-left' =>  __( 'Grow from left', THEME_NAME),
					'grow-right' =>  __( 'Grow from right', THEME_NAME),
					'grow-top' =>  __( 'Grow from top', THEME_NAME),
					'grow-bottom' =>  __( 'Grow from bottom', THEME_NAME),
					'flip-y' =>  __( 'Flip horizontal', THEME_NAME),
					'flip-x' =>  __( 'Flip vertical', THEME_NAME),
					'rotate-from-center' =>  __( 'Rotate from center', THEME_NAME),
					
					
				),
				'group' => 'design',
                'priority' => 3
                
            ); 

            $fields['widget_appear_delay'] = array(
                'type' => 'select',
                'name' => __('Appear Delay', THEME_NAME),
				'description' => __('Delay of the appearing effect.', THEME_NAME),
                'default' => '0',
				'options' => array(
					'0' =>  __( 'None', THEME_NAME),
					'1' =>  __( '1', THEME_NAME),
					'2' =>  __( '2', THEME_NAME),
					'3' =>  __( '3', THEME_NAME),
					'4' =>  __( '4', THEME_NAME),
					'5' =>  __( '5', THEME_NAME),
					'6' =>  __( '6', THEME_NAME),
					'7' =>  __( '7', THEME_NAME),
					'8' =>  __( '8', THEME_NAME)
				
				),
				'group' => 'design',
                'priority' => 4
                
            ); 
			/*$fields['widget_display_style'] = array(
                'type' => 'select',
                'name' => __('Display', THEME_NAME),
				'default' => 'block',
				'options' => array(
					'block' =>  __( 'Block', THEME_NAME),
					'inline-block' =>  __( 'Inline block', THEME_NAME),
					'inline' =>  __( 'Inline', THEME_NAME),
					
					
				),
				'group' => 'design',
                'priority' => 2
                
            );*/

			$fields['widget_bg_color'] = array(
                'type' => 'select',
                'name' => __('Theme Background color', THEME_NAME),
				'description' => __('Choose a color from the theme customizer colors.', THEME_NAME),
                'default' => false,
				'options' => $this->color_options(),
				'group' => 'design',
                'priority' => 5
                
            );
			$fields['widget_border_color'] = array(
                'type' => 'select',
                'name' => __('Theme Border color', THEME_NAME),
				'description' => __('Choose a color from the theme customizer colors.', THEME_NAME),
                'default' => false,
				'options' => $this->color_options(),
				'group' => 'design',
                'priority' => 9
                
            );
			
			$fields['widget_border_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 11,
				'multiple' => true
			);
			
			
			$fields['widget_border_style']= array(
				'type' => 'select',
				'name' => __( 'Border Style', THEME_NAME),
				'default' => 'none',
				'options' => array(
					'none' =>  __( 'None', THEME_NAME),
					'solid' =>  __( 'Solid', THEME_NAME),
					'dashed' =>  __( 'Dashed', THEME_NAME),
					'dotted' =>  __( 'Dotted', THEME_NAME),
					'double' =>  __( 'Double', THEME_NAME),
				),
				'group' => 'design',
				'priority' => 12
			);
			
			return $fields;
		}
		
		function widget_style_attributes( $attributes, $args ) {
			
			if( !empty( $args['widget_appear_effect'] ) ) {
				if($args['widget_appear_effect']!='none'){
				
					array_push($attributes['class'], 'anim');
					array_push($attributes['class'], $args['widget_appear_effect']);

					if( !empty( $args['widget_appear_delay'] ) ) {
						if($args['widget_appear_delay']!='0'){
						
							array_push($attributes['class'], 'delay-'.$args['widget_appear_delay']);
						}
					}

				}
			}
			
			if( !empty( $args['widget_display_style'] ) ) {
				if($args['widget_display_style']=='inline') array_push($attributes['class'], 'd-i');
				if($args['widget_display_style']=='inline-block') array_push($attributes['class'], 'd-ib');
			}
			
			if( !empty( $args['widget_hidden_xs'] ) ) {
				array_push($attributes['class'], 'hidden-xs');
			}
			
			if( !empty( $args['widget_hidden_sm'] ) ) {
				array_push($attributes['class'], 'hidden-sm');
			}
			if( !empty( $args['widget_hidden_md'] ) ) {
				array_push($attributes['class'], 'hidden-md');
			}
			if( !empty( $args['widget_hidden_lg'] ) ) {
				array_push($attributes['class'], 'hidden-lg');
			}
			
			if( !empty( $args['widget_bg_color'] ) ) {
				array_push($attributes['class'], 'bg-'.$args['widget_bg_color']);
			}
			
			
			if( !empty( $args['widget_border_color'] ) ) {
				array_push($attributes['class'], 'border-'.$args['widget_border_color']);
			}
			if( !empty( $args['widget_link_to'] ) ) {
				array_push($attributes['class'], 'clickable');
				$attributes['data-href']=$args['widget_link_to'];
				
			}
			
			if( !empty( $args['widget_margin'] ) ) {
				$attributes['style'].='margin:'.$args['widget_margin'].';';
			}
			
			
			$attributes['style'].="border-width:0px;";
		
		
			if( !empty( $args['widget_border_width'] ) ) {
				$attributes['style'].='border-width:'.$args['widget_border_width'].';';
			}
			if( !empty( $args['widget_border_style'] ) ) {
				$attributes['style'].='border-style:'.$args['widget_border_style'].';';
			}
			
			
			return $attributes;
		}
		
		
		
		
		function row_style_attributes($attributes, $args) {

            //_dump($attributes);
			//_dump($args);
			//if(!isset($attributes['class'])) $attributes['class']=array();
			//if(!isset($attributes['style'])) $attributes['style']=array();
			
			if( !empty( $args['hidden_xs'] ) ) {
				array_push($attributes['class'], 'hidden-xs');
			}
			if( !empty( $args['hidden_sm'] ) ) {
				array_push($attributes['class'], 'hidden-sm');
			}
			if( !empty( $args['hidden_md'] ) ) {
				array_push($attributes['class'], 'hidden-md');
			}
			if( !empty( $args['hidden_lg'] ) ) {
				array_push($attributes['class'], 'hidden-lg');
			}
			
			if( !empty( $args['row_bg_color'] ) ) {
				array_push($attributes['class'], 'bg-'.$args['row_bg_color']);
			}
			
			
			if( !empty( $args['row_border_color'] ) ) {
				array_push($attributes['class'], 'border-'.$args['row_border_color']);
			}
			
			
			if( !empty( $args['top_margin'] ) ) {
				$attributes['style'].='margin-top:'.$args['top_margin'].';';
			}
			if( !empty( $args['link_to'] ) ) {
				array_push($attributes['class'], 'clickable');
				$attributes['data-href']=$args['link_to'];
				
			}
			
			$attributes['style'].="border-width:0px;";
		
		
			if( !empty( $args['row_border_width'] ) ) {
				$attributes['style'].='border-width:'.$args['row_border_width'].';';
			}
			if( !empty( $args['row_border_style'] ) ) {
				$attributes['style'].='border-style:'.$args['row_border_style'].';';
			}
			
			
			//_dump($attributes);
            
            return $attributes;
        }
		
		
		
		
		
		function row_style_fields($fields) {
			
			
				
				
			//layout options
			$fields['top_margin']= array(
				'type' => 'measurement',
				'name' => __( 'Top Margin', THEME_NAME),
				'description' => __('Space above the row. Default is 0px.', THEME_NAME),
                'default' => false,
				'group' => 'layout',
				'priority' => 4
			);
			
			$fields['hidden_xs']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Extra small devices', THEME_NAME),
				'description' => __('Phones (<768px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 11
			);
			$fields['hidden_sm']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Small devices', THEME_NAME),
				'description' => __('Tablets (>=768px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 12
			);
			
			$fields['hidden_md']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Medium devices', THEME_NAME),
				'description' => __('Desktops (>=992px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 13
			);
			
			$fields['hidden_lg']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Large  devices', THEME_NAME),
				'description' => __('Desktops (>=1200px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 14
			);
			
			
			
			$fields['link_to']= array(
				'type' => 'text',
				'name' => __( 'Link to', THEME_NAME),
				'default' => '',
				'group' => 'layout',
				'priority' => 15
			);
			
			
			
			//design options
            $fields['row_bg_color'] = array(
                'type' => 'select',
                'name' => __('Theme Background color', THEME_NAME),
				'description' => __('Choose a color from the theme customizer colors.', THEME_NAME),
                'default' => false,
				'options' => $this->color_options(),
				'group' => 'design',
                'priority' => 4
                
            );
			$fields['row_border_color'] = array(
                'type' => 'select',
                'name' => __('Theme Border color', THEME_NAME),
				'description' => __('Choose a color from the theme customizer colors.', THEME_NAME),
                'default' => false,
				'options' => $this->color_options(),
				'group' => 'design',
                'priority' => 9
                
            );
			
			$fields['row_border_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 11,
				'multiple' => true
			);
			/*
			$fields['row_border_top_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Top Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 11
			);
			$fields['row_border_bottom_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Bottom Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 12
			);
			$fields['row_border_left_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Left Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 13
			);
			$fields['row_border_right_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Right Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 14
			);*/
			$fields['row_border_style']= array(
				'type' => 'select',
				'name' => __( 'Border Style', THEME_NAME),
				'default' => 'none',
				'options' => array(
					'none' =>  __( 'None', THEME_NAME),
					'solid' =>  __( 'Solid', THEME_NAME),
					'dashed' =>  __( 'Dashed', THEME_NAME),
					'dotted' =>  __( 'Dotted', THEME_NAME),
					'double' =>  __( 'Double', THEME_NAME),
				),
				'group' => 'design',
				'priority' => 15
			);
			
			
			
			
			return $fields;
		}
		
		
		function cell_style_attributes($attributes, $args) {

            //_dump($attributes);
			//_dump($args);
			//if(!isset($attributes['class'])) $attributes['class']=array();
			//if(!isset($attributes['style'])) $attributes['style']=array();
			
			if( !empty( $args['hidden_xs'] ) ) {
				array_push($attributes['class'], 'hidden-xs');
			}
			if( !empty( $args['hidden_sm'] ) ) {
				array_push($attributes['class'], 'hidden-sm');
			}
			if( !empty( $args['hidden_md'] ) ) {
				array_push($attributes['class'], 'hidden-md');
			}
			if( !empty( $args['hidden_lg'] ) ) {
				array_push($attributes['class'], 'hidden-lg');
			}
			
			if( !empty( $args['cell_bg_color'] ) ) {
				array_push($attributes['class'], 'bg-'.$args['cell_bg_color']);
			}
			
			
			if( !empty( $args['cell_border_color'] ) ) {
				array_push($attributes['class'], 'border-'.$args['cell_border_color']);
			}
			
			if( !empty( $args['top_margin'] ) ) {
				$attributes['style'].='margin-top:'.$args['top_margin'].';';
			}
				if( !empty( $args['bottom_margin'] ) ) {
				$attributes['style'].='margin-bottom:'.$args['bottom_margin'].';';
			}
			
			
			$attributes['style'].="border-width:0px;";
		
		
			if( !empty( $args['cell_border_width'] ) ) {
				$attributes['style'].='border-width:'.$args['cell_border_width'].';';
			}
			if( !empty( $args['cell_border_style'] ) ) {
				$attributes['style'].='border-style:'.$args['cell_border_style'].';';
			}
			
			
			//_dump($attributes);
            
            return $attributes;
        }
		
		
		
		
		
		function cell_style_fields($fields) {
			
			
				
				
			//layout options
			$fields['top_margin']= array(
				'type' => 'measurement',
				'name' => __( 'Top Margin', THEME_NAME),
				'description' => __('Space above the row. Default is 0px.', THEME_NAME),
                'default' => false,
				'group' => 'layout',
				'priority' => 4
			);
			$fields['bottom_margin']= array(
				'type' => 'measurement',
				'name' => __( 'Bottom Margin', THEME_NAME),
				'description' => __('Space blelow the row. Default is 0px.', THEME_NAME),
                'default' => false,
				'group' => 'layout',
				'priority' => 4
			);
			
			$fields['hidden_xs']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Extra small devices', THEME_NAME),
				'description' => __('Phones (<768px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 11
			);
			$fields['hidden_sm']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Small devices', THEME_NAME),
				'description' => __('Tablets (>=768px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 12
			);
			
			$fields['hidden_md']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Medium devices', THEME_NAME),
				'description' => __('Desktops (>=992px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 13
			);
			
			$fields['hidden_lg']= array(
				'type' => 'checkbox',
				'name' => __( 'Hidden on Large  devices', THEME_NAME),
				'description' => __('Desktops (>=1200px)', THEME_NAME),
				'default' => false,
				'group' => 'layout',
				'priority' => 14
			);
			
			
			
			
			
			
			//design options
            $fields['cell_bg_color'] = array(
                'type' => 'select',
                'name' => __('Theme Background color', THEME_NAME),
				'description' => __('Choose a color from the theme customizer colors.', THEME_NAME),
                'default' => false,
				'options' => $this->color_options(),
				'group' => 'design',
                'priority' => 4
                
            );
			$fields['cell_border_color'] = array(
                'type' => 'select',
                'name' => __('Theme Border color', THEME_NAME),
				'description' => __('Choose a color from the theme customizer colors.', THEME_NAME),
                'default' => false,
				'options' => $this->color_options(),
				'group' => 'design',
                'priority' => 9
                
            );
			
			$fields['cell_border_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 11,
				'multiple' => true
			);
			/*
			$fields['row_border_top_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Top Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 11
			);
			$fields['row_border_bottom_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Bottom Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 12
			);
			$fields['row_border_left_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Left Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 13
			);
			$fields['row_border_right_width']= array(
				'type' => 'measurement',
				'name' => __( 'Border Right Width', THEME_NAME),
				'default' => false,
				'group' => 'design',
				'priority' => 14
			);*/
			$fields['cell_border_style']= array(
				'type' => 'select',
				'name' => __( 'Border Style', THEME_NAME),
				'default' => 'none',
				'options' => array(
					'none' =>  __( 'None', THEME_NAME),
					'solid' =>  __( 'Solid', THEME_NAME),
					'dashed' =>  __( 'Dashed', THEME_NAME),
					'dotted' =>  __( 'Dotted', THEME_NAME),
					'double' =>  __( 'Double', THEME_NAME),
				),
				'group' => 'design',
				'priority' => 15
			);
			
			
			
			
			return $fields;
		}
		
		function widgets_img_src( $banner_url, $widget_meta ) {
			
			if(startsWith($widget_meta['ID'],'carrot-')){
				$banner_url = CARROT_SO_WIDGETS_URI. "/assets/img/banner_".$widget_meta['ID'].".svg";
				return $banner_url;
			}
			
			return $banner_url;
		}
		
		function custom_fields_class_prefixes( $class_prefixes ) {
			$class_prefixes[] = 'Carrot_Custom_Field_';
			//_dump($class_prefixes);
			return $class_prefixes;
		}
		
		function custom_fields_class_paths( $class_paths ) {
			$class_paths[] = CARROT_SO_WIDGETS_DIR . '/fields/';
			//_dump($class_paths);
			return $class_paths;
		}
		
		
		function icon_families_filter( $icon_families ) {
			$icon_families['themify'] = array(
				'name' => __( 'Themify Icons', THEME_NAME ),
				'style_uri' => THEME_URI.'/assets/style/themify-icons.css',
				'icons' => array(
					'ti-wand'				=> "&#xe600;",
					'ti-volume'			=> "&#xe601;",
					'ti-user'			=> "&#xe602;",
					'ti-unlock'			=> "&#xe603;",
					'ti-unlink'			=> "&#xe604;",
					'ti-trash'			=> "&#xe605;",
					'ti-thought'			=> "&#xe606;",
					'ti-target'			=> "&#xe607;",
					'ti-tag'			=> "&#xe608;",
					'ti-tablet'			=> "&#xe609;",
					'ti-star'			=> "&#xe60a;",
					'ti-spray'			=> "&#xe60b;",
					'ti-signal'			=> "&#xe60c;",
					'ti-shopping-cart'			=> "&#xe60d;",
					'ti-shopping-cart-full'			=> "&#xe60e;",
					'ti-settings'			=> "&#xe60f;",
					'ti-search'			=> "&#xe610;",
					'ti-zoom-in'			=> "&#xe611;",
					'ti-zoom-out'			=> "&#xe612;",
					'ti-cut'			=> "&#xe613;",
					'ti-ruler'			=> "&#xe614;",
					'ti-ruler-pencil'			=> "&#xe615;",
					'ti-ruler-alt'			=> "&#xe616;",
					'ti-bookmark'			=> "&#xe617;",
					'ti-bookmark-alt'			=> "&#xe618;",
					'ti-reload'			=> "&#xe619;",
					'ti-plus'			=> "&#xe61a;",
					'ti-pin'			=> "&#xe61b;",
					'ti-pencil'			=> "&#xe61c;",
					'ti-pencil-alt'			=> "&#xe61d;",
					'ti-paint-roller'			=> "&#xe61e;",
					'ti-paint-bucket'			=> "&#xe61f;",
					'ti-na'			=> "&#xe620;",
					'ti-mobile'			=> "&#xe621;",
					'ti-minus'			=> "&#xe622;",
					'ti-medall'			=> "&#xe623;",
					'ti-medall-alt'			=> "&#xe624;",
					'ti-marker'			=> "&#xe625;",
					'ti-marker-alt'			=> "&#xe626;",
					'ti-arrow-up'			=> "&#xe627;",
					'ti-arrow-right'			=> "&#xe628;",
					'ti-arrow-left'			=> "&#xe629;",
					'ti-arrow-down'			=> "&#xe62a;",
					'ti-lock'			=> "&#xe62b;",
					'ti-location-arrow'			=> "&#xe62c;",
					'ti-link'			=> "&#xe62d;",
					'ti-layout'			=> "&#xe62e;",
					'ti-layers'			=> "&#xe62f;",
					'ti-layers-alt'			=> "&#xe630;",
					'ti-key'			=> "&#xe631;",
					'ti-import'			=> "&#xe632;",
					'ti-image'			=> "&#xe633;",
					'ti-heart'			=> "&#xe634;",
					'ti-heart-broken'			=> "&#xe635;",
					'ti-hand-stop'			=> "&#xe636;",
					'ti-hand-open'			=> "&#xe637;",
					'ti-hand-drag'			=> "&#xe638;",
					'ti-folder'			=> "&#xe639;",
					'ti-flag'			=> "&#xe63a;",
					'ti-flag-alt'			=> "&#xe63b;",
					'ti-flag-alt-2'			=> "&#xe63c;",
					'ti-eye'			=> "&#xe63d;",
					'ti-export'			=> "&#xe63e;",
					'ti-exchange-vertical'			=> "&#xe63f;",
					'ti-desktop'			=> "&#xe640;",
					'ti-cup'			=> "&#xe641;",
					'ti-crown'			=> "&#xe642;",
					'ti-comments'			=> "&#xe643;",
					'ti-comment'			=> "&#xe644;",
					'ti-comment-alt'			=> "&#xe645;",
					'ti-close'			=> "&#xe646;",
					'ti-clip'			=> "&#xe647;",
					'ti-angle-up'			=> "&#xe648;",
					'ti-angle-right'			=> "&#xe649;",
					'ti-angle-left'			=> "&#xe64a;",
					'ti-angle-down'			=> "&#xe64b;",
					'ti-check'			=> "&#xe64c;",
					'ti-check-box'			=> "&#xe64d;",
					'ti-camera'			=> "&#xe64e;",
					'ti-announcement'			=> "&#xe64f;",
					'ti-brush'			=> "&#xe650;",
					'ti-briefcase'			=> "&#xe651;",
					'ti-bolt'			=> "&#xe652;",
					'ti-bolt-alt'			=> "&#xe653;",
					'ti-blackboard'			=> "&#xe654;",
					'ti-bag'			=> "&#xe655;",
					'ti-move'			=> "&#xe656;",
					'ti-arrows-vertical'			=> "&#xe657;",
					'ti-arrows-horizontal'			=> "&#xe658;",
					'ti-fullscreen'			=> "&#xe659;",
					'ti-arrow-top-right'			=> "&#xe65a;",
					'ti-arrow-top-left'			=> "&#xe65b;",
					'ti-arrow-circle-up'			=> "&#xe65c;",
					'ti-arrow-circle-right'			=> "&#xe65d;",
					'ti-arrow-circle-left'			=> "&#xe65e;",
					'ti-arrow-circle-down'			=> "&#xe65f;",
					'ti-angle-double-up'			=> "&#xe660;",
					'ti-angle-double-right'			=> "&#xe661;",
					'ti-angle-double-left'			=> "&#xe662;",
					'ti-angle-double-down'			=> "&#xe663;",
					'ti-zip'			=> "&#xe664;",
					'ti-world'			=> "&#xe665;",
					'ti-wheelchair'			=> "&#xe666;",
					'ti-view-list'			=> "&#xe667;",
					'ti-view-list-alt'			=> "&#xe668;",
					'ti-view-grid'			=> "&#xe669;",
					'ti-uppercase'			=> "&#xe66a;",
					'ti-upload'			=> "&#xe66b;",
					'ti-underline'			=> "&#xe66c;",
					'ti-truck'			=> "&#xe66d;",
					'ti-timer'			=> "&#xe66e;",
					'ti-ticket'			=> "&#xe66f;",
					'ti-thumb-up'			=> "&#xe670;",
					'ti-thumb-down'			=> "&#xe671;",
					'ti-text'			=> "&#xe672;",
					'ti-stats-up'			=> "&#xe673;",
					'ti-stats-down'			=> "&#xe674;",
					'ti-split-v'			=> "&#xe675;",
					'ti-split-h'			=> "&#xe676;",
					'ti-smallcap'			=> "&#xe677;",
					'ti-shine'			=> "&#xe678;",
					'ti-shift-right'			=> "&#xe679;",
					'ti-shift-left'			=> "&#xe67a;",
					'ti-shield'			=> "&#xe67b;",
					'ti-notepad'			=> "&#xe67c;",
					'ti-server'			=> "&#xe67d;",
					'ti-quote-right'			=> "&#xe67e;",
					'ti-quote-left'			=> "&#xe67f;",
					'ti-pulse'			=> "&#xe680;",
					'ti-printer'			=> "&#xe681;",
					'ti-power-off'			=> "&#xe682;",
					'ti-plug'			=> "&#xe683;",
					'ti-pie-chart'			=> "&#xe684;",
					'ti-paragraph'			=> "&#xe685;",
					'ti-panel'			=> "&#xe686;",
					'ti-package'			=> "&#xe687;",
					'ti-music'			=> "&#xe688;",
					'ti-music-alt'			=> "&#xe689;",
					'ti-mouse'			=> "&#xe68a;",
					'ti-mouse-alt'			=> "&#xe68b;",
					'ti-money'			=> "&#xe68c;",
					'ti-microphone'			=> "&#xe68d;",
					'ti-menu'			=> "&#xe68e;",
					'ti-menu-alt'			=> "&#xe68f;",
					'ti-map'			=> "&#xe690;",
					'ti-map-alt'			=> "&#xe691;",
					'ti-loop'			=> "&#xe692;",
					'ti-location-pin'			=> "&#xe693;",
					'ti-list'			=> "&#xe694;",
					'ti-light-bulb'			=> "&#xe695;",
					'ti-Italic'			=> "&#xe696;",
					'ti-info'			=> "&#xe697;",
					'ti-infinite'			=> "&#xe698;",
					'ti-id-badge'			=> "&#xe699;",
					'ti-hummer'			=> "&#xe69a;",
					'ti-home'			=> "&#xe69b;",
					'ti-help'			=> "&#xe69c;",
					'ti-headphone'			=> "&#xe69d;",
					'ti-harddrives'			=> "&#xe69e;",
					'ti-harddrive'			=> "&#xe69f;",
					'ti-gift'			=> "&#xe6a0;",
					'ti-game'			=> "&#xe6a1;",
					'ti-filter'			=> "&#xe6a2;",
					'ti-files'			=> "&#xe6a3;",
					'ti-file'			=> "&#xe6a4;",
					'ti-eraser'			=> "&#xe6a5;",
					'ti-envelope'			=> "&#xe6a6;",
					'ti-download'			=> "&#xe6a7;",
					'ti-direction'			=> "&#xe6a8;",
					'ti-direction-alt'			=> "&#xe6a9;",
					'ti-dashboard'			=> "&#xe6aa;",
					'ti-control-stop'			=> "&#xe6ab;",
					'ti-control-shuffle'			=> "&#xe6ac;",
					'ti-control-play'			=> "&#xe6ad;",
					'ti-control-pause'			=> "&#xe6ae;",
					'ti-control-forward'			=> "&#xe6af;",
					'ti-control-backward'			=> "&#xe6b0;",
					'ti-cloud'			=> "&#xe6b1;",
					'ti-cloud-up'			=> "&#xe6b2;",
					'ti-cloud-down'			=> "&#xe6b3;",
					'ti-clipboard'			=> "&#xe6b4;",
					'ti-car'			=> "&#xe6b5;",
					'ti-calendar'			=> "&#xe6b6;",
					'ti-book'			=> "&#xe6b7;",
					'ti-bell'			=> "&#xe6b8;",
					'ti-basketball'			=> "&#xe6b9;",
					'ti-bar-chart'			=> "&#xe6ba;",
					'ti-bar-chart-alt'			=> "&#xe6bb;",
					'ti-back-right'			=> "&#xe6bc;",
					'ti-back-left'			=> "&#xe6bd;",
					'ti-arrows-corner'			=> "&#xe6be;",
					'ti-archive'			=> "&#xe6bf;",
					'ti-anchor'			=> "&#xe6c0;",
					'ti-align-right'			=> "&#xe6c1;",
					'ti-align-left'			=> "&#xe6c2;",
					'ti-align-justify'			=> "&#xe6c3;",
					'ti-align-center'			=> "&#xe6c4;",
					'ti-alert'			=> "&#xe6c5;",
					'ti-alarm-clock'			=> "&#xe6c6;",
					'ti-agenda'			=> "&#xe6c7;",
					'ti-write'			=> "&#xe6c8;",
					'ti-window'			=> "&#xe6c9;",
					'ti-widgetized'			=> "&#xe6ca;",
					'ti-widget'			=> "&#xe6cb;",
					'ti-widget-alt'			=> "&#xe6cc;",
					'ti-wallet'			=> "&#xe6cd;",
					'ti-video-clapper'			=> "&#xe6ce;",
					'ti-video-camera'			=> "&#xe6cf;",
					'ti-vector'			=> "&#xe6d0;",
					'ti-themify-logo'			=> "&#xe6d1;",
					'ti-themify-favicon'			=> "&#xe6d2;",
					'ti-themify-favicon-alt'			=> "&#xe6d3;",
					'ti-support'			=> "&#xe6d4;",
					'ti-stamp'			=> "&#xe6d5;",
					'ti-split-v-alt'			=> "&#xe6d6;",
					'ti-slice'			=> "&#xe6d7;",
					'ti-shortcode'			=> "&#xe6d8;",
					'ti-shift-right-alt'			=> "&#xe6d9;",
					'ti-shift-left-alt'			=> "&#xe6da;",
					'ti-ruler-alt-2'			=> "&#xe6db;",
					'ti-receipt'			=> "&#xe6dc;",
					'ti-pin2'			=> "&#xe6dd;",
					'ti-pin-alt'			=> "&#xe6de;",
					'ti-pencil-alt2'			=> "&#xe6df;",
					'ti-palette'			=> "&#xe6e0;",
					'ti-more'			=> "&#xe6e1;",
					'ti-more-alt'			=> "&#xe6e2;",
					'ti-microphone-alt'			=> "&#xe6e3;",
					'ti-magnet'			=> "&#xe6e4;",
					'ti-line-double'			=> "&#xe6e5;",
					'ti-line-dotted'			=> "&#xe6e6;",
					'ti-line-dashed'			=> "&#xe6e7;",
					'ti-layout-width-full'			=> "&#xe6e8;",
					'ti-layout-width-default'			=> "&#xe6e9;",
					'ti-layout-width-default-alt'			=> "&#xe6ea;",
					'ti-layout-tab'			=> "&#xe6eb;",
					'ti-layout-tab-window'			=> "&#xe6ec;",
					'ti-layout-tab-v'			=> "&#xe6ed;",
					'ti-layout-tab-min'			=> "&#xe6ee;",
					'ti-layout-slider'			=> "&#xe6ef;",
					'ti-layout-slider-alt'			=> "&#xe6f0;",
					'ti-layout-sidebar-right'			=> "&#xe6f1;",
					'ti-layout-sidebar-none'			=> "&#xe6f2;",
					'ti-layout-sidebar-left'			=> "&#xe6f3;",
					'ti-layout-placeholder'			=> "&#xe6f4;",
					'ti-layout-menu'			=> "&#xe6f5;",
					'ti-layout-menu-v'			=> "&#xe6f6;",
					'ti-layout-menu-separated'			=> "&#xe6f7;",
					'ti-layout-menu-full'			=> "&#xe6f8;",
					'ti-layout-media-right-alt'			=> "&#xe6f9;",
					'ti-layout-media-right'			=> "&#xe6fa;",
					'ti-layout-media-overlay'			=> "&#xe6fb;",
					'ti-layout-media-overlay-alt'			=> "&#xe6fc;",
					'ti-layout-media-overlay-alt'			=> "&#xe6fd;",
					'ti-layout-media-left-alt'			=> "&#xe6fe;",
					'ti-layout-media-left'			=> "&#xe6ff;",
					'ti-layout-media-center-alt'			=> "&#xe700;",
					'ti-layout-media-center'			=> "&#xe701;",
					'ti-layout-list-thumb'			=> "&#xe702;",
					'ti-layout-list-thumb-alt'			=> "&#xe703;",
					'ti-layout-list-post'			=> "&#xe704;",
					'ti-layout-list-large-image'			=> "&#xe705;",
					'ti-layout-line-solid'			=> "&#xe706;",
					'ti-layout-grid4'			=> "&#xe707;",
					'ti-layout-grid3'			=> "&#xe708;",
					'ti-layout-grid2'			=> "&#xe709;",
					'ti-layout-grid2-thumb'			=> "&#xe70a;",
					'ti-layout-cta-right'			=> "&#xe70b;",
					'ti-layout-cta-left'			=> "&#xe70c;",
					'ti-layout-cta-center'			=> "&#xe70d;",
					'ti-layout-cta-btn-right'			=> "&#xe70e;",
					'ti-layout-cta-btn-left'			=> "&#xe70f;",
					'ti-layout-column4'			=> "&#xe710;",
					'ti-layout-column3'			=> "&#xe711;",
					'ti-layout-column2'			=> "&#xe712;",
					'ti-layout-accordion-separe'			=> "&#xe713;",
					'ti-layout-accordion-merge'			=> "&#xe714;",
					'ti-layout-accordion-list'			=> "&#xe715;",
					'ti-ink-pen'			=> "&#xe716;",
					'ti-info-alt'			=> "&#xe717;",
					'ti-help-alt'			=> "&#xe718;",
					'ti-headphone-alt'			=> "&#xe719;",
					'ti-hand-point-up'			=> "&#xe71a;",
					'ti-hand-point-right'			=> "&#xe71b;",
					'ti-hand-point-left'			=> "&#xe71c;",
					'ti-hand-point-down'			=> "&#xe71d;",
					'ti-gallery'			=> "&#xe71e;",
					'ti-face-smile'			=> "&#xe71f;",
					'ti-face-sad'			=> "&#xe720;",
					'ti-credit-card'			=> "&#xe721;",
					'ti-control-skip-forward'			=> "&#xe722;",
					'ti-control-skip-backward'			=> "&#xe723;",
					'ti-control-record'			=> "&#xe724;",
					'ti-control-eject'			=> "&#xe725;",
					'ti-comments-smiley'			=> "&#xe726;",
					'ti-brush-alt'			=> "&#xe727;",
					'ti-youtube'			=> "&#xe728;",
					'ti-vimeo'			=> "&#xe729;",
					'ti-twitter'			=> "&#xe72a;",
					'ti-time'			=> "&#xe72b;",
					'ti-tumblr'			=> "&#xe72c;",
					'ti-skype'			=> "&#xe72d;",
					'ti-share'			=> "&#xe72e;",
					'ti-share-alt'			=> "&#xe72f;",
					'ti-rocket'			=> "&#xe730;",
					'ti-pinterest'			=> "&#xe731;",
					'ti-new-window'			=> "&#xe732;",
					'ti-microsoft'			=> "&#xe733;",
					'ti-list-ol'			=> "&#xe734;",
					'ti-linkedin'			=> "&#xe735;",
					'ti-layout-sidebar-2'			=> "&#xe736;",
					'ti-layout-grid4-alt'			=> "&#xe737;",
					'ti-layout-grid3-alt'			=> "&#xe738;",
					'ti-layout-grid2-alt'			=> "&#xe739;",
					'ti-layout-column4-alt'			=> "&#xe73a;",
					'ti-layout-column3-alt'			=> "&#xe73b;",
					'ti-layout-column2-alt'			=> "&#xe73c;",
					'ti-instagram'			=> "&#xe73d;",
					'ti-google'			=> "&#xe73e;",
					'ti-github'			=> "&#xe73f;",
					'ti-flickr'			=> "&#xe740;",
					'ti-facebook'			=> "&#xe741;",
					'ti-dropbox'			=> "&#xe742;",
					'ti-dribbble'			=> "&#xe743;",
					'ti-apple'			=> "&#xe744;",
					'ti-android'			=> "&#xe745;",
					'ti-save'			=> "&#xe746;",
					'ti-save-alt'			=> "&#xe747;",
					'ti-yahoo'			=> "&#xe748;",
					'ti-wordpress'			=> "&#xe749;",
					'ti-vimeo-alt'			=> "&#xe74a;",
					'ti-twitter-alt'			=> "&#xe74b;",
					'ti-tumblr-alt'			=> "&#xe74c;",
					'ti-trello'			=> "&#xe74d;",
					'ti-stack-overflow'			=> "&#xe74e;",
					'ti-soundcloud'			=> "&#xe74f;",
					'ti-sharethis'			=> "&#xe750;",
					'ti-sharethis-alt'			=> "&#xe751;",
					'ti-reddit'			=> "&#xe752;",
					'ti-pinterest-alt'			=> "&#xe753;",
					'ti-microsoft-alt'			=> "&#xe754;",
					'ti-linux'			=> "&#xe755;",
					'ti-jsfiddle'			=> "&#xe756;",
					'ti-joomla'			=> "&#xe757;",
					'ti-html5'			=> "&#xe758;",
					'ti-flickr-alt'			=> "&#xe759;",
					'ti-email'			=> "&#xe75a;",
					'ti-drupal'			=> "&#xe75b;",
					'ti-dropbox-alt'			=> "&#xe75c;",
					'ti-css3'			=> "&#xe75d;",
					'ti-rss'			=> "&#xe75e;",
					'ti-rss-alt'			=> "&#xe75f;",
					// Etc.
				),
			);
			return $icon_families;
		}




		function add_widgets_collection($folders) {
			$folders[] = CARROT_SO_WIDGETS_DIR . '/widgets/';
			//_dump($folders);
			return $folders;
		}


		// Placing all widgets under the 'SiteOrigin Widgets' Tab
		function add_widget_tabs($tabs) {
			$tabs[] = array(
				'title' => __('Carrot SiteOrigin Widgets', 'carrot-so-widgets'),
				'filter' => array(
					'groups' => array('carrot-widgets')
				)
			);
			return $tabs;
		}


		// Adding group for all Widgets
		function add_bundle_groups($widgets) {
			foreach ($widgets as $class => &$widget) {
				if (preg_match('/Carrot_(.*)_Widget/', $class, $matches)) {
					$widget['groups'] = array('carrot-widgets');
				}
			}
			return $widgets;
		}
		
		
		function admin_enqueue_styles( $prefix = '', $force = false ) {
			if (is_admin() ) {
				wp_enqueue_style( 'carrot-so-widgets-admin', CARROT_SO_WIDGETS_URI . '/assets/style/admin-style.css');
			}
		}
		
		function enqueue_styles( $prefix = '', $force = false ) {
			if (!is_admin() ) {
				wp_enqueue_style( 'carrot-so-widgets-frontend', CARROT_SO_WIDGETS_URI . '/assets/style/style.css');
			}
		}
		


	}

	//register sowidgts
	new Carrot_SO_Widgets_Setup();	


endif;


