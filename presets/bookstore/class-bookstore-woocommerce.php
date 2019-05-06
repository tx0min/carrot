<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Carrot_Bookstore_WooCommerce' ) ) :


	class Carrot_Bookstore_WooCommerce {

		//private $columns = 4; 
		
		public function __construct() {
			
			
			/*BOOKSTORE*/
			
			
			/* frontend tabs */
			add_filter( 'woocommerce_product_tabs', array( $this, 'carrot_edit_product_tabs' ),98); //to books
			
			/* backend tabs */
			add_filter( 'woocommerce_product_data_tabs', array( $this, 'carrot_custom_product_data_tab') , 99 , 1 ); //to books
			
			
			/*backend*/
			add_action( 'woocommerce_product_data_panels', 					array( $this, 'carrot_custom_product_data_fields') );
			add_action( 'woocommerce_process_product_meta', 				array( $this, 'carrot_process_product_meta_fields_save') );

			/*frontend*/
			add_action( 'woocommerce_shop_loop_item_title', 				array( $this, 'carrot_add_author'), 11 );
			
			remove_action( 'woocommerce_before_shop_loop_item_title', 		'woocommerce_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_before_shop_loop_item_title', 			array( $this, 'carrot_product_image'), 10 );
			
			
			remove_action( 'woocommerce_before_single_product_summary',  	'woocommerce_show_product_sale_flash', 10 );
			
			remove_action( 'woocommerce_before_shop_loop_item_title',  		'woocommerce_show_product_loop_sale_flash', 10 );

			
			/*single page*/
			remove_action( 'woocommerce_before_single_product',  	'wc_print_notices', 10 );
			
			
			$this->register_acf_options();
			
			
			remove_theme_support( 'wc-product-gallery-zoom' );
			remove_theme_support( 'wc-product-gallery-lightbox' );
			remove_theme_support( 'wc-product-gallery-slider' );

		
			
					 
			// change variations image size 
			add_filter( 'woocommerce_available_variation', array( $this, 'filter_woocommerce_available_variation'), 10, 3 ); 
			
			//remove choose option from variations
			add_filter( 'woocommerce_dropdown_variation_attribute_options_args', array( $this, 'remove_woocommerce_dropdown_default_variation'), 10, 1 ); 

			add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'change_woocommerce_product_single_add_to_cart_text'), 10, 1 ); 
		}
		
		

		private function register_acf_options(){
			if(!function_exists("acf_add_local_field_group")) return;
			
			
			acf_add_local_field_group(array (
				'key' => 'group_field_product_passages',
				'title' => __('Product info',THEME_NAME),
				'fields' => array (
					array (
						'key' => 'field_product_passages_tab',
						'label' => __('Passages',THEME_NAME),
						'type' => 'tab',
					),
					array (
						'key' => 'field_product_passages',
						'label' => __('Passages',THEME_NAME),
						'name' => 'passages',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'field_product_passages_passage',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => __('Add Passage',THEME_NAME),
						'sub_fields' => array (
							array (
								'key' => 'field_product_passages_passage',
								'label' => __('Passage',THEME_NAME),
								'name' => 'passage',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array (
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'new_lines' => 'wpautop',
							),
						),
					),
					array (
						'key' => 'field_product_reviews_tab',
						'label' => __('External Reviews',THEME_NAME),
						'type' => 'tab',
					),
					array (
						'key' => 'field_product_reviews',
						'label' => __('Reviews',THEME_NAME),
						'name' => 'reviews',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'field_product_reviews_review_media',
						'min' => 0,
						'max' => 0,
						'layout' => 'row',
						'button_label' => __('Add Review',THEME_NAME),
						'sub_fields' => array (
							array (
								'key' => 'field_product_reviews_review_author',
								'label' => __('Review Author',THEME_NAME),
								'name' => 'review_author',
								'type' => 'text',
								
							),
							array (
								'key' => 'field_product_reviews_review_media',
								'label' => __('Review Media',THEME_NAME),
								'name' => 'review_media',
								'type' => 'text',
								
							),
							array (
								'key' => 'field_product_reviews_review_link',
								'label' => __('Review Link',THEME_NAME),
								'name' => 'review_link',
								'type' => 'url',
								
							),
							array (
								'key' => 'field_product_reviews_review_excerpt',
								'label' => __('Review Excerpt',THEME_NAME),
								'name' => 'review_excerpt',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array (
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'new_lines' => 'wpautop',
								'readonly' => 0,
								'disabled' => 0,
								
							)
						),
					),
					array (
						'key' => 'field_product_awards_tab',
						'label' => __('Awards',THEME_NAME),
						'type' => 'tab',
					),
					array (
						'key' => 'field_product_awards',
						'label' => __('Awards',THEME_NAME),
						'name' => 'awards',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'field_product_awards_award_text',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'button_label' => __('Add Award',THEME_NAME),
						'sub_fields' => array (
							array (
								'key' => 'field_product_awards_award_text',
								'label' => __('Award',THEME_NAME),
								'name' => 'award_text',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array (
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'placeholder' => '',
								'maxlength' => '',
								'rows' => '',
								'new_lines' => 'wpautop',
								'readonly' => 0,
								'disabled' => 0,
								
							),array (
								'key' => 'field_product_awards_award_year',
								'label' => __('Year',THEME_NAME),
								'name' => 'award_year',
								'type' => 'text',
								
							),
						),
					),
					
					array (
						'key' => 'field_product_colors_tab',
						'label' => __('Colors',THEME_NAME),
						'type' => 'tab',
					),
					array (
						'key' => 'field_product_bg_color',
						'label' => __('Background Color',THEME_NAME ),
						'name' => 'product_bg_color',
						'type' => 'color_picker',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => ''
						),
						'default_value' => '#ffffff',
					),
					array (
						'key' => 'field_product_text_color',
						'label' => __('Text Color',THEME_NAME ),
						'name' => 'product_text_color',
						'type' => 'color_picker',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => ''
						),
						'default_value' => '#333333',
					)
					
					/*,
					array (
						'key' => 'field_multimedia',
						'label' => __('Multimedia', THEME_NAME ),
						'type' => 'tab',
						
					),
					array (
						'label' => __('Videos', THEME_NAME),
						'key' => 'field_videos',
						'name' => 'videos',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'collapsed' => 'field_product_awards_award_text',
						'min' => 0,
						'max' => 0,
						'layout' => 'table',
						'collapsed' => 'field_videos_video_url',
						'button_label' => __('Add Video', THEME_NAME),
						'sub_fields' => array (
							array (
								'key' => 'field_videos_video_url',
								'label' => __('Video URL', THEME_NAME),
								'name' => 'video_url',
								'type' => 'url',
								'instructions' => __('Youtube or Vimeo video URL', THEME_NAME),
							)
						),
					),
					array (
						'label' => __('Audio/Music', THEME_NAME),
						'key' => 'field_audio',
						'name' => 'audio',
						'type' => 'repeater',
						'layout' => 'table',
						'collapsed' => 'field_audio_audio_url',
						'button_label' => __('Add Audio', THEME_NAME),
						'sub_fields' => array (
							array (
								'key' => 'field_audio_audio_url',
								'label' => __('Audio URL', THEME_NAME),
								'name' => 'audio_url',
								'type' => 'url',
								'instructions' => __('Spotify song or playlist URL', THEME_NAME),
							)
						),
					),*/
					
					
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'product',
						)
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));
			
			
			
			//add related to post
			acf_add_local_field_group(array (
				'key' => 'group_related_products',
				'title' => __('Related Products',THEME_NAME ),
				'fields' => array (
					array (
						'key' => 'field_related_products',
						'label' => __('Related Products', THEME_NAME),
						'name' => 'related_products',
						'type' => 'relationship',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array (
							0 => 'product',
						),
						'taxonomy' => array (
						),
						'filters' => array (
							0 => 'search',
						),
						'elements' => array (
							0 => 'featured_image',
						),
						'min' => '',
						'max' => '',
						'return_format' => 'object',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'post',
						)
					),
				),
				'menu_order' => 0,
				'position' => 'side',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));
			
			
			
			
			
		}	

		
		
		
		
		
		/** BOOKSTORE FUNCTIONS */
		/*add author to loop title*/
		public function carrot_add_author(){
			carrot_product_author();
			
		}


		/*add structure to image*/
		public function carrot_product_image_start(){
			if(function_exists("carrot_get_book_cover_start")) 	echo carrot_get_book_cover_start();
	
			
			
		}


		/*add structure to image*/
		public function carrot_product_image(){
			if(function_exists("carrot_woocommerce_product_image")) carrot_woocommerce_product_image();
		}



		public function carrot_product_image_end(){
			if(function_exists("carrot_get_book_cover_end")) 	echo carrot_get_book_cover_end();
			
		}

		
		
		
		
		public function carrot_rename_tabs( $tabs ) {
			//_dump($tabs);
			if(!isset($tabs['description'])){
				$tabs['description']=array(
						'title' => '',
						'priority' => 10
				);
			}
			$tabs['description']['title'] = __( 'Synopsis' ,THEME_NAME);		// Rename the description tab
			//$tabs['additional_information']['title'] = __( '+ Information' ,THEME_NAME);		// Rename the description tab
			return $tabs;
		}
		
		
		
		public function carrot_edit_product_tabs( $tabs ) {
			global $woocommerce, $post;
			
			unset($tabs['description']);
			
			if(authors_enabled()){
				$authorid=get_post_meta( $post->ID, "product_author", true );
				if($authorid){
					$tabs['author_tab'] = array(
						'title' 	=> __( 'Author',THEME_NAME ),
						'priority' 	=> 12,
						'callback' 	=> array($this,'carrot_author_tab_content')
					);
				}
			}
			
			$pdfid=get_post_meta( $post->ID, "product_pdf", true );
			if($pdfid){
				$tabs['pdf_tab'] = array(
					'title' 	=> __( 'Preview',THEME_NAME ),
					'priority' 	=> 50,
					'callback' 	=> array($this,'carrot_pdf_tab_content')
				);
			}
			
			
			return $tabs;

		}
		
		
		
		
		
		public function carrot_custom_product_data_tab( $product_data_tabs ) {
			if(authors_enabled()){
				$product_data_tabs['author-tab'] = array(
					'label' => __( 'Author', THEME_NAME ),
					'target' => 'author_product_data',
				);
			}
			
			$product_data_tabs['pdf-tab'] = array(
				'label' => __( 'Preview PDF', THEME_NAME ),
				'target' => 'preview_pdf_product_data',
			);
			return $product_data_tabs;
		}
	
	
	
			
			
				
		/* tab content */
		public function carrot_custom_product_data_fields() {
			global $woocommerce, $post;
			
				$pdfid=get_post_meta( $post->ID, "product_pdf", true );
				$filename="";
				$id="";
				if($pdfid){
					$pdf=get_post($pdfid);
					$id=$pdf->ID;
					$filename = basename ( get_attached_file( $pdf->ID ) );

				}
			?>
			
			<div id="preview_pdf_product_data" class="panel woocommerce_options_panel wc-metaboxes-wrapper hidden">
				<div class="options_group">
					<p class="form-field  ">
						
						<label for="pdf_preview"><?=__( 'Preview PDF', THEME_NAME )?></label>
						<input type="text" readonly class="short readonly" name="pdf_preview" id="pdf_preview"  placeholder="<?=$filename?>">
						<input id="upload_file_button" data-saved-id="<?=$post->ID?>" type="button" class="button" value="<?php _e( 'Upload PDF' ,THEME_NAME); ?>" />
						<input type='hidden' name='pdf_attachment_id' id='pdf_attachment_id' value='<?=$id?>'>
						<?php 
							
							
						?>
							<div id="pdf_icon" class="<?=$pdfid?"":"empty"?>">
						<?php
								if($pdfid){	
									//echo $pdf->ID;
									
									echo "<a href='".wp_get_attachment_url($pdf->ID)."' target='_blank'>".get_attachment_icon($pdf->ID)."<br/>".$filename."</a>";
									echo "<br/><a href='#' class='deletion' id='remove_pdf_button'>".__("Remove",THEME_NAME)."</a>"; 
								}
						?>
						
							</div>
						
						
					</p>
					
					<?php wp_enqueue_media();?>
					
					
				</div>
			</div>
			<?php 	if(authors_enabled()){ ?>
			<div id="author_product_data" class="panel woocommerce_options_panel wc-metaboxes-wrapper hidden">
				<div class="options_group">
				<?php
					
					$authorid=get_post_meta( $post->ID, "product_author", true );
					//_dump($authorid);
					
					woocommerce_wp_select(
						array(
							'id' => 'product_author',
							'label' => __('Author', THEME_NAME),
							'description' => '<a  href="post-new.php?post_type=authors">'.__('Create new author', THEME_NAME).'</a>',
							'options' => carrot_get_authors(),
							'value' => $authorid?$authorid:0
						)
					);

				
				?>
					
				</div>
				<!--div class="toolbar">
					<a class="button button-primary" href="post-new.php?post_type=authors">Create new author</a>
				</div-->
			</div>
			
			<?php
				}
		}





		/*save tab*/
		public function carrot_process_product_meta_fields_save( $post_id ){
			// This is the case to save custom field data of checkbox. You have to do it as per your custom fields
			
			if(authors_enabled()){		
				$product_author =  $_POST['product_author'] ;
				update_post_meta( $post_id, 'product_author', $product_author );
			}
			
			$pdf_attachment_id =  $_POST['pdf_attachment_id'] ;
			update_post_meta( $post_id, 'product_pdf', $pdf_attachment_id );
		}






		public function carrot_pdf_tab_content() {
			global $woocommerce, $post;
			
			$pdfid=get_post_meta( $post->ID, "product_pdf", true );
			if($pdfid){
				$pdf=get_post($pdfid);
		?>
			<div class="pdf-preview">
				<p><?=__("You can enjoy a brief summary of the book by downloading it through the following button.",THEME_NAME);?></p>
				
				<a href='<?=wp_get_attachment_url($pdf->ID)?>' target='_blank' class="button">
					<?=__("Download",THEME_NAME)?><br/><em><?=$pdf->post_title?></em> <?=_icon("icon_download")?>
				</a>
									
				
			</div>	
		<?php
			}
		}







		public function carrot_author_tab_content(){
			global $woocommerce, $post;
			if(!authors_enabled()) return;
			
			$authorid=get_post_meta( $post->ID, "product_author", true );
			if($authorid){
				
				$author=get_post($authorid);
		?>
			<div class="author">
				<header class="author-header">
					<div class="author-thumbnail"><?php echo get_post_thumbnail_by_id($author->ID,"thumbnail"); ?></div>
					<div class="author-title">
						<h3><?=$author->post_title?></h3>
						<div class="author-contact">
							<a href="<?php echo get_field("pagina_web",$author->ID); ?>" rel="external"><?php echo get_field("pagina_web",$author->ID); ?></a>
							<a href="mailto:<?php echo get_field("email",$author->ID); ?>"><?php echo get_field("email",$author->ID); ?></a>
							<div class="author-social">
							<?php
								echo _field("facebook",'<a href="', '" rel="external" >'._icon("icon_facebook").'</a>',$author->ID); 
								echo _field("twitter",'<a href="https://twitter.com/', '" rel="external" >'._icon("icon_twitter").'</a>',$author->ID); 
								echo _field("instagram",'<a href="https://www.instagram.com/', '" rel="external" >'._icon("icon_instagram").'</a>',$author->ID); 
								
								
								
							?>
							</div>
						</div>
					</div>
				</header>
				<div class="author-bio"><?=get_field("biografia",$author->ID)?></div>
				
			</div>
		<?php
				
			}
			
		}

		
		
		public function filter_woocommerce_available_variation( $variation_get_max_purchase_quantity, $instance, $variation ) { 
					
				$img_id=$variation_get_max_purchase_quantity["image_id"];
				//_dump($variation_get_max_purchase_quantity);
				
				if(!$img_id){
					$img_id=get_post_thumbnail_id($variation_get_max_purchase_quantity["parent_id"]);
				}
				
				$catalog_size_image   = wp_get_attachment_image_src( $img_id, 'shop_catalog' );
				
				$variation_get_max_purchase_quantity["image"]["src"]=$catalog_size_image[0];
				$variation_get_max_purchase_quantity["image"]["src_w"]=$catalog_size_image[1];
				$variation_get_max_purchase_quantity["image"]["src_h"]=$catalog_size_image[2];
				$variation_get_max_purchase_quantity["image"]["thumb_src"]=$catalog_size_image[0];
				$variation_get_max_purchase_quantity["image"]["thumb_src_w"]=$catalog_size_image[1];
				$variation_get_max_purchase_quantity["image"]["thumb_src_h"]=$catalog_size_image[2];
				
				$variation_get_max_purchase_quantity["image"]["srcset"] = $catalog_size_image[0] ." ".$catalog_size_image[1]."w";//, ".$variation_get_max_purchase_quantity["image"]["srcset"];
				
				return $variation_get_max_purchase_quantity;
			
		}

		public function remove_woocommerce_dropdown_default_variation($array){
				
				$array["show_option_none"] =false;
				return $array;
			
		}
		
		
	public function change_woocommerce_product_single_add_to_cart_text($text){
				
				return _icon("icon_cart_empty");
			
		}
		
		

		

	}

endif;

return new Carrot_Bookstore_WooCommerce();
