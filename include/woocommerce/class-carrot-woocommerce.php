<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Carrot_WooCommerce' ) ) :


	class Carrot_WooCommerce {

		private $columns = 4; 
		
		public function __construct() {
			add_filter( 'loop_shop_columns', 						array( $this, 'loop_columns' ) );
			add_filter( 'body_class', 								array( $this, 'woocommerce_body_class' ) );
			add_action( 'wp_enqueue_scripts', 						array( $this, 'woocommerce_scripts' ),	20 );
			add_filter( 'woocommerce_enqueue_styles', 				'__return_empty_array' );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			add_filter( 'woocommerce_product_thumbnails_columns', 	array( $this, 'thumbnail_columns' ) );
			add_filter( 'loop_shop_per_page', 						array( $this, 'products_per_page' ) );

			add_filter( 'woocommerce_product_tabs', array($this, 'carrot_woo_reorder_tabs'), 98 );

				
			/*override woocommerce templates with presets*/
			add_filter('wc_get_template_part', array( $this, 'carrot_wc_get_template_part') , 10, 3 );
			add_filter('wc_get_template', array( $this, 'carrot_wc_get_template') , 10, 3 );
			 
			

			/*CARROT*/
			//remove wrapper
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10 );
			remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
			//remove sidebar
			remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar',                10 );

			
			/*loop*/
			add_action( 'woocommerce_before_shop_loop_item', 				array( $this, 'carrot_shop_loop_item_start'), 8 );
			add_action( 'woocommerce_before_shop_loop_item_title', 			array( $this, 'carrot_shop_loop_item_title_start'), 12 );
			add_action( 'woocommerce_after_shop_loop_item', 				array( $this, 'carrot_shop_loop_item_title_end'), 11 );
			add_action( 'woocommerce_after_shop_loop_item', 				array( $this, 'carrot_shop_loop_item_end'), 12 );
			
			
			
			/* page title */
			add_filter( 'woocommerce_show_page_title', 	array( $this, 'carrot_woo_page_title' ) );
			
			
			/*carrot breadcrumb*/
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			add_action( 'woocommerce_archive_description',       array( $this, 'carrot_woo_breadcrumb' )  ,  9 );
			
			/*carrot header*/
			add_action( 'woocommerce_before_main_content',        array( $this, 'carrot_woocommerce_header_start'),                10 );
			
			
			add_action( 'woocommerce_before_shop_loop',         array( $this, 'carrot_woocommerce_header_end'),                 9 );
			add_action( 'woocommerce_before_shop_loop',         array( $this, 'carrot_woocommerce_form_header_start'),                 11 );
			add_action( 'woocommerce_before_shop_loop',         array( $this, 'carrot_woocommerce_form_header_between'),                 25 );
			add_action( 'woocommerce_before_shop_loop',         array( $this, 'carrot_woocommerce_form_header_end'),                 31 );
			
			/*singlepage*/
			
			
			add_action( 'woocommerce_before_single_product', 		array( $this, 'carrot_woo_page_title'), 12 );
			add_action( 'woocommerce_before_single_product', 		array( $this, 'carrot_woo_breadcrumb'), 14 );
			add_action( 'woocommerce_before_single_product',        array( $this, 'carrot_woocommerce_form_header_end'),                 15 );
			add_action( 'woocommerce_before_single_product',        array( $this, 'carrot_woocommerce_single_start'),                20 );
			
			add_action( 'woocommerce_after_single_product',        array( $this, 'carrot_woocommerce_single_end'),                10 );
			
			//wrap image
			add_action( 'woocommerce_before_single_product_summary',        array( $this, 'carrot_before_product_image'),                19 );
			add_action( 'woocommerce_before_single_product_summary',        array( $this, 'carrot_after_product_image'),                21 );
			
			
			
			

			/**
			 * Cart fragments
			 */
			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
				add_filter( 'woocommerce_add_to_cart_fragments', array( $this,'carrot_cart_link_fragment') );
			} else {
				add_filter( 'add_to_cart_fragments', array( $this,'carrot_cart_link_fragment') );
			}
		
			
			/**product image mails */
			//add_filter( 'woocommerce_email_order_items_table', array($this, 'carrot_order_email_images' ) );

			add_filter( 'woocommerce_email_order_items_args', array($this, 'carrot_order_email_args') );

			
			
			
			

			

		}
		public function carrot_woo_reorder_tabs( $tabs ) {

			$tabs['additional_information']['priority'] = 5;	// Additional information first
			$tabs['description']['priority'] = 10;			// Description second
		
			return $tabs;
		}
		
		public function carrot_wc_get_template($located, $template_name){
			   //_dump("LOCATED:".$located);
			   $template_name=str_replace(".php","",$template_name);
			   //$template_name=str_replace(".php","",$template_name);
			   //_dump("TEMPLATE:".$template_name);
			   
			   $tmp=carrot_get_template_part_path($template_name,'',true);
			   if($tmp){
				//_dump("newpath:".$tmp);
					$located=$tmp;
			   }
			   
			   return $located;
			   //$located = apply_filters( 'wc_get_template', $located, $template_name, $args, $template_path, $default_path );

		}
		
		
		public function carrot_wc_get_template_part($template,$slug, $name = ''){
			//_dump($template);
			//_dump($slug);
			//_dump($name);
			$tmp=carrot_get_template_part_path($slug,$name,true);
			if($tmp){
				$template=$tmp;
				//_dump($template);
			}
			
			return $template;
		}
		
				
		public function carrot_shop_loop_item_start(){
			echo "<div class='product-inner'>";

			
		}
		public function carrot_shop_loop_item_end(){
			echo "</div>";
			
		}	
		public function carrot_before_product_image(){
			echo "<div class='product-image'>";

			
		}
		public function carrot_after_product_image(){
			echo "</div>";
			
		}	
	
		

		
		public function carrot_shop_loop_item_title_start(){
			echo "<div class='product-title'>";
			echo "	<div class='product-title-inner'>";
			
		}
		public function carrot_shop_loop_item_title_end(){
			echo "	</div>";
			echo "</div>";
			
		}		
		
		public function carrot_woocommerce_form_header_start(){
			echo "<div class='shop-form-header'>";
			echo "<div class='container'>";
			echo "	<div class='row'>";
			echo "		<div class='col-sm-9'>";
			
		}
		public function carrot_woocommerce_form_header_between(){
			echo "	</div>";
			echo "	<div class='col-sm-3 shop-form-header-order'>";
			
		}
		public function carrot_woocommerce_form_header_end(){
			echo "			</div><!--.col-->";
			echo "		</div><!--.row-->";
			echo "	</div><!--.container-->";
			echo "</div>";
			
		}
		
		
		
		public function carrot_woocommerce_single_start(){
			if(!_o("woo_single_fullwidth")) echo "<div class='container'>"; 
	
		}
		public function carrot_woocommerce_single_end(){
			if(!_o("woo_single_fullwidth")) echo "</div><!--.container-->"; 
	
		}
		
		public function carrot_woo_page_title($title){
			echo "<div class='col-sm-6'>";
			if(is_shop() || is_archive()) $cond= _o("show_woo_title");
			else if(is_product()) $cond= _o("show_woo_single_title");
			
			if($cond){
				echo "<h1 class='page-title'>";
				woocommerce_page_title();
				echo "</h1>";
			}
			echo "</div>";
		}
			
			
			
		public function carrot_woo_breadcrumb($title){
			echo "<div class='col-sm-6'>";
			if(is_shop() || is_archive()) $cond= _o("show_woo_breadcrumb");
			else if(is_product()) $cond= _o("show_woo_single_breadcrumb");
			
			if($cond){
				carrot_breadcrumb();
			}
			echo "</div>";
		}
		

			
		public function carrot_woocommerce_header_start(){
			echo "</div><!--.container-->";
			if(is_shop() || is_archive()) $cond= _o("show_woo_title") || _o("show_woo_breadcrumb");
			else if(is_product()) $cond= _o("show_woo_single_title") || _o("show_woo_single_breadcrumb");
			
			if($cond){
			
				echo "<div class='single-page-header'>";
				echo "	<div class='container'>";
				echo "		<div class='row'>";
			}
		}
		
		
		public function carrot_woocommerce_header_end(){
			if(is_shop() || is_archive()) $cond= _o("show_woo_title") || _o("show_woo_breadcrumb");
			else if(is_product()) $cond= _o("show_woo_single_title") || _o("show_woo_single_breadcrumb");
			
			if($cond){
				echo "		</div><!--.row-->";
				echo "	</div><!--.container-->";
				echo "</div><!--.single-page-header-->";
			}
			
			echo "	<div class='shop '>";
			
		}

	
	
	
	
	
	

		/**
		 * Default loop columns on product archives
		 */
		public function loop_columns() {
			return apply_filters( 'carrot_loop_columns', $this->columns ); // products per row
		}

		/**
		 * Add 'woocommerce-active' class to the body tag
		 */
		public function woocommerce_body_class( $classes ) {
			if ( carrot_is_woocommerce_activated() ) {
				$classes[] = 'woocommerce-active';
			}

			return $classes;
		}

		/**
		 * WooCommerce specific scripts & stylesheets
		*/
		public function woocommerce_scripts() {

			wp_enqueue_style( 'carrot-woocommerce-style', get_template_directory_uri() . '/assets/style/woocommerce.css', THEME_VERSION );
			
			/*wp_register_script( 'carrot-header-cart', get_template_directory_uri() . '/assets/js/woocommerce/header-cart.js', array(), THEME_VERSION, true );
			wp_enqueue_script( 'carrot-header-cart' );
			*/
			/*wp_register_script( 'carrot-sticky-payment', get_template_directory_uri() . '/assets/js/woocommerce/checkout.js', 'jquery', THEME_VERSION, true );
			wp_enqueue_script( 'carrot-sticky-payment' );*/
			

		}


		/**
		 * Related Products Args
		 */
		public function related_products_args( $args ) {
			$args = apply_filters( 'carrot_related_products_args', array(
				'posts_per_page' => $this->columns,
				'columns'        => $this->columns
			) );

			return $args;
		}

		/**
		 * Product gallery thumnail columns
		 */
		public function thumbnail_columns() {
			return intval( apply_filters( 'carrot_product_thumbnail_columns', $this->columns ) );
		}


		/**
		 * Products per page
		 */
		public function products_per_page() {
			
			return intval( apply_filters( 'carrot_products_per_page', _o("woo_products_per_page", $this->columns * 4) ) );
		}

		
			/**
			 * Cart Fragments
			 * Ensure cart contents update when products are added to the cart via AJAX
			 *
			 * @param  array $fragments Fragments to refresh via AJAX.
			 * @return array            Fragments to refresh via AJAX
			 */
		public	function carrot_cart_link_fragment( $fragments ) {
			global $woocommerce;

			ob_start();
			carrot_cart_link();
			$fragments['a.cart-contents'] = ob_get_clean();

			
			return $fragments;
		}
		
		
		
		
		
		
		public function carrot_order_email_args( $args ) {

			$args['show_image'] = true;
			$args['image_size'] = array( 80, 80 );

			return $args;
		
		}
		
		
		
		
		
		
	
		
		
		
		

		
		

		

	}

endif;


return new Carrot_WooCommerce();
