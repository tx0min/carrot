<?php
/**
 * Template part for displaying page content in page.php.
 * @package Carrot Theme
 */

	


?>
<article id="post-<?php the_ID(); ?>" <?php carrot_page_class(); ?>>

	<div class="entry-content clearfix" data-cols="<?=gf("columns")?>" data-lang="<?=get_locale()?>">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	
</article><!-- #post-<?php the_ID(); ?> -->
