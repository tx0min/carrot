<?php
/*
Widget Name: Separator Widget
Description: Displays a separator.
Author: Txo
*/

class Carrot_Separator_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }

		
	function __construct() {
		parent::__construct(
			'carrot-separator', 
			'Carrot Separator Widget', 
			'Displays a separator.' ,

			array(
				'separator_style'=> array(	
					'type' => 'select',
					'label' => __( 'Style', THEME_NAME),
					'default' => 'solid',
					'css' => true,
					'options' => array(
						'blank' =>  __( 'Blank space', THEME_NAME),
						'solid' =>  __( 'Solid', THEME_NAME),
						'dashed' =>  __( 'Dashed', THEME_NAME),
						'dotted' =>  __( 'Dotted', THEME_NAME),
						'double' =>  __( 'Double', THEME_NAME),
					)
				),
				'separator_width' => array(
					'type' => 'slider',
					'default' => 50,
					'min' => 1,
					'max' => 100,
					'integer' => true,
					'css' => true,
					'label' => __( 'Width', THEME_NAME )
				),
				'separator_height' => array(
					'type' => 'slider',
					'default' => 1,
					'min' => 0,
					'max' => 20,
					'integer' => true,
					'label' => __( 'Height', THEME_NAME ),
					'css' => true,
					'units' => 'px'
				),
				'separator_align'=> array(	
					'type' => 'select',
					'label' => __( 'Align', THEME_NAME),
					'default' => 'left',
					'options' => array(
						'left' => __("Left", THEME_NAME),
						'center' => __("Center", THEME_NAME),
						'right' => __("Right", THEME_NAME)
					)
				),
				'separator_color' => array(
					'type' => 'themecolor',
	                'label' => __('Color', THEME_NAME),
					'default' => false,
					'css' => true
				)/*,
				'separator_icon' => array(
					'type' => 'icon',
					'label' => __('Icon', THEME_NAME),
				),
				'separator_icon_size'=> array(	
					'type' => 'select',
					'label' => __( 'Icon size', THEME_NAME),
					'default' => 'md',
					'options' => array(
						'xs' => __("Extra Small", THEME_NAME),
						'sm' => __("Small", THEME_NAME),
						'md' => __("Medium", THEME_NAME),
						'lg' => __("Large", THEME_NAME),
						'xl' => __("Extra Large", THEME_NAME),
					)
				)*/


				
				
			)
		);
	}

	function initialize() {

        $this->register_frontend_styles(array(
            array( 'carrot-separator',CARROT_SO_WIDGETS_URI . '/widgets/carrot-separator/styles/carrot-separator.css')
        ));
    }
}

siteorigin_widget_register('carrot-separator-widget', __FILE__, 'Carrot_Separator_Widget');