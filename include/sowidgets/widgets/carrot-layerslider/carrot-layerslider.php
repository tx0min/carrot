<?php
/*
Widget Name: LayerSlider Selector
Description: Displays a LayerSlider.
Author: Txo
*/

				
if(!function_exists('carrot_find_layersliders'))
{
	function carrot_find_layersliders($names_only = false)
	{
		// Get WPDB Object
	    global $wpdb;
	 
	 	// Table name
	    $table_name = $wpdb->prefix . LS_DB_TABLE;
	 
	    // Get sliders
	    $sliders = $wpdb->get_results( "SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0' ORDER BY date_c ASC LIMIT 300" );
	 	
	 	if(empty($sliders)) return;
	 	
	 	if($names_only)
	 	{
	 		$new = array();
	 		foreach($sliders as $key => $item) 
		    {
		    	if(empty($item->name)) $item->name = __("(Unnamed Slider)",THEME_NAME);
		       $new[$item->id] = $item->name;
		    }
		    
		    return $new;
	 	}
	 	
	 	return $sliders;
	}
}


class Carrot_LayerSlider_Widget extends Carrot_SiteOrigin_Widget {

	function __construct() {
		parent::__construct(
			'carrot-layerslider', 
			'LayerSlider', 
			'Displays a LayerSlider.' ,
			array(
				'layer_slider_id'=> array(	
					'type' => 'select',
					'label' => __( 'Choose the Layer Slider', THEME_NAME),
					'description' => __( 'You can edit existing slider or create new ones in the <a href="admin.php?page=layerslider">LayerSlider WP</a> section in the Wordpress Dashboard.', THEME_NAME),
					'default' => '',
					'options' => carrot_find_layersliders(true)
				),

				
				
			)
		);
	}
}

if(!defined("LS_DB_TABLE")) return;	    
siteorigin_widget_register('carrot-layerslider-widget', __FILE__, 'Carrot_LayerSlider_Widget');