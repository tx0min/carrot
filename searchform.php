<?php
/**
 * The template for displaying search forms 
 *
 * @package Carrot Theme
 */
?>

<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', THEME_NAME ); ?>"/>
</form>
