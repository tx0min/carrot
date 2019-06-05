<?php
/*
Widget Name: Posts List
Description: Displays a list of posts.
Author: Txo
*/




class Carrot_Posts_List_Widget extends Carrot_SiteOrigin_Posts_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-posts-list', 
			'Carrot Posts List', 
			'Displays a list of posts.' ,

			array(
				'list_section' => array(
					'type' => 'section',
					'label' => __( 'List Options' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'list_gap' => array(
							'type' => 'select',
							'default' => 'small',
							'label' => __( 'List Gap', THEME_NAME ),
							'options' => carrot_availableGaps()
						)
					)
				)
			)
		);
	}
}

siteorigin_widget_register('carrot-posts-list-widget', __FILE__, 'Carrot_Posts_List_Widget');