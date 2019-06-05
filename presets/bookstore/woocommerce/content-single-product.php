<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
	 
	 $right_col=gf("awards") || gf("passages") || gf("reviews");
?>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<?php if(!_o("woo_single_fullwidth")) echo "<div class='container'>"; ?>
	<?php wc_print_notices(); ?>


	<div class='flex-row'>
		
		<div class="col-xs-12 <?php if($right_col){?> col-sm-9 <?php } ?> product-main">
			<div class="row product-header">
				<div class="col-sm-<?=$right_col?4:3?>">
					<div class="left-column anim from-top">
						<div class='book-container'>
							<div class='bk-book'>
								<?php
									if(function_exists("woocommerce_show_product_sale_flash")){
										if(is_single()) woocommerce_show_product_sale_flash();
										else woocommerce_show_product_loop_sale_flash();
										
									}
								?>
								<div class='bk-cover'>
									<?php 
										woocommerce_show_product_images();
										//carrot_woocommerce_product_image(); 
										
									?>
									
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="col-sm-<?=$right_col?4:5?>">
					<div class="right-column">
						
						<div class="product-title anim from-left delay-1">
							<?php woocommerce_template_single_title(); ?>
							<?php if(function_exists("carrot_authors_enabled") && carrot_authors_enabled()){ ?>			
								<a href="#author-<?php the_ID();?>"><?php carrot_product_author(); ?></a>
							<?php } ?>
						</div>
					</div>

				</div>
				<div class="col-sm-4">
					
					<?php woocommerce_template_single_rating(); ?>
					

				</div>
			</div>



			<div class="row">
				<div class="col-sm-<?=$right_col?4:3?>">
					<div id="buy-buttons" class="anim from-bottom delay-2">
						<a href="#" class="buy-buttons-opener carrot-btn style-flat display-block color-primary size-lg" data-toggle="#buy-buttons" ><?=__("Buy",THEME_NAME)?></a>	
						<ul>
							<?php woocommerce_template_single_add_to_cart(); ?>	
							<?php carrot_pdf_content(); ?>
						</ul>
					</div>
				</div>
				<div class="col-sm-<?=$right_col?8:5?>">
					<div class="summary">
						<?php if($post->post_excerpt){?><div class="excerpt anim from-left delay-3"><?php woocommerce_template_single_excerpt();?></div><?php } ?>
						<div class="entry-content anim from-left delay-4">
							<?php the_content();?>
						</div>
					</div><!-- .summary -->

				</div>
			</div>
			
				
		</div>

		<?php if($right_col){?> 
			<div class='col-xs-12 col-sm-3 '>
								
				<div class='sidebar anim from-right delay-2'>
				
					<?php carrot_product_awards(); ?>
					<?php carrot_product_passages(); ?>
					<?php carrot_product_external_reviews(); ?>
					
				</div>
			</div>
		 <?php } ?>
	
	</div>
	
	<div class="product-attributes ">
		<?php woocommerce_product_additional_information_tab(); ?>
	</div>
	
	
	<?php if(function_exists("carrot_authors_enabled") && carrot_authors_enabled()){ ?>			
	
	<div class="product-author" id="author-<?php the_ID();?>">
		<?php author_single_template("simple"); ?>
	</div>
	
	<?php } ?>
	

	<?php if(!_o("woo_single_fullwidth")) echo "</div>"; ?>
	
	
	
	<?php woocommerce_output_related_products()?>
	
	
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
