<?php
/*
Widget Name: ADs
Description: Displays a list of ADs (AD management must be enabled).
Author: Txo
*/




class Carrot_ADS_Widget extends Carrot_SiteOrigin_Widget {
	

	
		
	function __construct() {
		

		parent::__construct(
			'carrot-ads', 
			'Carrot ADs', 
			'Displays a list of ADs (AD management must be enabled)' ,
			array(
				'banner_show' => array(
					'type' => 'select',
					'label' => __( 'Showed ADs', THEME_NAME ),
					'default' => 'random',
					'multiple' => false ,
					'options' => array(
						'random' => __('Random',THEME_NAME ),
						'last' => __('Last published',THEME_NAME ),
						'related' => __('Related (by current post or page tags)',THEME_NAME ),
						'chosen' => __('User selected',THEME_NAME )
					),
					'state_emitter' => array(
						'callback' => 'select',
						'args' => array( 'banner_show' )
					),
					
				),
				'banner_format' => array(
					'type' => 'taxonomyselect',
					'label' => __( 'Banner Format', THEME_NAME ),
					'taxonomy' => 'banner-type',
					'multiple' => false ,
					'default' => false ,
					'required' => true ,
					'state_handler' => array(
						'banner_show[chosen]' => array('hide'),
						'_else[banner_show]' => array( 'show' )
					),
				),
				'banner_number' => array(
					'type' => 'slider',
					'label' => __( 'AD Number', THEME_NAME ),
					'description' => __( 'The max number of banners showed.', THEME_NAME ),
					'default' => 1,
					'min' => 1,
					'max' => 10,
					'integer' => true,
					'state_handler' => array(
						'banner_show[chosen]' => array('hide'),
						'_else[banner_show]' => array( 'show' )
					),
				),
				'banner_columns' => array(
					'type' => 'slider',
					'label' => __( 'Columns', THEME_NAME ),
					'description' => __( 'The number of columns the banners will be displayed', THEME_NAME ),
					'default' => 1,
					'min' => 1,
					'max' => 12,
					'integer' => true
				),
				'banner_columns_small' => array(
					'type' => 'slider',
					'label' => __( 'Columns (small devices)', THEME_NAME ),
					'description' => __( 'The number of columns the banners will be displayed on small devices', THEME_NAME ),
					'default' => 1,
					'min' => 1,
					'max' => 12,
					'integer' => true
				),
				
				'selected_banners' => array(
					'type' => 'posts',
					'label' => __( 'Selected ADs', THEME_NAME ),
					'state_handler' => array(
						'banner_show[chosen]' => array('show'),
						'_else[banner_show]' => array( 'hide' )
					),
				),
				'track_imprints' => array(
					'type' => 'checkbox',
					'default' => true,
					'label' => __( 'Track Imprints', THEME_NAME )
				),
				'track_clicks' => array(
					'type' => 'checkbox',
					'default' => true,
					'label' => __( 'Track Clicks', THEME_NAME )
				),
				
				
				
						
			)
		);
	}

	function initialize() {



        $this->register_frontend_styles(array(
            array(
                'carrot-ads',
                CARROT_SO_WIDGETS_URI . '/widgets/carrot-ads/styles/publi.css'
            )
        ));
    }
}


define("CARROT_ADS_CLICK_KEY","banner_clicks");
define("CARROT_ADS_IMPRINT_KEY","banner_imprints");
define("CARROT_ADS_COOKIENAME","carrot_banner_clicked_");






function carrot_ads_get_banner_clicks($postID){
	return carrot_get_post_meta_num($postID,CARROT_ADS_CLICK_KEY);
}
function carrot_ads_get_banner_imprints($postID){
	return carrot_get_post_meta_num($postID,CARROT_ADS_IMPRINT_KEY);
}

function carrot_inc_banner_imprints($postID){
	//_dump("IMPRINT");
	carrot_inc_post_meta_num($postID,CARROT_ADS_IMPRINT_KEY);
}

function carrot_track_ad_clicks() {
	$url = explode('?', 'http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	$postid = url_to_postid($url[0]);
	//_dump($postid);
	$post=get_post($postid);
	

	if($post){

		if($post->post_type=='banners'){

			
			if(!carrot_has_post_cookie(CARROT_ADS_COOKIENAME,$post->ID)){
				carrot_inc_post_meta_num($post->ID,CARROT_ADS_CLICK_KEY);
			}
			carrot_set_post_cookie(CARROT_ADS_COOKIENAME);

			$bannerurl=get_field("url",$postid)? get_field("url",$postid): (get_field("link_intern",$postid)?get_field("link_intern",$postid):"#");
			wp_redirect($bannerurl,  301);
			exit;
		}
	}
}



//add_action( 'wp_head', 'carrot_track_ad_imprints');
add_action( 'init', 'carrot_track_ad_clicks');

if(carrot_ads_enabled()) siteorigin_widget_register('carrot-ads-widget', __FILE__, 'Carrot_ADS_Widget');