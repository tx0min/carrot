<?php
/*
Widget Name: Posts Slider
Description: Displays a slider of posts.
Author: Txo
*/




class Carrot_Posts_Slider_Widget extends Carrot_SiteOrigin_Posts_Widget {
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-posts-slider', 
			'Carrot Posts Slider', 
			'Displays a slider of posts.' ,

			array(
				'slider_section' => array(
					'type' => 'section',
					'label' => __( 'Slider' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'auto_play' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Auto play', THEME_NAME )
						),
						'slider_loop' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Loop', THEME_NAME )
						),
						'pause_on_hover' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Pause on hover', THEME_NAME )
						),
						'enable_drag' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Enable dragging', THEME_NAME )
						),
						'show_navigation' => array(
							'type' => 'checkbox',
							'default' => true,
							'label' => __( 'Show navigation', THEME_NAME )
						),
						'show_pager' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Show Pagination', THEME_NAME )
						),
						'articles_to_show' => array(
							'type' => 'slider',
							'default' => 1,
							'min' => 1,
							'max' => 10,
							'integer' => true,
							'label' => __( 'Articles per page', THEME_NAME )
						),
						'articles_to_show_responsive' => array(
							'type' => 'slider',
							'default' => 1,
							'min' => 1,
							'max' => 10,
							'integer' => true,
							'label' => __( 'Articles per page in small devices', THEME_NAME )
						),
						'slide_gap' => array(
							'type' => 'select',
							'default' => 'small',
							'label' => __( 'Slide Gap', THEME_NAME ),
							'options' => carrot_availableGaps()
						),
						'page_slide' => array(
							'type' => 'checkbox',
							'default' => false,
							'label' => __( 'Cycle by page', THEME_NAME ),
							'description' => __( 'If there is more than one item per page and this option is checked, navigation will cycle the whole page. Otherwise it will cycle by article.', THEME_NAME ),

						),
						'slide_effect' => array(
							'type' => 'select',
							'default' => 'none',
							'label' => __( 'Effect', THEME_NAME ),
							'description' => __( 'Effect only works when there is 1 article per page', THEME_NAME ),
							'options' => array(
								'none' => __( 'No effect', THEME_NAME ),
								'fade' => __( 'Fade', THEME_NAME ),
								'slide-h' => __( 'Slide Horizontal', THEME_NAME ),
								'slide-v' => __( 'Slide Vertical', THEME_NAME ),
								'flip-h' => __( 'Flip Horizontal', THEME_NAME ),
								'flip-v' => __( 'Flip Vertical', THEME_NAME ),
								'zoom' => __( 'Zoom', THEME_NAME )
							)
						),
						'slide_timeout' => array(
							'type' => 'slider',
							'default' => 5000,
							'min' => 1,
							'max' => 10000,
							'integer' => true,
							'label' => __( 'Slider timeout', THEME_NAME ),
							'description' => __( 'Time between slides (in miliseconds)', THEME_NAME ),
							
						),
						'slide_speed' => array(
							'type' => 'slider',
							'default' => 600,
							'min' => 0,
							'max' => 2000,
							'integer' => true,
							'label' => __( 'Slide speed', THEME_NAME ),
							'description' => __( 'Slide transition speed (in miliseconds)', THEME_NAME ),
							
						),
						'slide_valign' => array(
							'type' => 'select',
							'default' => 'top',
							'label' => __( 'Vertical Align', THEME_NAME ),
							'options' => array(
								'top' => __( 'Top align', THEME_NAME ),
								'center' => __( 'Center align', THEME_NAME ),
								'bottom' => __( 'Bottom align', THEME_NAME )
							)
							
						)
						
					)
				),
				
			)
		);
	}
	
	function initialize() {
        
		
        
		/*wp_enqueue_script( 'carrot-posts-slider', CARROT_SO_WIDGETS_URI. '/widgets/carrot-posts-slider/js/carrot-posts-slider.js', array('jquery','owl-carousel') );
		wp_localize_script( 'carrot-posts-slider', 'carrot_slider_ajax',
			array(
				'texts' =>array(
					"next" =>__("Next",THEME_NAME),  
					"prev" =>__("Previous",THEME_NAME), 
					"loading" =>__("Loading",THEME_NAME)
				),
				'icons' => array(
					"right" => _icon("icon_angle_right"),
					"left" => _icon("icon_angle_left"),
					"loading" => _icon("icon_loading","spin"),
					"pagination" => _icon("icon_pagination_item")
				)
			)
			
		);
		*/
		
        $this->register_frontend_styles(array(
            array( 'carrot-posts-slider',CARROT_SO_WIDGETS_URI . '/widgets/carrot-posts-slider/styles/slider.css')
        ));
    }
}

siteorigin_widget_register('carrot-posts-slider-widget', __FILE__, 'Carrot_Posts_Slider_Widget');