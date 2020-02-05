<?php
/*
Widget Name: Posts Table
Description: Displays a list of posts as a table.
Author: Txo
*/




class Carrot_Posts_Table_Widget extends Carrot_SiteOrigin_Posts_Widget {
	
	function custom_variables( $instance ){ }
	
	
		
	function __construct() {
		parent::__construct(
			'carrot-posts-table', 
			'Carrot Posts Table', 
			'Displays a list of posts as a table.' ,

			array(
				'list_section' => array(
					'type' => 'section',
					'label' => __( 'Table Columns' , THEME_NAME ),
					'hide' => true,
					'fields' => array(
						'table_columns'=> array(
							'type' => 'repeater',
							'label' => __( 'Columns' , THEME_NAME ),
							'item_name'  => __( 'Column', THEME_NAME ),
							'item_label' => array(
								'selector'     => "[id*='column_name']",
								'update_event' => 'change',
								'value_method' => 'val'
							),
							'fields' => array(
								'column_field' => array(
									'type' => 'select',
									'default' => 'none',
									'label' => __( 'Post field', THEME_NAME ),
									'options' => carrot_availableFields()
								),
								'column_custom_field' => array(
									'type' => 'text',
									'label' => __( 'Custom field Id', THEME_NAME )								
								),
								'column_name' => array(
									'type' => 'text',
									'label' => __( 'Column name', THEME_NAME )								
								),
								'column_link' => array(
									'type' => 'checkbox',
									'default' => false,
									'label' => __( 'Link to post', THEME_NAME )
								),
							)
						)
					)
				)
			)
		);
	}
}

siteorigin_widget_register('carrot-posts-table-widget', __FILE__, 'Carrot_Posts_Table_Widget');

function carrot_renderPostField($fieldname, $link=false){
	$ret="";
	
	if($link) $ret.='<a href="'.get_permalink().'">';
	
	switch($fieldname){
		case "" : break;
		case "id" : $ret.= get_the_ID(); break;
		case "title" : $ret.= get_the_title(); break;
		case "content" : $ret.= get_the_content(); break;
		case "featured_image" : $ret.= get_post_thumbnail('mini-icon'); break;
		case "creation" : $ret.= carrot_posted_on(); break;
		case "categories" : $ret.= carrot_post_categories(); break;
		case "tags" : $ret.= carrot_post_tags(); break;
		default: 
			$ret.=gf($fieldname);
		break;
	
	}

	if($link) $ret.="</a>";
	return $ret;

}
function carrot_availableFields(){
	$ret=[
		"" => ("--"),
		"id" => __("ID", THEME_NAME ),
		"title" => __("Title", THEME_NAME ),
		"content"=> __("Content", THEME_NAME ),
		"featured_image"=> __("Featured Image", THEME_NAME ),
		"creation"=> __("Creation date", THEME_NAME ),
		"categories"=> __("Categories", THEME_NAME ),
		"tags"=> __("Tags", THEME_NAME ),
	];
	return $ret;
}