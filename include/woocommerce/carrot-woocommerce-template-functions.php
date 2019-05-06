<?php

/*

	CARROT FUNCTIONS

*/
	
	
	
if ( ! function_exists( 'carrot_cart_link' ) ) {

	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 */
	function carrot_cart_link() {
	
			if(!function_exists('WC')) return;
			if(!WC()->cart) return;
		?>
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', THEME_NAME ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> 
				<?php if(WC()->cart->get_cart_contents_count()>0){ ?>
					<span class="count"><?php echo WC()->cart->get_cart_contents_count(); //echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), THEME_NAME ), WC()->cart->get_cart_contents_count() ) );?></span>
				<?php } ?>
				<span class="cart-icon"><?php echo _icon(WC()->cart->get_cart_contents_count()>0?"icon_cart_full":"icon_cart_empty"); ?></span>
			</a>
		<?php
	}
}


if ( ! function_exists( 'carrot_get_header_cart' ) ) {
	/**
	 * Display Header Cart
	 */
	function carrot_get_header_cart() {
		if ( carrot_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			ob_start();
		?>
		<ul id="site-header-cart" class="site-header-cart ">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php carrot_cart_link(); ?>
			</li>
			<li>
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		</ul>
		<?php
			return ob_get_clean();
		}
	}
}








if(!function_exists("carrot_woocommerce_product_image")):
	function carrot_woocommerce_product_image(){
		if(function_exists("carrot_book_cover")) carrot_book_cover();
		
		else echo get_post_thumbnail("large");
	}
endif;

