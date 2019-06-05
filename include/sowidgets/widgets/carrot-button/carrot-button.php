<?php
/*
Widget Name: Button Widget
Description: Displays a button.
Author: Txo
*/

	

class Carrot_Button_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-button', 
			'Carrot Button Widget', 
			'Displays a button.' ,

			array(
				'button_text'=> array(	
					'type' => 'text',
					'label' => __( 'Button text', THEME_NAME),
					'default' => ''
				),
				'button_style'=> array(	
					'type' => 'select',
					'label' => __( 'Button style', THEME_NAME),
					'default' => 'flat',
					'options' => array(
						'flat' => __("Flat", THEME_NAME),
						'wire' => __("Wire", THEME_NAME),
						'pill' => __("Pill", THEME_NAME),
					)
				),
				'button_align'=> array(	
					'type' => 'select',
					'label' => __( 'Button align', THEME_NAME),
					'default' => 'left',
					'options' => array(
						'left' => __("Left", THEME_NAME),
						'center' => __("Center", THEME_NAME),
						'right' => __("Right", THEME_NAME),
					)
				),
				'button_display'=> array(	
					'type' => 'select',
					'label' => __( 'Button display', THEME_NAME),
					'default' => 'inline',
					'options' => array(
						'inline' => __("Inline", THEME_NAME),
						'block' => __("Block", THEME_NAME)
					)
				),
				'button_color'=> array(	
					'type' => 'select',
					'label' => __( 'Button color', THEME_NAME),
					'default' => 'primary',
					'options' => array(
						'primary' => __("Primary", THEME_NAME),
						'alt' => __("Alternate", THEME_NAME),
						'black' => __("Black", THEME_NAME),
						'white' => __("White", THEME_NAME),
					)
				),
				'button_size'=> array(	
					'type' => 'select',
					'label' => __( 'Button size', THEME_NAME),
					'default' => 'md',
					'options' => array(
						'xs' => __("Extra Small", THEME_NAME),
						'sm' => __("Small", THEME_NAME),
						'md' => __("Medium", THEME_NAME),
						'lg' => __("Large", THEME_NAME),
						'xl' => __("Extra Large", THEME_NAME),
					)
				),
				'button_icon' => array(
					'type' => 'icon',
					'label' => __('Icon', THEME_NAME),
				)/*,
				'button_icon_image' => array(
					'type' => 'media',
					'label' => __('Icon Image', THEME_NAME),
					'choose' => __( 'Choose image', THEME_NAME ),
					'update' => __( 'Set image', THEME_NAME ),
					'library' => 'image',
					'fallback' => true
				)*/,
				'icon_position'=> array(	
					'type' => 'select',
					'label' => __( 'Icon position', THEME_NAME),
					'default' => 'left',
					'options' => array(
						'left' => __("Left", THEME_NAME),
						'right' => __("Right", THEME_NAME),
						'top' => __("Top", THEME_NAME),
						'bottom' => __("Bottom", THEME_NAME)
					)
				),

				'button_url' => array(
			        'type' => 'link',
			        'label' => __('Button URL', THEME_NAME),
			        'default' => ''
			    )
				
				
			)
		);
	}
}

siteorigin_widget_register('carrot-button-widget', __FILE__, 'Carrot_Button_Widget');