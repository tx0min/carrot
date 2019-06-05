<?php

	
	$defaults=array(
		'site_fullwidth' => true,
		'body_bg_color' => '#ffffff',
		'primary_color' => '#dd3333',
		'primary_text_color' => '#ffffff',
		'alt_color' => '#6b0101',
		'borders_color' => '#333333',
		'alt_text_color' => '#ffffff',
		'text_font'=>array(
			'font-family'    => 'Roboto',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'subsets'        => array( 'latin-ext' )
		),
		'headings_font' => array(
			'font-family'    => 'Old Standard TT',
			'variant'        => '400,400i,700',
			'subsets'        => array( 'latin-ext' )

		),
		'header_type' => 'header_center',
		'header_background_color' => 'primary-inverse',
		'footer_background_color' => 'alt',
		'show_sub_footer' => true,
		'subfooter_background_color' => 'custom',
		'subfooter_custom_background_color' => 'rgba(10,10,10,0.16)',
		'subfooter_custom_text_color' => '#FFFFFF',
		'copyright' => 'Carrot Magazine',
		
	);
	$scripts=array('color-thief.min.js','bookcase.js','init.js');
	$styles=array('style.css','bookcase.css','woocommerce.css','events.css');
	
	
	
	$customizerelements= array(
		'alt_color' => array(
			array(
				'element' => '
								#tribe-events .tribe-events-button:hover, .tribe-events-button:hover
								',
				'property' => 'background-color',
				
			),
			array(
				'element' => '
								.tribe-events-read-more:hover,
								.tribe-events-read-more:visited,
								.tribe-events-read-more:active,
								.tribe-events-read-more:focus,
								.tribe-events-sub-nav li a:hover,
								.tribe-events-sub-nav li a:visited,
								.tribe-events-sub-nav li a:active,
								.tribe-events-sub-nav li a:focus,
								#tribe-events td.tribe-events-present div[id*="tribe-events-daynum-"],
								#tribe-events td.tribe-events-present div[id*="tribe-events-daynum-"] > a
								',
				'property' => 'color',
				'important'   => true
				
			)
		),
		'alt_text_color' => array(
			array(
				'element' => '
								#tribe-events .tribe-events-button:hover, .tribe-events-button:hover
								',
				'property' => 'color',
				
			)
		),
		'primary_color' => array(
			array(
				'element' => '
								.woocommerce-loop-product__title, article.article-single.authors-single .entry-interview, .single-product  .product-awards .award .carrot-icon,
								.single-product  .product-reviews .review .carrot-icon, .single-product  .product-passages .passage .carrot-icon,
								.tribe-events-read-more,
								.tribe-events-sub-nav li a,
								.tribe-events-calendar a, .tribe-events-calendar div[id*=tribe-events-daynum-] a,
								.carrot-files .file-name a,
								.carrot-files ul li .file-alt-url a,
								.publication .publication-title, 
								.publication .premios,
								.book-container .book-simple-controls button,
								#tribe-events-content a, .tribe-events-event-meta a
								',
				'property' => 'color',
				//'units' =>''
			),
			array(
				'element' => '
					.single-product  #buy-buttons button:hover,
					#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover
					',
				'property' => 'border-color',
				
			),
			array(
				'element' => '
								.single-product  #buy-buttons button:hover, .single-product  #buy-buttons a:hover,  .site-header-cart .cart-contents .count,
								input[type="radio"]:active,  input[type="checkbox"]:active,
								#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover,
								#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,
								#tribe-events .tribe-events-button, .tribe-events-button
								',
				'property' => 'background-color',
				
			)
		),
		'primary_text_color' => array(
			array(
				'element' => '
							.single-product  #buy-buttons button:hover, .single-product  #buy-buttons button:hover *, .single-product  #buy-buttons a:hover,  .site-header-cart .cart-contents .count,
							input[type="radio"]:active,  input[type="checkbox"]:active, 
							input[type="radio"]:active:after, input[type="checkbox"]:active:after,
							#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover,
							#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,
							#tribe-events .tribe-events-button, .tribe-events-button
							
							',
				'property' => 'color',
			),array(
				'element' => '
								.book-container .book-simple-controls button
							
							',
				'property' => 'background-color',
			)
		),
		'borders_color' => array(
			array(
				'element' => '
					.single-product  #buy-buttons button,
					.single-product .product-header,
					.single-page-header,
					.single-product  .product-attributes,
					.articles-container.products  .product  .product-inner,
					.shop-form-header,
					.single-product  .product-author,
					article.article-single.authors-single > .row > div,
					.single-product  #buy-buttons li,
					.site-header-cart  .widget_shopping_cart_content,
					.cart_list  li,
					.site-header-cart  .widget_shopping_cart_content  .total,
					.single-product  .sidebar > div,
					.woocommerce-message, .woocommerce-info, .woocommerce-error,
					.woocommerce-cart .cart-collaterals,
					.shop_table  thead tr, .shop_table  tbody tr, .shop_table  tfoot tr,
					.woocommerce-checkout #order_review_heading,
					.woocommerce-checkout .woocommerce-checkout-review-order,.wc_payment_methods,.wc_payment_methods li, 
					.related,
					.related .related-header,
					.relatedposts , #comments-container,
					#tribe-bar-form,
					#tribe-bar-views .tribe-bar-views-list,
					#tribe-bar-form .tribe-bar-submit input[type=submit],
					.single-tribe_events .tribe-events-event-meta,
					#tribe-events-footer, 
					.events-list #tribe-events-footer, 
					.single-tribe_events #tribe-events-footer,
					.tribe-events-day #tribe-events-footer, 
					.tribe-events-map #tribe-events-footer, 
					.tribe-events-photo #tribe-events-footer,
					.single-tribe_events .tribe-events-venue-map,
					.tribe-events-list .type-tribe_events,
					.tribe-events-loop .tribe-events-event-meta,
					article.article-single.authors-single > .flex-row > div,
					.carrot-files ul ,
					.carrot-files ul li,
					.carrot-files ul li .file-icon .file-image-icon,
					.author-other-publications,
					.woocommerce-account .col2-set .col-1,
					article.article-single.authors-single.author-full  .entry-header,
					.single-product  #buy-buttons .variations_form .woocommerce-variation-price,
					.recurring-info-tooltip, .tribe-events-calendar .tribe-events-tooltip, .tribe-events-shortcode.view-week .tribe-events-tooltip, .tribe-events-week .tribe-events-tooltip,
					.tribe-events-tooltip .tribe-events-arrow,
					.tribe-events-notices,
					.tribe-events-list-widget ol li

					',
				'property' => 'border-color',
				
			),
			array(
				'element' => '.tribe-events-loop .type-tribe_events.tribe-events-last
								',
				'property' => 'border-bottom-color',
			),
		),
		'body_bg_color' => array(
			array(
				'element' => '.single-product  #buy-buttons ul, input[type="radio"], input[type="checkbox"],
								#tribe-bar-views .tribe-bar-views-list,
								.single-tribe_events .tribe-events-event-meta,
								#tribe-events-content .tribe-events-calendar thead th, 
								#tribe-events-content .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column, 
								#tribe-events-content .tribe-grid-header,
								.recurring-info-tooltip, .tribe-events-calendar .tribe-events-tooltip, .tribe-events-shortcode.view-week .tribe-events-tooltip, .tribe-events-week .tribe-events-tooltip,
								.tribe-events-tooltip .tribe-events-arrow,
								.tribe-events-notices
								',
				'property' => 'background-color'
				//'units' =>''
			),
			
			array(
				'element' => '
					.woocommerce-message, .woocommerce-info, .woocommerce-error, 
					.woocommerce-message a, .woocommerce-info a, .woocommerce-error a,
					.woocommerce-message a:hover, .woocommerce-info a:hover, .woocommerce-error a:hover,
					.woocommerce-message a:focus, .woocommerce-info a:focus, .woocommerce-error a:focus,
					.woocommerce-message .button, .woocommerce-info .button, .woocommerce-error .button,
					.woocommerce-message .button:hover, .woocommerce-info .button:hover, .woocommerce-error .button:hover,
					.woocommerce-message .button:focus, .woocommerce-info .button:focus, .woocommerce-error .button:focus,
					input[type="radio"]:after, input[type="checkbox"]:after,
					input[type="radio"]:checked:after, input[type="checkbox"]:checked:after
					
					',
				'property' => 'color'
			)
			
		),
		'body_text_color' => array(
			array(
				'element' => 'article.article-single.authors-single .entry-interview h3, 
							.books-container  .product-awards .award  blockquote,
							.books-container  .product-reviews .review  blockquote,
							.books-container  .product-passages .passage  blockquote,
							#tribe-bar-form .tribe-bar-submit input[type=submit],
							.tribe-events-day .tribe-events-day-time-slot h5,
							#tribe-events-content .tribe-events-tooltip h4,
							.tribe-events-notices, 
							#tribe-events-content .tribe-events-list-event-title a,
							#tribe-events-content .tribe-events-page-title a,
							.tribe-events-list-widget .tribe-event-title a
							',
				'property' => 'color'
				
			),
			array(
				'element' => '
								.woocommerce-message, .woocommerce-info, 
								input[type="radio"]:checked, input[type="checkbox"]:checked
								',
				'property' => 'background-color'
			),
			array(
				'element' => '.input[type="radio"],input[type="checkbox"]',
				'property' => 'border-color'
			)
		),
		'headings_font' => array(
			array(
				'element' => '
								.excerpt, .entry-interview, .product-passages blockquote, .product-awards blockquote, .product-reviews blockquote,
								.tribe-events-list-separator-month,
								.carrot-files ul li .file-name,
								.author-birth
								'
				//'units' =>''
			)
		)
	);

	
	
	
	
	
	
//tribe events customization
	

if(!function_exists("carrot_tribe_before_header")):	
	function carrot_tribe_before_header(){
		echo "<div class='row events-row'><div class='col1 col-sm-4'>";
	}
endif;

if(!function_exists("carrot_tribe_after_header")):	
	function carrot_tribe_after_header(){
		echo "</div><div class='col2 col-sm-8'>";
	}
endif;

if(!function_exists("carrot_tribe_after_content")):	
	function carrot_tribe_after_content(){
		echo "</div></div>";
	}
endif;

if(!function_exists("carrot_tribe_before_template")):
	function carrot_tribe_before_template(){
		//return "IEEEE";
	}
endif;
if(!function_exists("init_tribe_events")):	
	function init_tribe_events(){
		//add_action("tribe_events_list_before_the_content","carrot_tribe_before_header");
		add_action("tribe_events_before_template","carrot_tribe_before_template");
		add_action("tribe_events_before_the_title","carrot_tribe_before_header");
		
		add_action("tribe_events_after_header","carrot_tribe_after_header");
		
		add_action("tribe_events_before_footer","carrot_tribe_after_content");
		
	}
	init_tribe_events();
endif;

if(!function_exists("carrot_get_book_cover_start")):
	function carrot_get_book_cover_start(){
		$ret="<div class='book-container'>";
		$ret.="		<div class='bk-book'>";
		if(function_exists("woocommerce_show_product_sale_flash")){
			ob_start();
			if(is_single()) woocommerce_show_product_sale_flash();
			else woocommerce_show_product_loop_sale_flash();
			$ret.=ob_get_clean();
		}
		$ret.="			<div class='bk-cover'>";
		return $ret;
			
	}
endif;


if(!function_exists("carrot_get_book_cover_end")):
	function carrot_get_book_cover_end(){
		$ret= "			</div>";
		$ret.= "	</div>";
		$ret.= "</div>";
		return $ret;	
	}
endif;
	
	
if(!function_exists("carrot_book_cover")):
	function carrot_book_cover(){
		global $product;
		global $post;
		$data=array();
			
		echo carrot_get_book_cover_start();
		//$cubierta=get_post_meta( $post->ID, "cubierta", true );

		//_dump($cubierta);
		
		$paginas = $product->get_attribute( 'numero-de-paginas' );
		$cubierta = ($product->get_attribute( 'cubierta' )=="Tapa dura")?"hard":"soft";
		
		$data=array(
			"title"=>get_the_title(),
			"covertype"=> $cubierta,
			"author"=> carrot_get_author_name(),
			"synopsys"=> get_the_excerpt(),
			
		
		);
		
		if($paginas) $data["pages"]= $paginas;
		
?>
	

			<?php echo get_post_thumbnail_data('shop_catalog', $data); ?>
			<?php  //carrot_get_book_cover($data) ?>
			
				
		<?php 												
		echo carrot_get_book_cover_end();
	}
endif;

if(!function_exists("carrot_book_cover_card")):
	function carrot_book_cover_card(){
		echo "<div class='book-card'>";
		echo "	<a class='card-hover' href='".get_the_permalink()."'>";
		echo "		<div class='card-hover-inner'>";
		echo "			<h2 class='book_title'>".get_the_title()."</h2>";
		echo "		</div>";
		echo "	</a>";
		echo "	<div class='card-normal'>";
		carrot_book_cover();
		echo "	</div>";
		echo "</div>";
	}
endif;
	
	
	
	
	
	
	
	
	
	
	
	
	

/** BOOKSTORE FUNCTIONS */
	
	

if(!function_exists("carrot_product_author")):
	function carrot_product_author(){
		if(authors_enabled()){
			echo "<h4 class='author_name'>".carrot_get_author_name()."</h4>";
		}
	}
endif;



if(!function_exists("carrot_product_author_card")):

	function carrot_product_author_card(){
		if(authors_enabled()){
	?>
		<div class="book-card">
	<?php	
			$author=carrot_get_product_author();
			//_dump($author);
			echo "<a class='card-hover' href='".get_permalink($author->ID)."'>";
			echo "	<div class='card-hover-inner'>";
			echo "		<h2 class='author_name'>".carrot_get_author_name()."</h2>";
			echo "	</div>";
			echo "</a>";
			echo "<div class='card-normal'>";
			echo get_post_thumbnail_by_id($author->ID,'full',false,false,false,false,true);
			echo "</div>";
	?>
		</div>
	<?php					
		}
	}
endif;

if(!function_exists("carrot_product_passages")):

	function carrot_product_passages($limit=0,$showproductinfo=false){
		$passages=gf("passages");
		if($passages){
	?>
	<div class="product-passages">
		<div class="articles-slider owl-carousel owl-theme" data-nav="false" data-fx="fade" data-loop="false" >
		<?php
			
			if($limit>0) $passages=array_slice($passages,0,$limit);
			foreach($passages as $passage){
		?>
			<div class="passage">
				<?=_icon("icon_double_quote_left")?>
				<blockquote>
					<div class="passage-content"><?=$passage["passage"]?></div>
					<?php if($showproductinfo){?>
						<div class="extra-info">
							<a href="<?php the_permalink();?>" > 
								<span class="passage_product_author"><?php echo carrot_get_author_name(); ?></span>, <span class="passage_product_title"><?php the_title(); ?></span>
							</a>
						</div>
					<?php } ?>
				</blockquote>
			</div>
		<?php
			}
			
		?>
		</div>
	</div>
	<?php
		}
	}
endif;




if(!function_exists("carrot_product_external_reviews")):
	function carrot_product_external_reviews($limit=0){
		$reviews=gf("reviews");
		if($reviews){
	?>
	<div class="product-reviews">
		<div class="articles-slider owl-carousel owl-theme" data-nav="false" data-fx="fade" data-loop="false" >
		<?php
			
			if($limit>0) $passages=array_slice($passages,0,$limit);
			
			foreach($reviews as $review){
		?>
			<div class="review">
				<?=_icon("icon_comment")?>
				<blockquote>
					
					<div class="review-excerpt"><?=$review["review_excerpt"]?></div>
					<div class="extra-info">
						<a href="<?=$review["review_link"]?>" target="_blank" nofollow rel="external" > - 
						<?php if($review["review_author"]){ ?><span class="review_author"><?=$review["review_author"]?></span> <?php } ?><?php if($review["review_author"] && $review["review_media"]){ ?>,<?php } ?><?php if($review["review_media"]){ ?><span class="review_media"><?=$review["review_media"]?></span><?php } ?>
						</a>
					</div>
				</blockquote>
			</div>
		<?php
			}
			
		?>
		</div>
	</div>
	<?php
		}
	}
endif;




if(!function_exists("carrot_product_awards")):
	function carrot_product_awards(){
		$awards=gf("awards");
		if($awards){
	?>
	<div class="product-awards">
		<div class="articles-slider owl-carousel owl-theme" data-nav="false" data-loop="false" data-fx="fade">
		<?php
			
			foreach($awards as $award){
		?>
			<div class="award">
				<?=_icon("icon_award")?>
				<blockquote>
					<span class="award-name"><?=$award["award_text"]?></span><?php if($award["award_year"]){ ?><span class="award-year">, <?=$award["award_year"]?></span><?php } ?>
				</blockquote>
			</div>
		<?php
			}
			
		?>
		</div>
	</div>
	<?php
		}
	}
endif;






if(!function_exists("carrot_pdf_content")):
	function carrot_pdf_content() {
		global $woocommerce, $post;
		
		$pdfid=get_post_meta( $post->ID, "product_pdf", true );
		$disabled=!is_user_logged_in();
		if($pdfid){
			$pdf=get_post($pdfid);
			$url=wp_get_attachment_url($pdf->ID);
			if($disabled) $url=carrot_get_woo_account_url();
	?>
		<li class="buy-preview">
			<div class="row">
				<div class="col-xs-6">
					<h4 class="buy-title"><?=__("Preview",THEME_NAME)?></h4>
				</div>
				<div class="col-xs-6">
					<a href='<?=$url?>' <?=$disabled?"":"target='_blank'"?> class="button " title="<?=__("You can enjoy a brief summary of the book by downloading it through the following button.",THEME_NAME);?>">
						<?=_icon("icon_download")?> 
					</a>
				</div>
			</div>
		</li>
		
	<?php
		}
	}
endif;

		
		
if(!function_exists("carrot_woo_get_product_variation")):
	function carrot_woo_get_product_variation( $product , $attribute, $var) {
		//_dump($attribute);
		//_dump($variation);
		
		$variations=$product->get_available_variations();
		foreach($variations as $variation){
			if(array_key_exists("attributes",$variation) && array_key_exists("attribute_".$attribute,$variation["attributes"]) && $variation["attributes"]["attribute_".$attribute]==$var){
				return $variation;
			}
		}
		return false;
	}
endif;	




if(!function_exists("carrot_woo_product_variations")):
	
	function carrot_woo_product_variations( $options, $attribute, $product ) {

		$html="";
		if ( ! empty( $options ) ) {
			if ( $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );
				
				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						$html.='<li>';
						$html.='<form class="variations_form cart" method="post" enctype="multipart/form-data"  >';
			
						
						$html.='<div class="row">';
						$html .= '<div class="col-xs-6">';
						$html .= '	<h4 class="buy-title">';
						$html.=esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );
						$html .= '	</h4>';
						$html .= '</div>';
						$html .= '<div class="col-xs-6">';
						
						
						$var=carrot_woo_get_product_variation($product,$attribute,$term->slug);
						//_dump($var);
						if($var){
							$var_id=$var["variation_id"];
							$html .= '<button type="submit" class="single_add_to_cart_button button alt">'. $var["price_html"].'</button>';
							$html .= '<input type="hidden" name="attribute_'.$attribute.'" value="'.$term->slug.'" />';
							$html .= '<input type="hidden" name="quantity" value="1" />';
							$html .= '<input type="hidden" name="add-to-cart" value="'. absint( $product->get_id() ).'" />';
							$html .= '<input type="hidden" name="product_id" value="'. absint( $product->get_id() ).'" />';
							$html .= '<input type="hidden" name="variation_id" class="variation_id" value="'.$var_id.'" />';
							//$html .= $price;
						}
						$html .= '</div>';
						$html .= '</div>';
						$html .= '</form>';
						$html .= '</li>';
						 
					}
				}
			}
		}
		return $html;
		
	}
endif;
		