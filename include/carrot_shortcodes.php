<?php


function carrot_current_date( $atts ){

	setlocale(LC_TIME, "ca_ES");

	return strftime("%A, %e de %B de %Y");

}

function carrot_search_box( $atts ){
	$ret=carrot_get_template_content("search/search-box");
	return $ret;
}

function carrot_contact_info( $atts ){
	$ret=carrot_get_template_content("footer/contact-info");
	return $ret;
}

function carrot_social_bar( $atts ){
	$ret=carrot_get_template_content("footer/social-links");
	return $ret;

}
function carrot_cart( $atts ){
	if(function_exists('carrot_get_header_cart'))
		return carrot_get_header_cart();
	

}
function carrot_copyright( $atts ){
	$ret=carrot_get_template_content("footer/copyright");
	return $ret;
	

}

function carrot_get_button( $args ){
	if(function_exists("carrot_button")){
		ob_start();
		carrot_button($args);
		$output = ob_get_clean();	
		return $output;
	}
}


function carrot_shortcodes(){
	add_shortcode( 'copyright_info', 'carrot_copyright' );
	add_shortcode( 'current_date', 'carrot_current_date' );
	add_shortcode( 'contact_info', 'carrot_contact_info' );
	add_shortcode( 'social_bar', 'carrot_social_bar' );
	add_shortcode( 'search_box', 'carrot_search_box' );
	add_shortcode( 'carrot_woo_cart', 'carrot_cart' );
	add_shortcode( 'carrot_button', 'carrot_get_button' );
}

add_action( 'after_setup_theme', 'carrot_shortcodes' );

