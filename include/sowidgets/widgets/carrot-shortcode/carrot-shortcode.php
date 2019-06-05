<?php
/*
Widget Name: Shortcode Widget
Description: Displays a shortcode.
Author: Txo
*/

				
if(!function_exists('carrot_find_shortcodes'))
{
	function carrot_find_shortcodes()
	{
		global $shortcode_tags;
		$ret=array();
		$ret[]="--";
		foreach($shortcode_tags as $code => $function)
		{	
			$ret[$code]=$code;
			
		}
		return $ret;
		
	}
}

class Carrot_Shortcode_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-shortcode', 
			'Carrot Shortcode Widget', 
			'Displays a shortcode.' ,

			array(
				'shortcode_select'=> array(	
					'type' => 'select',
					'label' => __( 'Choose the Shortcode to display', THEME_NAME),
					'default' => '',
					'options' => carrot_find_shortcodes()
				),
				'shortcode_tag'=> array(	
					'type' => 'text',
					'label' => __( 'or Type the shortcode name (without the brackets)', THEME_NAME),
					'default' => ''
				),
				'shortcode_attrs' => array(
					'type' => 'repeater',
					'label' => __( 'Attributes' , THEME_NAME ),
					'item_name'  => __( 'Attribute', THEME_NAME ),
					'fields' => array(
						'attr_name' => array(
							'type' => 'text',
							'label' => __( 'Name', THEME_NAME )
						),
						'attr_value' => array(
							'type' => 'text',
							'label' => __( 'Value', THEME_NAME )
						)
					)
				)


				
				
			)
		);
	}
}

siteorigin_widget_register('carrot-shortcode-widget', __FILE__, 'Carrot_Shortcode_Widget');