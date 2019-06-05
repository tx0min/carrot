<?php
/*
Widget Name: Block
Description: Displays a block.
Author: Txo
*/

				
if(!function_exists('carrot_find_blocks'))
{
	function carrot_find_blocks($names_only = false)
	{
		$blocks=array();
		
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'block',
			'post_status'      => 'publish'
		); 
		
		$posts = get_posts( $args );
		
		if($posts){
			foreach($posts as $h){
				$blocks[$h->ID]=$h->post_title;
			}
		}
		return $blocks;
	}
}

class Carrot_Block_Widget extends Carrot_SiteOrigin_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-block', 
			'Carrot Block', 
			'Displays a block.' ,

			array(
				'blockid'=> array(	
					'type' => 'select',
					'label' => __( 'Choose the Block to display', THEME_NAME),
					'description' => __( 'You can create your custom Blocks in the "blocks" section of the Wordpress Dashboard.', THEME_NAME ),
					'default' => '',
					'options' => carrot_find_blocks(true)
				),


				
				
			)
		);
	}
}

siteorigin_widget_register('carrot-block-widget', __FILE__, 'Carrot_Block_Widget');