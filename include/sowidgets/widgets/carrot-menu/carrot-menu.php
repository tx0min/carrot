<?php
/*
Widget Name: Menu Widget
Description: Displays a menu.
Author: Txo
*/

				
if(!function_exists('carrot_find_menus'))
{
	function carrot_find_menus($names_only = false)
	{
		$menus = get_terms('nav_menu');
		$ret=array();
		if($menus){
			foreach($menus as $menu){
				$ret[$menu->term_id] = $menu->name; /*echo $menu->name . " n";*/
			} 
		}
		return $ret;
	}
}

class Carrot_Menu_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-menu', 
			'Carrot Menu Widget', 
			'Displays a menu.' ,

			array(
				'menuid'=> array(	
					'type' => 'select',
					'label' => __( 'Choose the Menu to display', THEME_NAME),
					'default' => '',
					'options' => carrot_find_menus(true)
				),
				'menulayout'=> array(	
					'type' => 'select',
					'label' => __( 'Menu layout', THEME_NAME),
					'default' => 'horizontal',
					'options' => array(
						'horizontal' => __("Horizontal", THEME_NAME),
						'vertical' => __("Vertical", THEME_NAME)
					)
				),
				'menualign'=> array(	
					'type' => 'select',
					'label' => __( 'Align', THEME_NAME),
					'default' => 'left',
					'options' => array(
						'left' => __("Left", THEME_NAME),
						'center' => __("Center", THEME_NAME),
						'right' => __("Right", THEME_NAME)
					)
				),


				
				
			)
		);
	}
}

siteorigin_widget_register('carrot-menu-widget', __FILE__, 'Carrot_Menu_Widget');