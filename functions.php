<?php
/**
 * @package Carrot Theme
 */
 /*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
define ("THEME_PATH",dirname(__FILE__));
define ("THEME_NAME","carrottheme");
define ("THEME_URI",get_template_directory_uri());
define ("THEME_VERSION","3.0");


//required plugins
require_once dirname(__FILE__). "/include/tgmpa/inc.php";



require_once dirname(__FILE__)."/include/utils/utils.php";
require_once dirname(__FILE__)."/include/utils/color_utils.php"; 
require_once dirname(__FILE__)."/include/utils/video_utils.php";

require_once dirname(__FILE__)."/include/acf_utils.php";


require_once dirname(__FILE__)."/include/functions.php";  // theme inner functions (initializations)

require_once dirname(__FILE__)."/include/carrot_options.php"; //create admin pannels
require_once dirname(__FILE__)."/include/carrot_template_functions.php"; //  functions to use in templates
require_once dirname(__FILE__)."/include/carrot_shortcodes.php"; // theme shortcodes 

//theme presets
require_once dirname(__FILE__). "/include/carrotpreset.class.php";

//kirki customizer
require_once dirname(__FILE__)."/include/customizer/kirki_utils.php";
require_once dirname(__FILE__). "/include/customizer/kirki_setup.php";

//register sowidgets
require_once dirname(__FILE__). "/include/sowidgets/carrot-sowidgets.php";



function carrot_setup(){
	
	
	//thumb sizes
	carrot_init_thumbsizes();
	
	
	
	//text domain
	load_theme_textdomain( THEME_NAME, get_template_directory() . '/languages' );
	
	
	//enable acf
	carrot_init_custom_fields();
	
	//custom post types
	carrot_posttypes_init();
	
	//customizer options
	require_once dirname(__FILE__)."/include/customizer/kirki_options.php";
	carrot_customizer_init();
	
	
	//create default content
	carrot_create_starter_content();

	//init body classes
	add_filter( 'body_class', 'carrot_init_body_classes');
	add_filter( 'post_class', 'carrot_init_post_classes');



	//theme capabilities
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array('video', 'gallery') );
	
	
	//woocommerce support
	carrot_woocommerce_init();
		
	
	/*register menus*/
	carrot_register_menus();

	carrot_widgets_init();
	
	
	
	add_action( 'wp_enqueue_scripts', 'carrot_scripts_styles' ,21);
	add_action( 'admin_enqueue_scripts', 'carrot_admin_scripts_styles');
			
	// Replaces the excerpt "Read More" text by a link
	add_filter('excerpt_more', 'carrot_new_excerpt_more');
	add_filter('the_content_more_link', 'carrot_new_excerpt_more' );
	add_filter('excerpt_length', 'carrot_new_excerpt_length');
	add_filter('the_content', 'carrot_remove_empty_paragraphs', 20, 1);

	
	//add svg 
	add_filter('upload_mimes', 'carrot_mime_types');
	
	//custom archive title
	add_filter('get_the_archive_title', 'carrot_archive_title');

	
	//update search query
	add_action( 'pre_get_posts', 'carrot_modify_search_query' );

	
	//add single image header
	add_action( 'wp_head', 'carrot_insert_image_src_rel_in_head', 5 );
	add_action( 'wp_head', 'carrot_generate_web_app_meta_in_head', 6 );

	//carrot search ajax
	carrot_init_autosearch();
	
}


	
add_action( 'after_setup_theme', 'carrot_setup' );







