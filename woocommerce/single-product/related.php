<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( _o("show_woo_single_related") && $related_products ) : ?>

	<section class="related products">
		<div class="related-header">
			<div class="container">
				<h3 class=""><?php echo __( 'You may also be interested...', THEME_NAME ); ?></h3>
			</div>
		</div>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );
				?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
					
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
		
	</section>

<?php endif;

wp_reset_postdata();
