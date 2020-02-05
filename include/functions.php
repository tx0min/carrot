<?php




if ( ! function_exists( 'carrot_posttypes_init' ) ) :
function carrot_posttypes_init() {
	include_once dirname(__FILE__)."/carrot_posttypes.php";
	
	require dirname(__FILE__)."/posttypes/customposttype.class.php";
	require dirname(__FILE__)."/posttypes/customtaxonomy.class.php";
	
	
	
	$path=THEME_PATH."/posttypes/taxonomies/";
	
	//include taxonomies
	if(is_dir($path)){
		$files=scandir($path);
		if($files){
			foreach ($files as $file) {
				if (!is_dir($path.$file)){
					include_once $path.$file;
				}
			}
		}
	
	}
	
	
	//include types
	$path=THEME_PATH."/posttypes/posttypes/";
	
	//_dump($path);
	if(is_dir($path)){
		$files=scandir($path);
		//_dump($files);

		if($files){
			$classes=array();
			foreach ($files as $file) {
				if ($file != '..' && $file != '.' && is_dir($path.$file)){
					$classname=$path.$file."/".$file.".class.php";
					if(file_exists($classname)){
						$classes[]=$file;
						include_once $path.$file."/".$file.".class.php";
					}
				}
			}
			
			//register classes
			foreach ($classes as $classname) {
				$class = ucwords($classname);
				$object = new $class();
				$object->register();
			}
		}
	
	}
	
}
endif;	



if ( ! function_exists( 'carrot_create_starter_content' ) ) :
	function carrot_create_starter_content() {
		require dirname(__FILE__). '/carrot_starter-content.php' ;

	}
endif;

if ( ! function_exists( 'carrot_register_menus' ) ) :
	function carrot_register_menus() {
		if (function_exists('register_nav_menu')) {
			register_nav_menu('header-menu', __('Header Menu'));
			register_nav_menu('sticky-header-menu', __('Sticky Header Menu'));
			register_nav_menu('phone-menu', __('Phone Menu'));
			register_nav_menu('footer-menu', __('Footer Menu'));
		}
	}
endif;


if ( ! function_exists( 'carrot_widgets_init' ) ) :
function carrot_widgets_init() {
	$num=_opt("footer_columns");
	
	register_sidebar( array(
		'name' => __( "Blog Sidebar",  THEME_NAME ),
		'id' => "blog-sidebar",
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => __( "Single Post Sidebar",  THEME_NAME ),
		'id' => "post-sidebar",
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => __( "Pages Sidebar",  THEME_NAME ),
		'id' => "page-sidebar",
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	if(carrot_is_woocommerce_activated()){
		register_sidebar( array(
			'name' => __( "Shop Sidebar",  THEME_NAME ),
			'id' => "shop-sidebar",
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	}		
	for($i=1;$i<=$num;$i++){
		
		// Area 1, located at the top of the sidebar.
		register_sidebar( array(
			'name' => __( "Footer Widget Area $i",  THEME_NAME ),
			'id' => "footer-widgets-$i",
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	}
	
	

}
endif;	




if ( ! function_exists( 'carrot_scripts' ) ) :
	function carrot_scripts() {
	   	//wp_deregister_script( 'jquery');
		//wp_enqueue_script( 'jquery-theme',THEME_URI . '/assets/js/jquery/jquery-1.11.2.min.js' );
		//wp_enqueue_script( 'jquery-easing',THEME_URI . '/assets/js/jquery/jquery.easing-1.3.pack.js', array( 'jquery-theme' ) );
		//wp_enqueue_script( 'jquery-ui',THEME_URI . '/assets/js/jquery-ui/jquery-ui.min.js', array( 'jquery' ) );

		wp_enqueue_script( 'jquery-panzoom',THEME_URI . '/assets/js/panzoom/jquery.panzoom.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-lazyload',THEME_URI . '/assets/js/lazyload/jquery.lazyload.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery-mousewheel',THEME_URI . '/assets/js/jquery/jquery.mousewheel-3.0.6.pack.js' , array( 'jquery' ));


		/*wp_enqueue_script( 'cycle2', THEME_URI . '/assets/js/cycle2/jquery.cycle2.min.js', array( 'jquery' ));
		wp_enqueue_script( 'cycle2-swipe', THEME_URI . '/assets/js/cycle2/jquery.cycle2.swipe.min.js', array( 'cycle2','jquery' ));
		wp_enqueue_script( 'cycle2-scrollv', THEME_URI . '/assets/js/cycle2/jquery.cycle2.scrollVert.min.js', array( 'cycle2','jquery' ));
		wp_enqueue_script( 'cycle2-flip', THEME_URI . '/assets/js/cycle2/jquery.cycle2.flip.min.js', array( 'cycle2','jquery' ));
		wp_enqueue_script( 'cycle2-carousel', THEME_URI . '/assets/js/cycle2/jquery.cycle2.carousel.min.js', array( 'cycle2','jquery' ));

		*/
		wp_enqueue_script( 'owl-carousel', THEME_URI. '/assets/js/owl-carousel/owl.carousel.min.js', array('jquery') );
		


		
		/*
		wp_enqueue_script( 'theme-photoswipe', THEME_URI . '/assets/js/photoswipe/photoswipe.min.js', array( 'jquery' ));
		wp_enqueue_script( 'theme-photoswipe-ui', THEME_URI . '/assets/js/photoswipe/photoswipe-ui-default.min.js', array( 'theme-photoswipe' ));
		wp_enqueue_script( 'theme-photoswipe-init', THEME_URI . '/assets/js/photoswipe/photoswipe-init.js', array( 'theme-photoswipe' ));
		*/

		wp_enqueue_script( 'theme-venobox', THEME_URI . '/assets/js/venobox/venobox.min.js', array( 'jquery' ));
		
		
		
		/*wp_enqueue_script( 'theme-fancybox', THEME_URI . '/assets/js/fancybox/jquery.fancybox.pack.js', array( 'jquery' ));
		wp_enqueue_script( 'theme-fancybox-media', THEME_URI . '/assets/js/fancybox/helpers/jquery.fancybox-media.js', array( 'jquery' ));
		wp_enqueue_script( 'theme-fancybox-thumbs', THEME_URI . '/assets/js/fancybox/helpers/jquery.fancybox-thumbs.js', array( 'jquery' ));
		*/
		/*wp_enqueue_script( 'theme-fancybox3', THEME_URI . '/assets/js/fancybox/jquery.easing-1.3.pack.js');*/
		
		
		wp_enqueue_script( 'isotope1',THEME_URI . '/assets/js/isotope/imagesloaded.pkgd.min.js' , array( 'jquery' ));
		wp_enqueue_script( 'isotope2',THEME_URI . '/assets/js/isotope/isotope.pkgd.min.js' , array( 'jquery' ));
		wp_enqueue_script( 'isotope3',THEME_URI . '/assets/js/isotope/packery-mode.pkgd.min.js' , array( 'jquery' ));
		
		wp_enqueue_script( 'columnizer',THEME_URI . '/assets/js/columnizer/jquery.columnizer.js' , array( 'jquery' ));
		
		wp_enqueue_script( 'theme-hypher', THEME_URI . '/assets/js/hypher/jquery.hypher.js', array( 'jquery' ));
		wp_enqueue_script( 'theme-hypher-ca', THEME_URI . '/assets/js/hypher/ca.js', array( 'theme-hypher' ));
		wp_enqueue_script( 'theme-hypher-es', THEME_URI . '/assets/js/hypher/es.js', array( 'theme-hypher' ));
		wp_enqueue_script( 'theme-hypher-es-es', THEME_URI . '/assets/js/hypher/es_ES.js', array( 'theme-hypher' ));


		wp_enqueue_script( 'select2', THEME_URI . '/assets/js/select2/js/select2.full.min.js', array( 'jquery' ));
		
		wp_enqueue_script( 'bootstrap', THEME_URI . '/assets/js/bootstrap/js/bootstrap.min.js', array( 'jquery' ));
		wp_enqueue_script( 'theme-common', THEME_URI . '/assets/js/theme-common.js', array( 'jquery' ));
		wp_localize_script( 'theme-common', 'carrot_ajax',
			array(
				'baseurl' => THEME_URI,
				'texts' =>array(
					"next" =>__("Next",THEME_NAME),  
					"prev" =>__("Previous",THEME_NAME), 
					"loading" =>__("Loading",THEME_NAME)
				),
				'icons' => array(
					"search" => _icon("icon_search"),
					"close" => _icon("icon_close"),
					"right" => _icon("icon_angle_right"),
					"left" => _icon("icon_angle_left"),
					"loading" => _icon("icon_loading","spin"),
					"pagination" => _icon("icon_pagination_item"),
					"pause" => _icon("icon_video_pause"),
					"play" => _icon("icon_video_play")
				)
			)
			
		);
		
		
		//autosearch
		wp_enqueue_script( 'carrot-autosearch', THEME_URI . '/assets/js/theme-autosearch.js', array( 'jquery' ) );
		wp_localize_script( 'carrot-autosearch', 'CarrotAutosearch', 
			array( 
				'url' => admin_url( 'admin-ajax.php' ),
				'autocomplete' => _o("use_autosearch"),
				'texts' => array(
					'no_results' => __( 'No results found', THEME_NAME )
				)
			)
		);
		
		
	}
endif;


if ( ! function_exists( 'carrot_styles' ) ) :
	function carrot_styles() {
	   	wp_enqueue_style( 'bootstrap', THEME_URI .'/assets/js/bootstrap/css/bootstrap.min.css' );
	   	wp_enqueue_style( 'flex-grid', THEME_URI .'/assets/style/flexboxgrid.css' );
        wp_enqueue_style( 'themify-icons', THEME_URI .'/assets/style/themify-icons.css');
        wp_enqueue_style( 'fontawesome-icons', THEME_URI .'/assets/style/font-awesome.min.css');
        wp_enqueue_style( 'base', THEME_URI .'/assets/style/base.css');
		
		
        //wp_enqueue_style( 'custom', THEME_URI .'/assets/style/custom.css');
        wp_enqueue_style( 'social', THEME_URI .'/assets/style/social.css');
        wp_enqueue_style( 'animation', THEME_URI .'/assets/style/animation.css');
        wp_enqueue_style( 'toolkit', THEME_URI .'/assets/style/toolkit.css');
       
        /*
        wp_enqueue_style( 'photoswipe', THEME_URI .'/assets/js/photoswipe/photoswipe.css');
        wp_enqueue_style( 'photoswipe-skin', THEME_URI .'/assets/js/photoswipe/default-skin/default-skin.css');
		*/
        wp_enqueue_style( 'venobox', THEME_URI .'/assets/js/venobox/venobox.css');
		
        /*wp_enqueue_style( 'fancybox', THEME_URI .'/assets/js/fancybox/jquery.fancybox.css');
        wp_enqueue_style( 'fancybox-thumbs', THEME_URI .'/assets/js/fancybox/helpers/jquery.fancybox-thumbs.css');*/
		
        wp_enqueue_style( 'select2', THEME_URI .'/assets/js/select2/css/select2.min.css');
       
        
		wp_enqueue_style( 'owl-carousel',THEME_URI . '/assets/js/owl-carousel/owl.carousel.min.css');
		wp_enqueue_style( 'owl-theme-carrot',THEME_URI . '/assets/js/owl-carousel/owl.theme.carrot.css');
        wp_enqueue_style( 'owl-animate',THEME_URI . '/assets/js/owl-carousel/owl.animate.css');
            

		//wp_enqueue_style( 'dynamic', THEME_URI .'/assets/style/dynamic.css.php'.(is_single()?"?single=".get_the_ID():"") );
        wp_enqueue_style( 'scrollbar', THEME_URI .'/assets/style/scrollbar.css');
		
        
		
		
		
	}
endif;


if ( ! function_exists( 'carrot_scripts_styles' ) ) :
	function carrot_scripts_styles(){
		carrot_scripts();
		carrot_styles();
		//do_action("carrot_after_include_scripts");
		
		$selected_preset=carrot_get_current_preset(true);//carrot_get_current_preset();
		//_dump($selected_preset);
		if($selected_preset) $selected_preset->register();
		
	}
endif;


if ( ! function_exists( 'carrot_admin_scripts_styles' ) ) :
	function carrot_admin_scripts_styles(){
		wp_enqueue_script( 'theme-admin', THEME_URI . '/assets/js/theme-admin.js', array( 'jquery' ));
		wp_enqueue_style( 'theme-admin', THEME_URI .'/assets/style/admin.css');
		wp_enqueue_style( 'blocks-admin', THEME_URI .'/assets/style/blocks.css');

	}
endif;



if ( ! function_exists( 'carrot_init_custom_fields' ) ) :
	function carrot_init_custom_fields(){
		include_once dirname(__FILE__)."/acf_options.php";
	}
endif;


if ( ! function_exists( 'carrot_new_excerpt_more' ) ) :
	function carrot_new_excerpt_more($more) {
		global $post;
		return '&hellip;';//<a class="moretag" href="'. get_permalink($post->ID) . '">'._icon("icon_plus").'</a>';
	}
endif;

if ( ! function_exists( 'carrot_new_excerpt_length' ) ) :
	function carrot_new_excerpt_length($length) {
		return 30;
	}
endif;

if ( ! function_exists( 'carrot_mime_types' ) ) :
	function carrot_mime_types($mimes) {
	  $mimes['svg'] = 'image/svg+xml';
	  return $mimes;
	}
endif;



if ( ! function_exists( 'carrot_archive_title' ) ) :
	function carrot_archive_title($title) {
		if ( is_search() ) {
			$title= "<span class='text-primary text-sm '>"._icon("icon_search")."</span> ". sprintf( esc_html__( 'You searched: %s', THEME_NAME ), '<span>' . get_search_query() . '</span>' ); 
		} elseif ( is_category() ) {
			$title = "<span class='text-primary text-sm'>"._icon("icon_category")."</span> ". single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = "<span class='text-primary text-sm '>"._icon("icon_tag")."</span> ".single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
			$title = "<span class='text-primary text-sm '>"._icon("icon_calendar")."</span> ".get_the_date( __( 'Y', THEME_NAME ) );
		} elseif ( is_month() ) {
			$title = "<span class='text-primary text-sm '>"._icon("icon_calendar")."</span> ".get_the_date( __( 'F Y', THEME_NAME ) );
		} elseif ( is_day() ) {
			$title = "<span class='text-primary text-sm '>"._icon("icon_calendar")."</span> ".get_the_date( __( 'F j, Y', THEME_NAME ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = __( 'Asides', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = __( 'Galleries', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = __( 'Images', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = __( 'Videos', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = __( 'Quotes', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = __( 'Links', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = __( 'Statuses', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = __( 'Audio', THEME_NAME );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = __( 'Chats', THEME_NAME );
			}
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = "<span class='text-primary text-sm '>"._icon("icon_category")."</span> ". single_term_title( '', false );
		} else {
			$title = __( 'Archives' ,THEME_NAME);
		}
		return $title;
	}
endif;

if ( ! function_exists( 'carrot_get_thumbsizes' ) ) :
	function carrot_get_thumbsizes(){
		$thumbsizes=array(
			'mini-icon' => array(48, 48 ),
			'icon' => array(96, 96 ),
			'heading-size'=> array(1200, 250 ),
			'heading-big'=> array(1200, 450 ),
			'landscape'=> array(350, 245 ),
			'square'=> array(350, 350 ),
			'square-big'=> array(650, 650 ),
			'portrait'=> array(245, 350 )
			
		);
		return $thumbsizes;
	}
endif;


if ( ! function_exists( 'carrot_get_thumbsizes_dropdown' ) ) :
	function carrot_get_thumbsizes_dropdown(){
		global $_wp_additional_image_sizes;

		$default_image_sizes = array( 'thumbnail', 'medium', 'large' );
		$image_sizes=array();
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}

		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		
		$ret=array();
		$ret["full"]=__("Full size",THEME_NAME);
		foreach($image_sizes as $id=>$size){
			$ret[$id]= $id . " (".$size["width"]."x".$size["height"]."px)";
		}
		
		return $ret;
	}
endif;

if ( ! function_exists( 'carrot_get_thumbsize' ) ) :
	function carrot_get_thumbsize($size){
		$thumbsizes=carrot_get_thumbsizes();
		if($thumbsizes && is_array($thumbsizes) && array_key_exists($size,$thumbsizes))
			return $thumbsizes[$size];
		return false;
		
	}
endif;


if ( ! function_exists( 'carrot_init_thumbsizes' ) ) :
	function carrot_init_thumbsizes(){
		$thumbsizes=carrot_get_thumbsizes();
		if($thumbsizes && is_array($thumbsizes) && count($thumbsizes)>0){
			foreach($thumbsizes as $key=>$thumbsize){
				add_image_size( $key, $thumbsize[0], $thumbsize[1], true );
			}
		}

	}
endif;



// setup a function to check if these pages exist
if ( ! function_exists( 'carrot_the_slug_exists' ) ) :
	function carrot_the_slug_exists($post_name) {
		global $wpdb;
		if($wpdb->get_row("SELECT post_name FROM ".$wpdb->prefix ."posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
			return true;
		} else {
			return false;
		}
	}
endif;


if ( ! function_exists( 'carrot_init_body_classes' ) ) :
	function carrot_init_body_classes( $classes ) {
		    //$kirki_classes=array();
		    if(_o("site_fullwidth")) $classes[]="fullwidth";
		    if(_o("always_show_drawer")) $classes[]="show-drawer";
		
			$classes[]="site-loading";
			$classes[]="theme-preset-".carrot_get_current_preset();
		    $classes[]="drawer-"._o("drawer_position");
		
			//if(carrot_has_sticky_header() && !carrot_sticky_header_is_minified()) $bodyclass=array('header-sticky');
			//if(carrot_has_sticky_header() && carrot_sticky_header_is_minified()) $bodyclass=array('sticky-minified');
			if(is_page() && !is_front_page()) $classes[]='single';
			
		     return $classes;
	} 
endif;



if ( ! function_exists( 'carrot_init_post_classes' ) ) :
	function carrot_init_post_classes( $classes ) {
		//$kirki_classes=array();
		$type=get_post_type();
		//_dump($type);
		//_dump(is_single()?"SI":"NO");
		//if($type=="product" && is_shop()) $classes[]="tile";
		//!is_product() && !is_search() && !is_archive() ) $classes[]="tile";

		
		return $classes;
	} 
endif;





if ( ! function_exists( 'header_class' ) ) :
	function header_class() {
	    $header_class=array();
	    $header_type=_opt("header_type");


		$header_class=array($header_type);
		
		if(carrot_is_normal_header()){
			$headerbgcolortype=_opt("header_background_color");
			
			$header_class[]="bg-".$headerbgcolortype;
			
			if(_opt("fullwidth_header")=='1') $header_class[]="header-fullwidth";
		}
		
		echo implode(" ",$header_class);

			
	} 
endif;


if ( ! function_exists( 'footer_class' ) ) :
	function footer_class() {
	    $classes=array();
	    
	    $footerbgcolortype=_o("footer_background_color");
		$classes=array();
		if(carrot_is_normal_footer()){
			$classes[]="normal";
			$classes[]="bg-".$footerbgcolortype;
			if(_o("show_sub_footer")) $classes[]="withsub";
			if(_opt("fullwidth_footer")=='1') $classes[]="footer-fullwidth";

		}
		echo implode(" ",$classes);


			
	} 
endif;

if ( ! function_exists( 'subfooter_class' ) ) :
	function subfooter_class() {
	    $classes=array();
	    
		$subfooterbgcolortype=_o("subfooter_background_color");

	    $classes=array();
		if(carrot_is_normal_footer()){
			$classes[]="bg-".$subfooterbgcolortype;

		}
		echo implode(" ",$classes);


			
	} 
endif;



if ( ! function_exists( 'phone_menu_class' ) ) :
	function phone_menu_class($moreclasses=false) {
	    $classes=array("drawer-menu");
	    
		$classes[]="style-"._o("drawer_style");
		$classes[]="align-"._o("drawer_position");
		$classes[]="bg-"._o("drawer_background_color");
		$classes[]="layout-"._o("drawer_layout");
		if(_o("drawer_show_overlay")) $classes[]="with-overlay";
		//$bgcolortype=_o("drawer_background_color");
		
		//$classes[]="bg-".$bgcolortype ;
		/*if(carrot_is_normal_drawer()){
	
		}*/
		if($moreclasses) $classes=array_merge($classes, $moreclasses);
		
		echo implode(" ",$classes);


			
	} 
endif;


if ( ! function_exists( 'phone_drawer_class' ) ) :
	function phone_drawer_class($moreclasses=false) {
	    $classes=array();
	    
		$classes[]="bg-"._o("drawer_background_color");
		if($moreclasses) $classes=array_merge($classes, $moreclasses);
		
		echo implode(" ",$classes);


			
	} 
endif;




if ( ! function_exists( 'sticky_header_class' ) ) :
	function sticky_header_class() {
	    $classes=array();
	    
	    $headerbgcolortype=_o("header_background_color");
		if(carrot_is_normal_sticky_header() && carrot_is_normal_header()){
			$classes[]="bg-".$headerbgcolortype;
			if(_o("fullwidth_header")=='1') $classes[]="sticky-header-fullwidth";
		}
		
		echo implode(" ",$classes);


			
	} 
endif;



if ( ! function_exists( 'loop_class' ) ) :
	function loop_class() {
	   
		$classes=array("clearfix","articles-container");
		$isarchive=(is_archive() || is_search());
		if($isarchive){
			$style=_o('archive_style');
			$classes[]="archive";			
		}else{
			$style=_o('blog_style');
			$classes[]="blog";			
		}
		
		
		$classes[]=$style;
		
		if($style!="classic"){
			if($isarchive){
				$gap=_o('archive_tile_gap');
				if($style=="grid") $columns=_o("archive_columns");
				else $columns=1;
			}else{
				$gap=_o('blog_tile_gap');
				if($style=="grid") $columns=_o("blog_columns");
				else $columns=1;
			}
			$classes[]="gap-".$gap;
			$classes[]="cols-".$columns;
		}


		
		echo implode(" ",$classes);


			
	} 
endif;




if ( ! function_exists( 'sidebar_class' ) ) :
	function sidebar_class() {
	    

		if(is_archive() || is_search()){
			$sidebar=_o('archive_sidebar');
			$sidebar_columns=_o('archive_sidebar_columns');
			
		}else{				
			$sidebar=_o('blog_sidebar');
			$sidebar_columns=_o('sidebar_columns');				
		}

		
		
		$classes=array("sidebar");
		$classes[]="sidebar-".$sidebar;
		$classes[]="sidebar-cols-".$sidebar_columns;

		echo implode(" ",$classes);


			
	} 
endif;

if ( ! function_exists( 'archive_class' ) ) :
	function archive_class() {
	    global $wp_query;
	    $term =	$wp_query->queried_object;
	
	    $classes=array('archive-header','clearfix');
		
		//$classes[]="bg-"._o('archive_bg');

		if($term && isset($term->taxonomy) && in_array($term->taxonomy,array("category"))){
			$classes[]="archive-category";
		}else if(is_author()){
			$classes[]="archive-user";
		}

	

		echo implode(" ",$classes);


			
	} 
endif;


if ( ! function_exists( 'carrot_post_class' ) ) :
	function carrot_post_class($moreclasses=false) {
	    
		$classes = array('post-article','clearfix','article-single');
		$classes[]= "post-template-".carrot_get_single_post_template();
		
		if(gf("capital_inicial")) $classes[]="dropcaps";
		if(gf("columnize")) $classes[]="columnize";
		if(gf("hyphenate")) $classes[]="hyphenate";
		if(carrot_has_post_featured()) $classes[]="with-featured";
	    
		if($moreclasses) $classes=array_merge($classes, $moreclasses);
		
		post_class($classes);


			
	} 
endif;

if ( ! function_exists( 'carrot_page_class' ) ) :
	function carrot_page_class($moreclasses=false) {
	    
		
		$classes = array('page-article','clearfix');
		
		if(carrot_page_builder_enabled()) $classes[]='page-builder-enabled';
			
	
		if(!carrot_page_title_is_visible()) $classes[]="hidetitle";
		if(!carrot_page_breadcrumb_is_visible()) $classes[]="hidebreadcrumb";
		if(gf("capital_inicial")) $classes[]="dropcaps";
		if(gf("columnize")) $classes[]="columnize";
		if(gf("hyphenate")) $classes[]="hyphenate";
	    
		if($moreclasses) $classes=array_merge($classes, $moreclasses);
		
		post_class($classes);


			
	} 
endif;

if ( ! function_exists( 'carrot_posttype_class' ) ) :
	function carrot_posttype_class($moreclasses=false) {
	    
		$type=get_post_type();
		$classes = array('article-single','clearfix',$type.'-single');
		
		$classes[]= "posttype-template-".carrot_get_single_post_template($type);
		
		$bgcolor=get_field("bgcolor");
		if( $bgcolor!="none"){
			$classes[]="bg-".$bgcolor;
		}
		
		if($moreclasses) $classes=array_merge($classes, $moreclasses);
		
		echo implode(" ",$classes);


			
	} 
endif;

if ( ! function_exists( 'carrot_woocommerce_class' ) ) :
	function carrot_woocommerce_class($moreclasses=false) {
	    
		
		$classes=array("articles-container","products");
		$style=_o('woo_style');
		$classes[]="grid";//$style;
		
		$gap=_o('woo_tile_gap');
		if($style=="grid") $columns=_o("woo_columns");
		else $columns=1;
		
		$classes[]="gap-".$gap;
		$classes[]="cols-".$columns;
		


		
		echo implode(" ",$classes);


			
	} 
endif;



if ( ! function_exists( 'post_display_options' ) ) :
	function post_display_options(){	
		$thumbsize="medium";

		if(is_archive() || is_search()){
			$show_featured=_o('archive_featured');
			$show_title=_o('archive_title');
			$show_date=_o('archive_date');
			$show_excerpt=_o('archive_excerpt');
			$show_content=_o('archive_content');
			$show_categories=_o('archive_categories');
			$show_comments=_o('archive_comments');
			$show_author=_o('archive_author');	
			$thumb_position=_o('archive_thumb_position');
			$thumbcols=_o('archive_thumb_columns');
			if($thumb_position=='top'|| $thumb_position=='bottom'){
				$thumbsize=_o('archive_thumbsize');
			}
		}else{
			$show_featured=_o('show_featured');
			$show_title=_o('show_title');
			$show_date=_o('show_date');
			$show_excerpt=_o('show_excerpt');
			$show_content=_o('show_content');
			$show_categories=_o('show_categories');
			$show_comments=_o('show_comments');
			$show_author=_o('show_author');		
			$thumb_position=_o('blog_thumb_position');
			$thumbcols=_o('blog_thumb_columns');
			if($thumb_position=='top'|| $thumb_position=='bottom'){
				$thumbsize=_o('blog_thumbsize');
			}
		}
		

		
		if(!$show_featured || $thumb_position=='top'||$thumb_position=='bottom'){
			$thumbcols=12;
		}

		
		
		
		$classes = array(
			'thumb-'.$thumb_position
			
		);
		
		$author=false;
		if($show_author){
			$author=array(
				"name"=>true,
				"avatar"=>false,
				"bio"=>false,
				"prefix"=>__("Text: ",THEME_NAME),
				"twitter"=>false
			);
		}

		$showoptions=array(
			"classes"=>$classes,
			"thumbcols"=>$thumbcols,
			"thumbsize"=>$thumbsize,
			"hovereffect"=>array(
				"effect" =>"zoom",
				"bgcolor" =>"primary",
				"fgcolor" =>"",
				"show_text" =>false,
				"view_more" =>true,
				"view_more_icon" =>"",
				"title" =>false,
				"view_more_pos_h" =>"center",
				"view_more_pos_v" =>"middle",
				"title_pos_h" =>"",
				"title_pos_v" =>"",
			),
			"responsive"=>true,
			"show_options"=>array(
				"thumbnail" =>$show_featured,
				"title" =>$show_title,
				"date" =>$show_date,
				"categories" =>$show_categories,
				"tags" =>false,
				"author" =>$author,
				"excerpt" =>$show_excerpt,
				"content" =>$show_content,
				"commentscount" =>$show_comments,
			),
			"thumbnail_position"=>$thumb_position,
			"thumbnail_image_type"=> "featured"
		);	
		
		return $showoptions;

	}

endif;


if ( ! function_exists( 'carrot_get_current_preset' ) ) :
	function carrot_get_current_preset($object=false){	
		$ret="clean";
		$ret = get_option("carrot_preset","clean");
		
		//_dump($ret);

		if($object){
			$style_presets= carrot_get_presets();	
			//_dump($style_presets);
			if(array_key_exists($ret,$style_presets)) return $style_presets[$ret];
			else return array_shift(array_values($style_presets));  //return first

		}else{
			return $ret;
		}
	}
endif;




if ( ! function_exists( 'carrot_get_template_part_path' ) ) :
	function carrot_get_template_part_path($slug,$name='',$woocommerce=false){	
		$preset=carrot_get_current_preset();
		
		$basepath= THEME_PATH.'/presets/'.carrot_get_current_preset().'/';
		if($woocommerce) $basepath.='woocommerce/';
		else $basepath.='templates/';
		//_dump($basepath);
		//_dump("CARROT:".$basepath . "{$slug}-{$name}.php");
		
		$path="";
		if(file_exists($basepath . "{$slug}-{$name}.php")){
			$path=$basepath . "{$slug}-{$name}.php";
		}else if(file_exists($basepath . "{$slug}.php")){
			$path=$basepath . "{$slug}.php";
		}else if(file_exists(THEME_PATH . "/templates/{$slug}-{$name}.php")){
			$path=THEME_PATH . "/templates/{$slug}-{$name}.php";
		}else if(file_exists(THEME_PATH . "/templates/{$slug}.php")){
			$path=THEME_PATH . "/templates/{$slug}.php";
		}
		//_dump("CARROT:".$path);
		return $path;
		
	}
endif;



if ( ! function_exists( 'carrot_get_template_part' ) ) :
	function carrot_get_template_part($slug,$name='',$woocommerce=false, $args=false){	
        global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

		$path=carrot_get_template_part_path($slug,$name,$woocommerce);
		if(file_exists($path)){
			if($args){
				if(is_array($args)){
					foreach ( $args as $key => $value ) { $$key = $value; }
				}
			}
			//_dump($path);
			include( $path);
		}
	}
endif;



if ( ! function_exists( 'carrot_get_template_content' ) ) :
	function carrot_get_template_content($p,$args=''){
		
		ob_start();
		carrot_get_template_part($p,'',false, $args);
		$output = ob_get_clean();
		return $output;
	}
endif;




if ( ! function_exists( 'carrot_get_presets_names' ) ) :
	function carrot_get_presets_names(){	
		$style_presets= carrot_get_presets();		
		$ret=array();
		foreach($style_presets as $slug=>$preset){
			$ret[$slug]=$preset->name;
		}
		return $ret;
	}
endif;


if ( ! function_exists( 'carrot_get_presets' ) ) :
	function carrot_get_presets(){	
		$path=THEME_PATH."/presets/";
		//_dump($path);
		$ret=array();
		if(!is_dir($path)) return $ret;
			
		$files=scandir($path);
		//_dump($files);

		if($files){
			foreach ($files as $file) {
				if ($file != '..' && $file != '.' && is_dir($path.$file)){
					$style= $path.$file."/style.css";
					if(file_exists($style)){
						$preset = new CarrotPreset();
						$preset->slug=$file; 
						
						$headers=get_file_data($style,array("Name","Description","Author"));
						if($headers){
							$preset->name=$headers[0]; 
							$preset->description=$headers[1]; 
							$preset->author=$headers[2]; 
						}else{
							$preset->name=$file;
							
						}

						$functions= $path.$file."/".$file.".php";
						if(file_exists($functions)){
							unset($defaults);
							unset($styles);
							unset($scripts);
							include $path.$file."/".$file.".php";
							
							if(isset($defaults)){
								$preset->defaults=$defaults;
								unset($defaults);
							}
							if(isset($styles)){
								$preset->styles=$styles;
								unset($styles);
							}
							if(isset($scripts)){
							 	$preset->scripts=$scripts;
							 	unset($scripts);
							}
							if(isset($customizerelements)){
								$preset->customizerelements=$customizerelements;
								unset($customizerelements);
							}
							
							
						}
						$ret[$preset->slug]= $preset;
					}
				}
				/*$extension = pathinfo($file, PATHINFO_EXTENSION);
				$name = pathinfo($file, PATHINFO_FILENAME);

				if (strtoupper($extension) == 'CSS') {
					//_dump($file);
					$headers=get_file_data($path.$file,array("Preset Name"));
					if($headers){
						$ret[$name]=$headers[0]; 
					}else{
						$ret[$name]=$name; 
					}
				}*/
			}
		}
		return $ret;

	}
endif;



if ( ! function_exists( 'carrot_get_post_templates' ) ) :
	function carrot_get_post_templates($tile=false){	
		
		$basepaths= array( THEME_PATH.'/presets/'.carrot_get_current_preset().'/templates/', THEME_PATH."/templates/");
		$ret=array();

		if(!$tile)  $ret[""]=__("--Default site template--", THEME_NAME);

		foreach($basepaths as $path){
			if($tile) $path.="tile/";
			else $path.="post/";
				
			if(file_exists($path)){
				//_dump($path);
				//$ret=array();
				if(!is_dir($path)) return $ret;
					
				$files=scandir($path);
				//_dump($files);

				if($files){
					foreach ($files as $file) {
						$filepath=$path.$file;
						if (!is_dir($filepath)){
							$extension = pathinfo($file, PATHINFO_EXTENSION);
							$name = pathinfo($file, PATHINFO_FILENAME);
							if($extension=="php" && file_exists($filepath)){
								$headers=get_file_data($filepath,array("Template Name"));
								if($headers){
									$ret[$name]=$headers[0]; 
								}else{
									$ret[$name]=$name; 
								}	

							}
						}
						
					}
				}
			}
		}
		return $ret;

	}
endif;





function carrot_get_single_post_template($posttype='post'){
	$field="single_".$posttype."_template";
	if(gf($field)) return gf($field);
	else return _o($field,'default');
	
	
	
}

	
if ( ! function_exists( 'carrot_get_all_blocks' ) ) :
	function carrot_get_all_blocks(){
		$blocks=array(0=>__("-- Select a Block --",THEME_NAME));
		
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
endif;

if ( ! function_exists( 'carrot_remove_empty_paragraphs' ) ) :
	function carrot_remove_empty_paragraphs($content){
		//remove empty <p>
		//$content ="HOLA-----".$content;
		$content = force_balance_tags($content);
		$content = str_replace("<p></p>","",$content);
		$content = str_replace("<p>&nbsp;</p>","",$content);
		$content=preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
		//$content =$content."-----ADIOS";
		
		return $content;
	}
endif;

		
		
		
if ( ! function_exists( 'carrot_modify_search_query' ) ) :
	function carrot_modify_search_query($query) {
		if ( $query->is_search ) {
			//_dump($query);
			//$query->set('post_type', array('post'));
			//_dump($query->get('post_type'));
		}
	}
endif;

		
		
		
				
		
if ( ! function_exists( 'carrot_breadcrumb' ) ) {
	// Breadcrumbs
	function carrot_breadcrumb(){
		// Settings
		$separator          = _icon("icon_angle_left");
		$breadcrums_id      = 'breadcrumbs';
		$breadcrums_class   = 'breadcrumbs';
		$home_title         = __('Home',THEME_NAME);
		// if(is_archive()) $home_title=__("Archive",THEME_NAME);
		// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
		$custom_taxonomy    = 'product_cat';
		   
		// Get the query & post information
		global $post,$wp_query;
		   
		// Do not display on the homepage
		if ( !is_front_page() ) {
		   
			// Build the breadcrums
			echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
			   
			// Home page
			echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
			echo '<li class="separator separator-home"> ' . $separator . ' </li>';
			   
			if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
				  
				echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title("", false) . '</strong></li>';
				  
			} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
				  
				// If post is a custom post type
				$post_type = get_post_type();
				  
				// If it is a custom post type display name and link
				if($post_type != 'post') {
					  
					$post_type_object = get_post_type_object($post_type);
					$post_type_archive = get_post_type_archive_link($post_type);
				  
					echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
					echo '<li class="separator"> ' . $separator . ' </li>';
				  
				}
				  
				$custom_tax_name = get_queried_object()->name;
				echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
				  
			} else if ( is_single() ) {
				  
				// If post is a custom post type
				$post_type = get_post_type();
				  
				// If it is a custom post type display name and link
				if($post_type != 'post') {
					  
					$post_type_object = get_post_type_object($post_type);
					$post_type_archive = get_post_type_archive_link($post_type);
				  
					echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
					echo '<li class="separator"> ' . $separator . ' </li>';
				  
				}
				  
				// Get post category info
				$category = get_the_category();
				 
				if(!empty($category)) {
				  
					// Get last category post is in
					$last_category = $category[count($category)-1];
					  
					// Get parent any categories and create array
					$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
					$cat_parents = explode(',',$get_cat_parents);
					  
					// Loop through parent categories and store in variable $cat_display
					$cat_display = '';
					foreach($cat_parents as $parents) {
						$cat_display .= '<li class="item-cat">'.$parents.'</li>';
						$cat_display .= '<li class="separator"> ' . $separator . ' </li>';
					}
				 
				}
				  
				// If it's a custom post type within a custom taxonomy
				$taxonomy_exists = taxonomy_exists($custom_taxonomy);
				if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
					  
					$taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
					if($taxonomy_terms){
						$cat_id         = $taxonomy_terms[0]->term_id;
						$cat_nicename   = $taxonomy_terms[0]->slug;
						$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
						$cat_name       = $taxonomy_terms[0]->name;
					}
				   
				}
				  
				// Check if the post is in a category
				if(!empty($last_category)) {
					echo $cat_display;
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
					  
				// Else if post is in a custom taxonomy
				} else if(!empty($cat_id)) {
					  
					echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
					echo '<li class="separator"> ' . $separator . ' </li>';
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
				  
				} else {
					  
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
					  
				}
				  
			} else if ( is_category() ) {
				   
				// Category page
				echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
				   
			} else if ( is_page() ) {
				   
				// Standard page
				if( $post->post_parent ){
					   
					// If child page, get parents 
					$anc = get_post_ancestors( $post->ID );
					   
					// Get parents in the right order
					$anc = array_reverse($anc);
					   
					// Parent page loop
					if ( !isset( $parents ) ) $parents = null;
					foreach ( $anc as $ancestor ) {
						$parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
						$parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
					}
					   
					// Display parent pages
					echo $parents;
					   
					// Current page
					echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
					   
				} else {
					   
					// Just display current page if not parents
					echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
					   
				}
				   
			} else if ( is_tag() ) {
				   
				// Tag page
				   
				// Get tag information
				$term_id        = get_query_var('tag_id');
				$taxonomy       = 'post_tag';
				$args           = 'include=' . $term_id;
				$terms          = get_terms( $taxonomy, $args );
				$get_term_id    = $terms[0]->term_id;
				$get_term_slug  = $terms[0]->slug;
				$get_term_name  = $terms[0]->name;
				   
				// Display the tag name
				echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
			   
			} elseif ( is_day() ) {
				   
				// Day archive
				   
				// Year link
				echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
				echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
				   
				// Month link
				echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
				echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
				   
				// Day display
				echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
				   
			} else if ( is_month() ) {
				   
				// Month Archive
				   
				// Year link
				echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
				echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
				   
				// Month display
				echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
				   
			} else if ( is_year() ) {
				   
				// Display year archive
				echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
				   
			} else if ( is_author() ) {
				   
				// Auhor archive
				   
				// Get the author information
				global $author;
				$userdata = get_userdata( $author );
				   
				// Display author name
				echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
			   
			} else if ( get_query_var('paged') ) {
				   
				// Paginated archives
				echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
				   
			} else if ( is_search() ) {
			   
				// Search results page
				echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="' . get_search_query() . '">' . get_search_query() . '</strong></li>';
			   
			} elseif ( is_404() ) {
				   
				// 404 page
				echo '<li>' . 'Error 404' . '</li>';
			}
		   
			echo '</ul>';
			   
		}
	
	}
}


if ( ! function_exists( 'carrot_page_builder_enabled' ) ) {
	function carrot_page_builder_enabled(){
		global $post;
		//_dump($post);
		if(get_post_meta( get_the_ID(), 'panels_data',true)) return true;
		return false;
	}

}

if ( ! function_exists( 'carrot_is_sharing_active' ) ) {
	function carrot_is_sharing_active(){
		return function_exists('ADDTOANY_SHARE_SAVE_KIT');
	}
}


/** woocommerce */
if ( ! function_exists( 'carrot_is_woocommerce_activated' ) ) {
	function carrot_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'authors_enabled' ) ) {
	function authors_enabled(){
		if(function_exists("carrot_authors_woocommerce_enabled")) return carrot_authors_woocommerce_enabled();//opt("enable_authors");
		else return false;
		
	} 
}

if ( ! function_exists( 'carrot_woocommerce_init' ) ) {
	function carrot_woocommerce_init() {

		if ( carrot_is_woocommerce_activated() ){
			add_theme_support( 'woocommerce' );
			/*global $carrot_woocommerce;
			$carrot_woocommerce = */
			require THEME_PATH.'/include/woocommerce/class-carrot-woocommerce.php';
			require THEME_PATH.'/include/woocommerce/carrot-woocommerce-template-functions.php';
			$presetwoo= THEME_PATH.'/presets/'.carrot_get_current_preset().'/class-'.carrot_get_current_preset().'-woocommerce.php';
	//		_dump($presetwoo);
			if(file_exists($presetwoo)){
				require_once $presetwoo;
			}
			//
			
		}
		
	}
}

if ( ! function_exists( 'carrot_embed_code' ) ) {
	function carrot_embed_code($url, $args=false){
		//echo $url;
		
		$embed=wp_oembed_get($url, $args);
		if(!$embed){
			if($args && is_array($args)){
				$attrs=array();
				foreach($args as $name=>$val){
					$attrs[]=$name."='".$val."'";
				}
			}
			return  "<iframe src='".$url."' class='carrot_embed' src='' frameborder='0' allowtransparency='true' allowfullscreen ".implode(" ",$attrs)." ></iframe>";
		}else{
			return $embed;
		}
	}
}


if ( ! function_exists( 'carrot_insert_image_src_rel_in_head' ) ) {
	function carrot_insert_image_src_rel_in_head() {
		global $post;
		$thumbnail_src="";
		$url=$post?get_permalink($post->ID):get_bloginfo("url");
		$title=get_bloginfo("name");
		$description=get_bloginfo("description");
		
		if (is_singular()) { 
			$title.= " | ". $post->post_title; 
			$description = get_the_excerpt($post->ID );
			
			if(has_post_thumbnail( $post->ID )){
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			}else{
				$thumbnail_src = catch_first_image($post->post_content,'full');
			}
		}else if(get_site_icon_url()){
			$thumbnail_src = get_site_icon_url();
		}else if(_o("theme-main-logo")){
			$thumbnail_src = _o("theme-main-logo");
		}else{
			$thumbnail_src = catch_first_image($post->post_content,'full');
		}
		
		echo "<meta property=\"og:image\" content=\"" . esc_attr( $thumbnail_src[0] ) . "\" />\n";
		echo "<meta property=\"og:url\" content=\"" .  $url . "\" />\n";
		echo "<meta property=\"og:title\" content=\"" . esc_attr($title) . "\" />\n";
		echo "<meta property=\"og:description\" content=\"" . esc_attr($description) . "\" />\n";
		
		
	}
}


if ( ! function_exists( 'carrot_generate_web_app_meta_in_head' ) ) {
	function carrot_generate_web_app_meta_in_head(){
?>
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>"/>
	<meta content="yes" name="apple-mobile-web-app-capable">
<?php
		if(_o("theme-main-logo")){
			$img=_o("theme-main-logo");
?>
	<link rel="apple-touch-icon" sizes="128x128" href="<?=$img?>" />
	<link rel="apple-touch-icon-precomposed" sizes="128x128" href="<?=$img?>" />
	<link rel="icon" sizes="128x128" href="<?=$img?>"/>
	<link rel="icon" sizes="196x196" href="<?=$img?>"/>
	<meta name="msapplication-TileColor" content="<?=_o("primary_color")?>" />
	
<?php		
		}
	}
}


if ( ! function_exists( 'carrot_init_autosearch' ) ) {
	function carrot_init_autosearch() {
		//_dump(_o("use_autosearch"));
		
		add_action( 'wp_ajax_carrot_autosearch', 'carrot_autosearch' );
		add_action( 'wp_ajax_nopriv_carrot_autosearch', 'carrot_autosearch' );
		
		
	}
}

if ( ! function_exists( 'carrot_autosearch' ) ) {
	function carrot_autosearch() {
		$term = strtolower( $_GET['term'] );
		
		$suggestions = array();
		
		$loop = new WP_Query( 'post_status=publish&posts_per_page=-1&s=' . $term );
		
		while( $loop->have_posts() ) {
			$loop->the_post();
			$suggestion = array();
			$suggestion['title'] = get_the_title();
			$suggestion['excerpt'] = get_the_excerpt();
			$suggestion['link'] = get_permalink();
			$suggestion['thumbnail'] = get_post_thumbnail('mini-icon',true,false,false,false,false);
			
			$suggestions[] = $suggestion;
		}
		
		wp_reset_query();
    	
    	
    	$response = json_encode( $suggestions );
    	echo $response;
    	exit();

	}
}


if ( ! function_exists( 'carrot_availableGaps' ) ) {
function carrot_availableGaps(){
		return array(
			'none' => __( 'No gap', THEME_NAME ),
			'pixel' => __( 'One pixel gap', THEME_NAME ),
			'xsmall' => __( 'Extra small gap', THEME_NAME ),
			'small' => __( 'Small gap', THEME_NAME ),
			'medium' => __( 'Medium gap', THEME_NAME ),
			'big' => __( 'Big gap', THEME_NAME ),
			'xbig' => __( 'Extra Big gap', THEME_NAME ),
		);
	}
}


if ( ! function_exists( 'get_post_bgcolor' ) ) {
	function get_post_bgcolor(){
		$bgcolor=get_field("bgcolor");
		if($bgcolor=="none") return "";
		if($bgcolor=="custom" && gf("colorlightbox")) return get_field("custombgcolor");
		else return _o($bgcolor."_color");
	}
}

add_theme_support( 'align-wide' );			